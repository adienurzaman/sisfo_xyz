<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller 

{

	function __construct()

	{

		parent::__construct();

		$this->load->model('m_user');

		$this->load->model('m_login');

		if(!$this->session->userdata('username'))

		{

			redirect('login');

		}

	}

	public function index()

	{

		$this->session->set_userdata(array('location' => 'Setting Data Staff Cabang'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_cabang = $this->session->userdata('id_cabang');

		$id_user = $this->session->userdata('id_user');

		$data['id_cabang'] = $this->session->userdata('id_cabang');

		$session = $this->session->all_userdata();

		$data['user'] = $this->m_user->get_data_percabang($id_cabang);

		$data['get_jml_lap'] = $this->m_user->get_data_set_jml_lap($id_user);

		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));

		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));

		$data['firstname'] = strtoupper($data['namadepan'][0]);

		$data['tampilan'] = 'user/daftar_staff';

		//new	

		$this->load->view('layout/master', $data);

	}	

	//function input data

	public function simpan()

	{

		$this->session->set_userdata(array('location' => 'Proses Simpan'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');	

		//query simpan data staff

		if($this->m_user->simpan())

		{

			//load notifikasi sukses

			$this->session->set_flashdata('simpan_berhasil','Data baru berhasil ditambahkan');

			redirect('staff');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('simpan_gagal','Data baru gagal ditambahkan');

			redirect('staff');

		}

	}		

	public function prosesubah()

	{

		$this->session->set_userdata(array('location' => 'Proses Ubah'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$usernameLogin = $this->session->userdata('username');

		$id = $this->input->post('id');

		//Jika update data sukses

		if($this->m_user->ubah())

		{

			//load notifikasi sukses

			$this->session->set_flashdata('edit_berhasil','Data tersebut berhasil diperbaharui');

			redirect('staff');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('edit_gagal','Data tersebut gagal diperbaharui');

			redirect('staff');

		}

	}	

	//function hapus

	public function hapus($id)

	{

		$this->session->set_userdata(array('location' => 'Proses Hapus'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$usernameLogin = $this->session->userdata('username');

		//panggil query hapus di model		

		if($this->m_user->hapus($id)){

			$this->session->set_flashdata('hapus_berhasil','Data tersebut berhasil didelete');

			redirect('staff');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('hapus_gagal','Data tersebut gagal didelete');

			redirect('staff');

		}	

	}

	public function reset_pass($id)

	{

		$this->session->set_userdata(array('location' => 'Proses Reset Password'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$usernameLogin = $this->session->userdata('username');

		//panggil query hapus di model

		if($this->m_user->reset_pass($id)){

			$this->session->set_flashdata('reset_berhasil','Password Akun tersebut berhasil direset');

			redirect('staff');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('reset_gagal','Password Akun tersebut gagal direset');

			redirect('staff');

		}	

	}

	public function simpan_jml_lap()

	{

		$this->session->set_userdata(array('location' => 'Proses Simpan'));

		$data['sess_location'] = $this->session->userdata('location');	

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');

		$id_cabang = $this->session->userdata('id_cabang');	

		//query simpan data 

		if($this->m_user->simpan_jml_lap($id_user, $id_cabang))

		{

			//load notifikasi sukses

			$this->session->set_flashdata('simpan_berhasil','Data baru berhasil ditambahkan');

			redirect('staff');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('simpan_gagal','Data baru gagal ditambahkan');

			redirect('staff');

		}

	}	

	public function prosesubah_jml_lap()

	{

		$this->session->set_userdata(array('location' => 'Proses Ubah'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');

		$id_cabang = $this->session->userdata('id_cabang');

		//Jika update data sukses

		if($this->m_user->ubah_jml_lap($id_user,$id_cabang))

		{

			//load notifikasi sukses

			$this->session->set_flashdata('edit_berhasil','Data tersebut berhasil diperbaharui');

			redirect('staff');
			
		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('edit_gagal','Data tersebut gagal diperbaharui');

			redirect('staff');

		}

	}

}


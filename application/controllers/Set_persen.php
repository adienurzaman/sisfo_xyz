<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Set_persen extends CI_Controller 

{

	function __construct()

	{

		parent::__construct();

		$this->load->model('m_set_persen');

		$this->load->model('m_set_pelaporan');

		$this->load->model('m_login');

		if(!$this->session->userdata('username'))

		{

			redirect('login');

		}

	}

	public function index()

	{

		$level = $this->session->userdata('level_user');

		if($level!='Operator'){

			$this->session->set_flashdata('access_denied','Laman tersebut tidak dapat di akses');

			redirect('backend/welcome');

		}

		$this->session->set_userdata(array('location' => 'Setting Persentase Gaji'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');

		//get all data ON OPERATOR

		$data['get_persen'] = $this->m_set_persen->get_data($id_user);

		$data['get_set_al'] = $this->m_set_persen->get_data_set_al($id_user);

		$data['get_set_gaji_tm'] = $this->m_set_persen->get_data_set_tm($id_user);

		$data['get_set_by_op'] = $this->m_set_persen->get_data_set_by_op($id_user);

		$data['get_set_ongkos_belanja'] = $this->m_set_persen->get_data_set_ongkos_belanja($id_user);

		$data['get_set_input'] = $this->m_set_pelaporan->get_data($id_user);

		$session = $this->session->all_userdata();

		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));

		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));

		$data['firstname'] = strtoupper($data['namadepan'][0]);

		$data['tampilan'] = 'set_persen/daftar_set_persen';

		//new	

		$this->load->view('layout/master', $data);

	}

	public function simpan()

	{

		$this->session->set_userdata(array('location' => 'Proses Simpan'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');	

		//query simpan data

		if($this->m_set_persen->simpan($id_user))

		{

			//load notifikasi sukses

			$this->session->set_flashdata('simpan_berhasil','Data baru berhasil ditambahkan');

			redirect('set_persen');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('simpan_gagal','Data baru gagal ditambahkan');

			redirect('set_persen');

		}

	}		

	public function prosesubah()

	{

		$this->session->set_userdata(array('location' => 'Proses Ubah'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');

		//Jika update data sukses

		if($this->m_set_persen->ubah($id_user))

		{

			//load notifikasi sukses

			$this->session->set_flashdata('edit_berhasil','Data tersebut berhasil diperbaharui');

			redirect('set_persen');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('edit_gagal','Data tersebut gagal diperbaharui');

			redirect('set_persen');

		}

	}

	public function simpan_al()

	{

		$this->session->set_userdata(array('location' => 'Proses Simpan'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');	

		//query simpan data

		if($this->m_set_persen->simpan_al($id_user))

		{

			//load notifikasi sukses

			$this->session->set_flashdata('simpan_berhasil','Data baru berhasil ditambahkan');

			redirect('set_persen');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('simpan_gagal','Data baru gagal ditambahkan');

			redirect('set_persen');

		}

	}		

	public function prosesubah_al()

	{

		$this->session->set_userdata(array('location' => 'Proses Ubah'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');

		//Jika update data sukses

		if($this->m_set_persen->ubah_al($id_user))

		{

			//load notifikasi sukses

			$this->session->set_flashdata('edit_berhasil','Data tersebut berhasil diperbaharui');

			redirect('set_persen');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('edit_gagal','Data tersebut gagal diperbaharui');

			redirect('set_persen');

		}

	}

	public function simpan_tm()

	{

		$this->session->set_userdata(array('location' => 'Proses Simpan'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');

		if($this->m_set_persen->simpan_tm($id_user))

		{

			//load notifikasi sukses

			$this->session->set_flashdata('simpan_berhasil','Data baru berhasil ditambahkan');

			redirect('set_persen');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('simpan_gagal','Data baru gagal ditambahkan');

			redirect('set_persen');

		}

	}		

	public function prosesubah_tm()

	{

		$this->session->set_userdata(array('location' => 'Proses Ubah'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');

		//Jika update data sukses

		if($this->m_set_persen->ubah_tm($id_user))

		{

			//load notifikasi sukses

			$this->session->set_flashdata('edit_berhasil','Data tersebut berhasil diperbaharui');

			redirect('set_persen');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('edit_gagal','Data tersebut gagal diperbaharui');

			redirect('set_persen');

		}

	}

	public function simpan_bop()

	{

		$this->session->set_userdata(array('location' => 'Proses Simpan'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');

		if($this->m_set_persen->simpan_bop($id_user))

		{

			//load notifikasi sukses

			$this->session->set_flashdata('simpan_berhasil','Data baru berhasil ditambahkan');

			redirect('set_persen');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('simpan_gagal','Data baru gagal ditambahkan');

			redirect('set_persen');

		}

	}		

	public function prosesubah_bop()

	{

		$this->session->set_userdata(array('location' => 'Proses Ubah'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');

		//Jika update data sukses

		if($this->m_set_persen->ubah_bop($id_user))

		{

			//load notifikasi sukses

			$this->session->set_flashdata('edit_berhasil','Data tersebut berhasil diperbaharui');

			redirect('set_persen');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('edit_gagal','Data tersebut gagal diperbaharui');

			redirect('set_persen');

		}

	}

	public function simpan_ob()

	{

		$this->session->set_userdata(array('location' => 'Proses Simpan'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');

		if($this->m_set_persen->simpan_ob($id_user))

		{

			//load notifikasi sukses

			$this->session->set_flashdata('simpan_berhasil','Data baru berhasil ditambahkan');

			redirect('set_persen');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('simpan_gagal','Data baru gagal ditambahkan');

			redirect('set_persen');

		}

	}		

	public function prosesubah_ob()

	{

		$this->session->set_userdata(array('location' => 'Proses Ubah'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');

		//Jika update data sukses

		if($this->m_set_persen->ubah_ob($id_user))

		{

			//load notifikasi sukses

			$this->session->set_flashdata('edit_berhasil','Data tersebut berhasil diperbaharui');

			redirect('set_persen');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('edit_gagal','Data tersebut gagal diperbaharui');

			redirect('set_persen');

		}

	}

	//function hapus

	public function hapus($id)

	{

		$this->session->set_userdata(array('location' => 'Proses Hapus'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		//panggil query hapus di model

		if($this->m_set_persen->hapus($id)){

			$this->session->set_flashdata('hapus_berhasil','Data tersebut berhasil didelete');

			redirect('set_persen');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('hapus_gagal','Data tersebut gagal didelete');

			redirect('set_persen');

		}	

	}

	public function hapus_tm($id)

	{

		$this->session->set_userdata(array('location' => 'Proses Hapus'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		//panggil query hapus di model

		if($this->m_set_persen->hapus_tm($id)){

			$this->session->set_flashdata('hapus_berhasil','Data tersebut berhasil didelete');

			redirect('set_persen');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('hapus_gagal','Data tersebut gagal didelete');

			redirect('set_persen');

		}	

	}

	public function hapus_bop($id)

	{

		$this->session->set_userdata(array('location' => 'Proses Hapus'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		//panggil query hapus di model

		if($this->m_set_persen->hapus_bop($id)){

			$this->session->set_flashdata('hapus_berhasil','Data tersebut berhasil didelete');

			redirect('set_persen');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('hapus_gagal','Data tersebut gagal didelete');

			redirect('set_persen');

		}	

	}

	public function hapus_ob($id)

	{

		$this->session->set_userdata(array('location' => 'Proses Hapus'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		//panggil query hapus di model

		if($this->m_set_persen->hapus_ob($id)){

			$this->session->set_flashdata('hapus_berhasil','Data tersebut berhasil didelete');

			redirect('set_persen');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('hapus_gagal','Data tersebut gagal didelete');

			redirect('set_persen');

		}	

	}

}


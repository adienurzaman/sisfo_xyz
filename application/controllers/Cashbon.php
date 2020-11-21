<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cashbon extends CI_Controller 

{

	function __construct()

	{

		parent::__construct();

		$this->load->model('m_cashbon');

		$this->load->model('m_omzet_harian');

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

		$this->session->set_userdata(array('location' => 'Rekapitulasi Cashbon'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_set = $this->input->post('id_set');

		if(empty($id_set)){

			$data['get_id']='1';

			$id_user = $this->session->userdata('id_user');

			$id_cabang = $this->session->userdata('id_cabang');

			//get all data ON Operator

			$data['get_jml_lap'] = $this->m_omzet_harian->get_jml_lap($id_user, $id_cabang);

			$data['get_kasbon'] = $this->m_cashbon->get_data($id_user);

			$data['get_set_input'] = $this->m_set_pelaporan->get_data($id_user);

		}else{

			$data['get_id']='2';

			$id_user = $this->session->userdata('id_user');

			$id_cabang = $this->session->userdata('id_cabang');

			if($id_set=='reset'){

				redirect('cashbon');

			}

			//get all data ON Operator

			$data['get_jml_lap'] = $this->m_omzet_harian->get_jml_lap($id_user, $id_cabang);

			$data['get_kasbon'] = $this->m_cashbon->get_data_pencarian($id_user,$id_set);

			$data['get_set_input'] = $this->m_set_pelaporan->get_data($id_user);

		}

		$session = $this->session->all_userdata();

		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));

		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));

		$data['firstname'] = strtoupper($data['namadepan'][0]);

		$data['tampilan'] = 'cashbon/daftar_cashbon';

		$this->load->view('layout/master', $data);

	}

	private function cari_kasbon()

	{

		$this->session->set_userdata(array('location' => 'Proses Cari Data Kasbon'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');

		$id_set = $this->input->post('id_set');

		if($id_set=='reset'){

			redirect('cashbon');

		}

		//get all data ON Operator

		$data['get_kasbon'] = $this->m_cashbon->get_data_pencarian($id_user,$id_set);

		$data['get_set_input'] = $this->m_set_pelaporan->get_data($id_user);

		$session = $this->session->all_userdata();

		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));

		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));

		$data['firstname'] = strtoupper($data['namadepan'][0]);

		$data['tampilan'] = 'cashbon/daftar_cashbon';

		$this->load->view('layout/master', $data);

	}

	public function simpan()

	{

		$this->session->set_userdata(array('location' => 'Proses Simpan'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');

		if($this->m_cashbon->simpan($id_user))

		{

			$this->session->set_flashdata('simpan_berhasil','Data baru berhasil ditambahkan');

			redirect('cashbon');

		}else{

			$this->session->set_flashdata('simpan_gagal','Data baru gagal ditambahkan atau Data sudah pernah diinputkan');

			redirect('cashbon');

		}

	}		

	public function prosesubah()

	{

		$this->session->set_userdata(array('location' => 'Proses Ubah'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$usernameLogin = $this->session->userdata('username');

		if($this->m_cashbon->ubah())

		{

			$this->session->set_flashdata('edit_berhasil','Data tersebut berhasil diperbaharui');

			redirect('cashbon');

		}else{

			$this->session->set_flashdata('edit_gagal','Data tersebut gagal diperbaharui');

			redirect('cashbon');

		}

	}	

	public function hapus($id)

	{

		$this->session->set_userdata(array('location' => 'Proses Hapus'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$usernameLogin = $this->session->userdata('username');

		if($this->m_cashbon->hapus($id)){

			$this->session->set_flashdata('hapus_berhasil','Data tersebut berhasil didelete');

			redirect('cashbon');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('hapus_gagal','Data tersebut gagal didelete');

			redirect('cashbon');

		}	

	}

	public function get_tgl($id){
		$this->db->from('credit_set_input');
		$this->db->where('id_set',$id);
		$query = $this->db->get();
		echo json_encode($query->row());
	}

}


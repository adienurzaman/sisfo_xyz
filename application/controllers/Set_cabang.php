<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* End of file Set_cabang.php */

/* Location: ./application/controllers/Set_cabang.php */

class Set_cabang extends CI_Controller {
	
	function __construct()

	{

		parent::__construct();

		$this->load->model('m_cabang');

		if(!$this->session->userdata('username'))

		{

			redirect('login');

		}

	}

	public function index()

	{

		$level = $this->session->userdata('level_user');

		if($level!='Admin'){

			$this->session->set_flashdata('access_denied','Laman tersebut tidak dapat di akses');

			redirect('backend/welcome','refresh');

		}

		$this->session->set_userdata(array('location' => 'Setting Cabang'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		//get all data ON Operator

		$data['cabang'] = $this->m_cabang->tampil_data();

		$session = $this->session->all_userdata();

		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));

		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));

		$data['firstname'] = strtoupper($data['namadepan'][0]);

		$data['tampilan'] = 'set_cabang/data_cabang';

		//new

		$this->load->view('layout/master', $data);

	}

	public function simpan()

	{

		$edit = $this->m_cabang->simpan_data();

		if($edit){

			$this->session->set_flashdata('simpan_berhasil', 'Simpan data berhasil');

			redirect('set_cabang');

		}else{

			$this->session->set_flashdata('simpan_gagal', 'Simpan Data Gagal');

			redirect('set_cabang');

		}

	}

	public function edit()

	{

		$edit = $this->m_cabang->edit_data();

		if($edit){

			$this->session->set_flashdata('edit_berhasil', 'Edit data berhasil');

			redirect('set_cabang');

		}else{

			$this->session->set_flashdata('edit_gagal', 'Edit Data Gagal');

			redirect('set_cabang');

		}

	}

	public function hapus($id_cabang)

	{

		$hapus = $this->m_cabang->hapus_data($id_cabang);

		if($hapus){

			$this->session->set_flashdata('hapus_berhasil', 'Hapus Data Set Cabang Berhasil');

			redirect('set_cabang');

		}else{

			$this->session->set_flashdata('hapus_gagal', 'Hapus Data Set Cabang Gagal');

			redirect('set_cabang');

		}

	}

}


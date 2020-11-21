<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Posisi_uang extends CI_Controller 

{

	function __construct()

	{

		parent::__construct();

		$this->load->model('m_omzet_harian');

		$this->load->model('m_cashbon');

		$this->load->model('m_biaya_op');

		$this->load->model('m_set_pelaporan');

		$this->load->model('m_set_persen');

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

		$this->session->set_userdata(array('location' => 'Informasi Posisi/Keadaan Uang'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_set = $this->input->post('id_set');

		if(empty($id_set)){

			$data['get_id']=1;

			$id_user = $this->session->userdata('id_user');			

			//get all data ON Operator

			$data['get_omzet'] = $this->m_omzet_harian->get_data($id_user);

			$data['get_all'] = $this->m_omzet_harian->get_data_all($id_user);

			$data['get_kasbon'] = $this->m_cashbon->get_data($id_user);

			$data['get_biaya'] = $this->m_biaya_op->get_data($id_user);

			$data['get_set_input'] = $this->m_set_pelaporan->get_data($id_user);

			$data['get_persen'] = $this->m_set_persen->get_data($id_user);

		}else{

			$data['get_id']=2;

			$id_user = $this->session->userdata('id_user');

			if($id_set=='reset'){

				redirect('posisi_uang');

			}
			//get all data ON Operator			

			$data['get_omzet'] = $this->m_omzet_harian->get_data_pencarian($id_user,$id_set);

			$data['get_kasbon'] = $this->m_cashbon->get_data_pencarian($id_user,$id_set);

			$data['get_biaya'] = $this->m_biaya_op->get_data_pencarian($id_user,$id_set);

			$data['get_all'] = $this->m_omzet_harian->get_pencarian_data_all($id_user,$id_set);

			$data['get_set_input'] = $this->m_set_pelaporan->get_data($id_user);

		}

		$session = $this->session->all_userdata();

		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));

		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));

		$data['firstname'] = strtoupper($data['namadepan'][0]);

		$data['tampilan'] = 'posisi_uang/daftar_posisi_uang';

		//new

		$this->load->view('layout/master', $data);

	}

	private function cari_all_data()

	{

		$this->session->set_userdata(array('location' => 'Informasi Posisi/Keadaan Uang'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');

		$id_set = $this->input->post('id_set');

		if($id_set=='reset'){

			redirect('posisi_uang');

		}
		//get all data ON Operator		

		$data['get_omzet'] = $this->m_omzet_harian->get_data_pencarian($id_user,$id_set);

		$data['get_kasbon'] = $this->m_cashbon->get_data_pencarian($id_user,$id_set);

		$data['get_biaya'] = $this->m_biaya_op->get_data_pencarian($id_user,$id_set);

		$data['get_all'] = $this->m_omzet_harian->get_pencarian_data_all($id_user,$id_set);

		$data['get_set_input'] = $this->m_set_pelaporan->get_data($id_user);

		$session = $this->session->all_userdata();

		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));

		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));

		$data['firstname'] = strtoupper($data['namadepan'][0]);

		$data['tampilan'] = 'posisi_uang/daftar_posisi_uang';

		//new

		$this->load->view('layout/master', $data);

	}

}


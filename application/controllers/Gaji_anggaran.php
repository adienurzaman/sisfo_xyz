<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji_anggaran extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_gaji_anggaran');
		$this->load->model('m_set_pelaporan');
		$this->load->model('m_set_persen');
		$this->load->model('m_omzet_harian');
		$this->load->model('m_user');
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
		$this->session->set_userdata(array('location' => 'Kontribusi Gaji & By Operasional'));
		$data['sess_location'] = $this->session->userdata('location');
		$data['session'] = $this->session->all_userdata();
		$username = $this->session->userdata('username');
		$id_set = $this->input->post('id_set');
		if(empty($id_set)){
			$id_user = $this->session->userdata('id_user');
			//get all data ON Operator
			$data['get_id'] = '1';
			$id_cabang = $this->session->userdata('id_cabang');
			$jabatan_sales = 'Sales';
			$jabatan_tl1 = 'Team Leader 1';
			$jabatan_tl2 = 'Team Leader 2';
			$jabatan_gl = 'Gruof Leader';
			$jabatan_al = 'Asis Leader';
			$data['get_sales'] = $this->m_user->get_data_sales($id_cabang,$jabatan_sales);
			$data['get_tl1'] = $this->m_user->get_data_tl1($id_cabang,$jabatan_tl1);
			$data['get_tl2'] = $this->m_user->get_data_tl2($id_cabang,$jabatan_tl2);
			$data['get_gl'] = $this->m_user->get_data_gl($id_cabang,$jabatan_gl);
			$data['get_al'] = $this->m_user->get_data_al($id_cabang,$jabatan_al);

			$data['get_omzet'] = $this->m_gaji_anggaran->get_data($id_user);
			$data['get_set_input'] = $this->m_set_pelaporan->get_data($id_user);
			$data['get_persen'] = $this->m_set_persen->get_data($id_user);
			$data['get_gaji_al'] = $this->m_set_persen->get_data_set_al($id_user);
			$data['get_jml_lap'] = $this->m_user->get_data_set_jml_lap($id_user);

			$data['get_gaji_tm'] = $this->m_set_persen->get_data_set_tm($id_user);
			$data['get_bop'] = $this->m_set_persen->get_data_set_by_op($id_user);
			$data['get_ob'] = $this->m_set_persen->get_data_set_ongkos_belanja($id_user);
		}else{
			$id_user = $this->session->userdata('id_user');
			$id_cabang = $this->session->userdata('id_cabang');
			$jabatan_sales = 'Sales';
			$jabatan_tl1 = 'Team Leader 1';
			$jabatan_tl2 = 'Team Leader 2';
			$jabatan_gl = 'Gruof Leader';
			$jabatan_al = 'Asis Leader';
			$data['get_sales'] = $this->m_user->get_data_sales($id_cabang,$jabatan_sales);
			$data['get_tl1'] = $this->m_user->get_data_tl1($id_cabang,$jabatan_tl1);
			$data['get_tl2'] = $this->m_user->get_data_tl2($id_cabang,$jabatan_tl2);
			$data['get_gl'] = $this->m_user->get_data_gl($id_cabang,$jabatan_gl);
			$data['get_al'] = $this->m_user->get_data_al($id_cabang,$jabatan_al);
			if($id_set=='reset'){
				redirect('gaji_anggaran');
			}
			//get all data ON Operator
			$data['get_id'] = '2';
			$data['id_set_tmp'] = $id_set;
			$data['get_omzet'] = $this->m_gaji_anggaran->get_pencarian_data($id_user,$id_set);
			$data['get_set_input'] = $this->m_set_pelaporan->get_data($id_user);
			$data['get_persen'] = $this->m_set_persen->get_data($id_user);
			$data['get_gaji_al'] = $this->m_set_persen->get_data_set_al($id_user);
			$data['get_jml_lap'] = $this->m_user->get_data_set_jml_lap($id_user);

			$data['get_gaji_tm'] = $this->m_set_persen->get_data_pencarian_set_tm($id_user,$id_set);
			$data['get_bop'] = $this->m_set_persen->get_data_pencarian_set_by_op($id_user,$id_set);
			$data['get_ob'] = $this->m_set_persen->get_data_pencarian_set_ongkos_belanja($id_user,$id_set);
		}

		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));
		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));
		$data['firstname'] = strtoupper($data['namadepan'][0]);
		$data['tampilan'] = 'gaji_anggaran/daftar_gaji_anggaran';
		//new
		$this->load->view('layout/master', $data);
	}

	private function cari_gaji()
	{
		$this->session->set_userdata(array('location' => 'Proses Cari Data Gaji'));
		$data['sess_location'] = $this->session->userdata('location');
		$data['session'] = $this->session->all_userdata();
		$username = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$id_set = $this->input->post('id_set');
		$id_cabang = $this->session->userdata('id_cabang');
		$jabatan_sales = 'Sales';
		$jabatan_tl1 = 'Team Leader 1';
		$jabatan_tl2 = 'Team Leader 2';
		$jabatan_gl = 'Gruof Leader';
		$jabatan_al = 'Asis Leader';
		$data['get_sales'] = $this->m_user->get_data_sales($id_cabang,$jabatan_sales);
		$data['get_tl1'] = $this->m_user->get_data_tl1($id_cabang,$jabatan_tl1);
		$data['get_tl2'] = $this->m_user->get_data_tl2($id_cabang,$jabatan_tl2);
		$data['get_gl'] = $this->m_user->get_data_gl($id_cabang,$jabatan_gl);
		$data['get_al'] = $this->m_user->get_data_al($id_cabang,$jabatan_al);
		if($id_set=='reset'){
			redirect('gaji_anggaran');
		}
		//get all data ON Operator
		$data['get_id'] = '2';
		$data['get_omzet'] = $this->m_gaji_anggaran->get_pencarian_data($id_user,$id_set);
		$data['get_set_input'] = $this->m_set_pelaporan->get_data($id_user);
		$data['get_persen'] = $this->m_set_persen->get_data($id_user);
		$data['get_gaji_al'] = $this->m_set_persen->get_data_set_al($id_user);

		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));
		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));
		$data['firstname'] = strtoupper($data['namadepan'][0]);
		$data['tampilan'] = 'gaji_anggaran/daftar_gaji_anggaran';
		//new
		$this->load->view('layout/master', $data);
	}
}

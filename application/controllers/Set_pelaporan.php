<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Set_pelaporan extends CI_Controller 

{

	function __construct()

	{

		parent::__construct();

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

		$this->session->set_userdata(array('location' => 'Setting Pelaporan Input Data Credit'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');

		//get all data ON Operator

		$data['get_pelaporan'] = $this->m_set_pelaporan->get_data($id_user);

		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));

		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));

		$data['firstname'] = strtoupper($data['namadepan'][0]);

		$data['tampilan'] = 'set_pelaporan/daftar_set_pelaporan';

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

		$id_user = $this->session->userdata('id_user');	

		//query simpan data 

		//load notifikasi sukses
		$id_cabang = $this->session->userdata('id_cabang');
		
		if($this->m_set_pelaporan->simpan($id_user))

		{			
			
			$this->_notifikasi_input_available($id_cabang,"Sales","-");

			$this->_notifikasi_for_admin("Owner","Admin");

			$this->session->set_flashdata('simpan_berhasil','Data baru berhasil ditambahkan');

			redirect('set_pelaporan');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('simpan_gagal','Data baru gagal ditambahkan');

			redirect('set_pelaporan');

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

		if($this->m_set_pelaporan->ubah($id))

		{
			//load notifikasi sukses

			$this->session->set_flashdata('edit_berhasil','Data tersebut berhasil diperbaharui');

			redirect('set_pelaporan');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('edit_gagal','Data tersebut gagal diperbaharui');

			redirect('set_pelaporan');

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

		if($this->m_set_pelaporan->hapus($id)){

			$this->session->set_flashdata('hapus_berhasil','Data tersebut berhasil didelete');

			redirect('set_pelaporan');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('hapus_gagal','Data tersebut gagal didelete');

			redirect('set_pelaporan');

		}	

	}

	private function _notifikasi_input_available($id_cabang,$jabatan,$level_user)

	{	

		$this->db->from('credit_set_cabang');

		$this->db->where('id_cabang',$id_cabang);

		$query = $this->db->get();

		$row = $query->row();

    	# ========================================

		$judul = "Informasi Input Omzet Harian";

		$isi_pesan = "ID Input Omzet untuk Minggu ini telah didaftarkan oleh Operator, kepada setiap ".$jabatan." pada Cabang ".$id_cabang." (".$row->nama_cabang.") CV Xyz. Segera melakukan Input Omzet Harian. Terimakasih";

		$heading = array(

			"en" => $judul

		);

		$content = array(

			"en" => $isi_pesan

		);

		$hashes_array = array();

		array_push($hashes_array, array(
			"id" => "open-button",
			"text" => "Buka Situs",
			"icon" => "",
			"url" => "https://xyz.senjamaja.id/omzet"
		));

		$fields = array(

			'app_id' => "ceb65919-9e25-4c49-a38a-4f137dc2826f",

			// 'included_segments' => array('All'),

			// 'include_player_ids' => array("be1a007b-0db3-4c32-bc2a-dd3685e1c64c"),

			'filters' => array(array("field" => "tag", "key" => "id_cabang", "relation" => "=", "value" => $id_cabang),array("operator" => "AND"),array("field" => "tag", "key" => "jabatan", "relation" => "=", "value" => $jabatan)),

			'data' => array("pilih_activity" => "home"),

			'headings' => $heading,

			'contents' => $content,

			'web_buttons' => $hashes_array,

			'status' => TRUE

		);		

		$fields = json_encode($fields);

		echo $fields;

    	// print("\nJSON sent:\n");

    	// print($fields);		

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");

		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',

			'Authorization: Basic NTRkMTc3ZTYtNWJjMi00YTY1LWI1ZWUtNjg5ZDVhYjVmNWE3'));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		curl_setopt($ch, CURLOPT_POST, TRUE);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);

		curl_close($ch);

	}

	private function _notifikasi_for_admin($jabatan,$level_user)

	{	

    	# ========================================

		$judul = "Informasi Proses Input Omzet Harian";

		$isi_pesan = "Proses peng-inputan Data Omzet Harian setiap Cabang sedang dilaksanakan. Silahkan untuk mengecek hasil inputan pada Halaman View Proggress yang telah tersedia pada Panel Adminitrator";

		$heading = array(

			"en" => $judul

		);

		$content = array(

			"en" => $isi_pesan

		);

		$hashes_array = array();

		array_push($hashes_array, array(
			"id" => "open-button",
			"text" => "Buka Situs",
			"icon" => "",
			"url" => "https://xyz.senjamaja.id/view_progress"
		));

		$fields = array(

			'app_id' => "ceb65919-9e25-4c49-a38a-4f137dc2826f",

			// 'included_segments' => array('All'),

			// 'include_player_ids' => array("be1a007b-0db3-4c32-bc2a-dd3685e1c64c"),

			'filters' => array(array("field" => "tag", "key" => "jabatan", "relation" => "=", "value" => $jabatan),array("operator" => "AND"),array("field" => "tag", "key" => "level_user", "relation" => "=", "value" => $level_user)),

			'data' => array("pilih_activity" => "home"),

			'headings' => $heading,

			'contents' => $content,

			'web_buttons' => $hashes_array,

			'status' => TRUE

		);		

		$fields = json_encode($fields);

		echo $fields;

    	// print("\nJSON sent:\n");

    	// print($fields);		

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");

		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',

			'Authorization: Basic NTRkMTc3ZTYtNWJjMi00YTY1LWI1ZWUtNjg5ZDVhYjVmNWE3'));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		curl_setopt($ch, CURLOPT_POST, TRUE);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);

		curl_close($ch);

	}

}


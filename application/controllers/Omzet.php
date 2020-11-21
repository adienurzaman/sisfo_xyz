<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Omzet extends CI_Controller 

{

	function __construct()

	{

		parent::__construct();

		$this->load->model('m_omzet_harian');

		$this->load->model('m_set_pelaporan');

		$this->load->model('m_set_persen');

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

		if($level!='Operator' && $level!='-'){

			$this->session->set_flashdata('access_denied','Laman tersebut tidak dapat di akses');

			redirect('backend/welcome');

		}

		$this->session->set_userdata(array('location' => 'Rekapitulasi Omzet Harian'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_set = $this->input->post('id_set');

		if(empty($id_set)){

			if($level == "Operator"){

				$id_user = $this->session->userdata('id_user');

				$id_cabang = $this->session->userdata('id_cabang');

			}else{
				
				$id_cabang = $this->session->userdata('id_cabang');

				$this->db->from('credit_user');

				$this->db->where('id_cabang', $id_cabang);

				$this->db->where('level_user', 'Operator');

				$query = $this->db->get();

				$row = $query->row();

				$id_user = $row->id_user;

			}			

			$jabatan_sales = 'Sales';

			//get all data ON Operator

			$data['id']='0';

			$data['get_jml_lap'] = $this->m_omzet_harian->get_jml_lap($id_user, $id_cabang);

			$data['get_omzet'] = $this->m_omzet_harian->get_data($id_user);

			$data['get_set_input'] = $this->m_set_pelaporan->get_data($id_user);

			$data['get_persen'] = $this->m_set_persen->get_data($id_user);

			$data['get_sales'] = $this->m_user->get_data_sales($id_cabang,$jabatan_sales);

		}else{

			if($level == "Operator"){

				$id_user = $this->session->userdata('id_user');

				$id_cabang = $this->session->userdata('id_cabang');

			}else{
				
				$id_cabang = $this->session->userdata('id_cabang');

				$this->db->from('credit_user');

				$this->db->where('id_cabang', $id_cabang);

				$this->db->where('level_user', 'Operator');

				$query = $this->db->get();

				$row = $query->row();

				$id_user = $row->id_user;

			}

			$jabatan_sales = 'Sales';

			$id_set = $this->input->post('id_set');

			if($id_set=='reset'){

				redirect('omzet');

			}

			//get all data ON Operator

			$data['get_jml_lap'] = $this->m_omzet_harian->get_jml_lap($id_user, $id_cabang);

			$data['get_omzet'] = $this->m_omzet_harian->get_data_pencarian($id_user,$id_set);

			$data['get_set_input'] = $this->m_set_pelaporan->get_data($id_user);

			$data['get_sales'] = $this->m_user->get_data_sales($id_cabang,$jabatan_sales);

			$data['id']='1';

		}

		$session = $this->session->all_userdata();

		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));

		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));

		$data['firstname'] = strtoupper($data['namadepan'][0]);

		if($level == "Operator"){

			$data['tampilan'] = 'omzet_harian/daftar_omzet_harian';

		}else{
			
			$data['tampilan'] = 'omzet_harian/daftar_omzet_sales';			

		}

		//new

		$this->load->view('layout/master', $data);

	}

	private function cari_omzet()

	{

		$this->session->set_userdata(array('location' => 'Proses Cari Data Omzet'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$id_user = $this->session->userdata('id_user');

		$id_cabang = $this->session->userdata('id_cabang');

		$jabatan_sales = 'Sales';

		$id_set = $this->input->post('id_set');

		if($id_set=='reset'){

			redirect('omzet');

		}

		//get all data ON Operator

		$data['get_omzet'] = $this->m_omzet_harian->get_data_pencarian($id_user,$id_set);

		$data['get_set_input'] = $this->m_set_pelaporan->get_data($id_user);

		$data['get_sales'] = $this->m_user->get_data_sales($id_cabang,$jabatan_sales);

		$data['id']='1';

		$session = $this->session->all_userdata();

		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));

		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));

		$data['firstname'] = strtoupper($data['namadepan'][0]);

		$data['tampilan'] = 'omzet_harian/daftar_omzet_harian';

		$this->load->view('layout/master', $data);

	}

	public function simpan()

	{

		$this->session->set_userdata(array('location' => 'Proses Simpan'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		$jabatan = $this->session->userdata('jabatan');

		$level = $this->session->userdata('level_user');

		$id_set = $this->input->post('id_set');

		$tanggal = $this->input->post('tanggal');

		if($level == "Operator"){

			$id_user = $this->session->userdata('id_user');

			$id_cabang = $this->session->userdata('id_cabang');

		}else{

			$id_cabang = $this->session->userdata('id_cabang');

			$this->db->from('credit_user');

			$this->db->where('id_cabang', $id_cabang);

			$this->db->where('level_user', 'Operator');

			$query = $this->db->get();

			$row = $query->row();

			$id_user = $row->id_user;

			$id_user_2 = $this->session->userdata('id_user');

		}		

		//load notifikasi sukses
		if($this->m_omzet_harian->simpan($id_user))

		{

			if($jabatan == 'Sales'){

				$this->_notifikasi_for_op($id_set,$tanggal,$id_cabang,$id_user_2,"Operator");

			}

			$this->session->set_flashdata('simpan_berhasil','Data baru berhasil ditambahkan');

			redirect('omzet');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('simpan_gagal','Data baru gagal ditambahkan atau Data sudah pernah diinputkan');

			redirect('omzet');

		}

	}		

	public function prosesubah()

	{

		$this->session->set_userdata(array('location' => 'Proses Ubah'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$usernameLogin = $this->session->userdata('username');

		$id_cabang = $this->session->userdata('id_cabang');

		$jabatan = $this->session->userdata('jabatan');

		$id_user = $this->session->userdata('id_user');

		$id_set = $this->input->post('id_set');

		$tanggal = $this->input->post('tanggal');

		if($this->m_omzet_harian->ubah())

		{

			if($jabatan == 'Sales'){

				$this->_notifikasi_for_op($id_set,$tanggal,$id_cabang,$id_user,"Operator");

			}

			//load notifikasi sukses

			$this->session->set_flashdata('edit_berhasil','Data tersebut berhasil diperbaharui');

			redirect('omzet');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('edit_gagal','Data tersebut gagal diperbaharui');

			redirect('omzet');

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

		if($this->m_omzet_harian->hapus($id)){

			$this->session->set_flashdata('hapus_berhasil','Data tersebut berhasil didelete');

			redirect('omzet');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('hapus_gagal','Data tersebut gagal didelete');

			redirect('omzet');

		}	

	}

	public function get_tgl($id){
		$this->db->from('credit_set_input');
		$this->db->where('id_set',$id);
		$query = $this->db->get();
		echo json_encode($query->row());
	}


	private function _notifikasi_for_op($id_set,$tanggal,$id_cabang,$id_user,$level_user)

	{	

		$this->db->from('credit_set_input');

		$this->db->where('id_set',$id_set);

		$query3 = $this->db->get();

		$row3 = $query3->row();

    	# ========================================

		$this->db->from('credit_user');

		$this->db->where('id_user',$id_user);

		$query2 = $this->db->get();

		$row2 = $query2->row();

    	# ========================================

		$this->db->from('credit_set_cabang');

		$this->db->where('id_cabang',$id_cabang);

		$query = $this->db->get();

		$row = $query->row();

    	# ========================================

		$judul = "Informasi Input Omzet Harian";

		$isi_pesan = "Atas nama ".$row2->namauser.", Sales Lapangan ".$row2->id_lapangan.", Cabang ".$id_cabang." ( ".$row->nama_cabang." ), berhasil menginput data Omzet Bulan : ".$row3->bulan.", Minggu : ".$row3->minggu.", Tanggal : ".$tanggal.". Untuk mengecek hasil input yang telah dilakukan, silahkan untuk membuka menu Rekapitulasi Omzet Harian pada aplikasi ini. Klik tombol Buka Situs dibawah. Terimakasih";

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

			'filters' => array(array("field" => "tag", "key" => "id_cabang", "relation" => "=", "value" => $id_cabang),array("operator" => "AND"),array("field" => "tag", "key" => "level_user", "relation" => "=", "value" => $level_user)),

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


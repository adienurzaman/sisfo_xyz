<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 

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

		$this->session->set_userdata(array('location' => 'Setting Data User'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		//get all data ON ADMIN

		$data['user'] = $this->m_user->get_data();

		$data['cabang'] = $this->m_user->get_cabang();

		//get all data ON OPERATOR

		$session = $this->session->all_userdata();

		if($session['level_user']=='Operator'){

			$data['user'] = $this->m_user->get_data_individual($username);

		}

		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));

		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));

		$data['firstname'] = strtoupper($data['namadepan'][0]);

		$data['tampilan'] = 'user/daftar_user';

		//new	

		$this->load->view('layout/master', $data);

	}

	public function set_data_pribadi()

	{

		$this->session->set_userdata(array('location' => 'Setting Data Pribadi'));

		$data['sess_location'] = $this->session->userdata('location');

		$data['session'] = $this->session->all_userdata();

		$username = $this->session->userdata('username');

		//get all data ON ADMIN

		$data['user'] = $this->m_user->get_data();

		$data['cabang'] = $this->m_user->get_cabang();

		//get all data ON OPERATOR

		$session = $this->session->all_userdata();

		if($session['level_user']=='Operator'){

			$data['user'] = $this->m_user->get_data_individual($username);

		}

		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));

		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));

		$data['firstname'] = strtoupper($data['namadepan'][0]);

		$data['tampilan'] = 'user/data_pribadi';

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

		//query simpan data

		if($this->m_user->simpan())

		{

			//load notifikasi sukses

			$this->session->set_flashdata('simpan_berhasil','Data baru berhasil ditambahkan');

			redirect('user');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('simpan_gagal','Data baru gagal ditambahkan');

			redirect('user');

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

			redirect('user');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('edit_gagal','Data tersebut gagal diperbaharui');

			redirect('user');

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

			redirect('user');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('hapus_gagal','Data tersebut gagal didelete');

			redirect('user');

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

			redirect('user','refresh');

		}else{

			//load notifikasi gagal

			$this->session->set_flashdata('reset_gagal','Password Akun tersebut gagal direset');

			redirect('user','refresh');

		}	

	}

	public function get_data_user($id){

		$this->db->from('credit_user');

		$this->db->where('id_user',$id);

		$query = $this->db->get();

		$json = json_encode($query->row());

		echo $json;

	}

	public function ajax_ubah_username(){

		$username = $this->input->post('username');

		$id_user = $this->input->post('id_user');

		$data = array('username' => $username);

		$query = $this->db->update('credit_user', $data, array('id_user' => $id_user));

		if($query){

			$response['status'] = true;

			echo json_encode($response);

		}else{

			$response['status'] = false;

			echo json_encode($response);

		}

	}

	public function ajax_ubah_namauser(){

		$namauser = $this->input->post('namauser');

		$id_user = $this->input->post('id_user');

		$data = array('namauser' => $namauser);

		$query = $this->db->update('credit_user', $data, array('id_user' => $id_user));

		if($query){

			$response['status'] = true;

			echo json_encode($response);

		}else{

			$response['status'] = false;

			echo json_encode($response);

		}

	}

	public function ajax_ubah_email(){

		$email = $this->input->post('email');

		$id_user = $this->input->post('id_user');

		$data = array('email' => $email);

		$query = $this->db->update('credit_user', $data, array('id_user' => $id_user));

		if($query){

			$response['status'] = true;

			echo json_encode($response);

		}else{

			$response['status'] = false;

			echo json_encode($response);

		}

	}

	public function ajax_ubah_no_tlp(){

		$no_tlp = $this->input->post('no_tlp');

		$id_user = $this->input->post('id_user');



		$data = array('no_tlp' => $no_tlp);

		$query = $this->db->update('credit_user', $data, array('id_user' => $id_user));

		if($query){

			$response['status'] = true;

			echo json_encode($response);

		}else{

			$response['status'] = false;

			echo json_encode($response);

		}

	}

	public function temp_password(){

		if ($this->input->server('REQUEST_METHOD') == 'POST') {

	        $id_user = $this->session->userdata('id_user');

	        $temp_password = md5($this->input->post('temp_password'));

	        $this->db->from('credit_user');

	        $this->db->where('id_user',$id_user);

	        $this->db->where('password',$temp_password);

	        $query = $this->db->get();

	        if($query->num_rows() > 0){

	        	echo "benar";

	        }else{

	         	echo "salah";

	        }

    	}

    }

    public function gantiPassword(){

    	if ($this->input->server('REQUEST_METHOD') == 'POST') {

	    	$id_user = $this->session->userdata('id_user');

	        $new_password = md5($this->input->post('new_password'));

		    $this->db->set('password',$new_password);

			$this->db->where('id_user', $id_user);

			$this->db->update('credit_user');

			$this->session->set_flashdata('ubah_berhasil','Password Berhasil Di ubah');

		  	redirect('login/logout');

		}

    }

}


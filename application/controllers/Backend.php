<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Backend extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_user');
		if(!$this->session->userdata('username'))
		{
			redirect('login');
		}
	}

	public function welcome()
	{
		$this->session->set_userdata(array('location' => 'Welcome Page'));
		$data['sess_location'] = $this->session->userdata('location');
		$data['session'] = $this->session->all_userdata();
		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));
		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));
		$data['firstname'] = strtoupper($data['namadepan'][0]);
		$data['tampilan'] = 'utama/index';

		$this->load->view('layout/master', $data);
	}
	public function dashboard()
	{
		$this->session->set_userdata(array('location' => 'Dashboard'));
		$data['sess_location'] = $this->session->userdata('location');
		$data['session'] = $this->session->all_userdata();
		$id_user = $this->session->userdata('id_user');
		$data['get_jml_lap'] = $this->m_user->get_data_set_jml_lap($id_user);
		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));
		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));
		$data['firstname'] = strtoupper($data['namadepan'][0]);
		$data['tampilan'] = 'dashboard';

		$this->load->view('layout/master', $data);
	}
}


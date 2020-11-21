<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_cabang extends CI_Model {

	function tampil_data()

	{

		$this->db->from('credit_set_cabang');

		$this->db->order_by('id_cabang','asc');

		$query = $this->db->get();

		return $query->result();

	}

	function simpan_data()

	{

		$nama_cabang = $this->input->post('nama_cabang');

		$alamat_cabang = $this->input->post('alamat_cabang');

		$data = array('nama_cabang' => ucwords($nama_cabang), 'alamat_cabang' => ucfirst($alamat_cabang) );

		$query = $this->db->insert('credit_set_cabang',$data);

		if($query){

			return true;

		}else{

			return false;

		}

	}

	function edit_data()

	{

		$id_cabang = $this->input->post('id_cabang');

		$data = array('nama_cabang' => ucwords($this->input->post('nama_cabang')), 'alamat_cabang' => ucfirst($this->input->post('alamat_cabang')));

		$query = $this->db->update('credit_set_cabang', $data, array('id_cabang' => $id_cabang));

		if($query){

			return true;

		}else{

			return false;

		}

	}

	function hapus_data($id_cabang)

	{

		$query = $this->db->delete('credit_set_cabang', array('id_cabang' => $id_cabang));

		if($query){

			return true;

		}else{

			return false;

		}

	}

}



/* End of file M_cabang.php */

/* Location: ./application/models/M_cabang.php */
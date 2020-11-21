<?php

class M_omzet_harian extends CI_Model 

{
	function __construct()

	{

		parent::__construct();

	}	

	//function menampilkan data omzet berdasarkan user

	function get_data($id_user)

	{

		$sql="SELECT * FROM credit_set_omzet AS o LEFT JOIN credit_set_input AS i ON i.id_set = o.id_set WHERE o.id_user='$id_user' ORDER BY i.bulan, i.minggu, o.tanggal ASC";

		$query = $this->db->query($sql);

		foreach ($query->result_array() as $row) {

			$array[] = $row;

		}

		if (!isset($array)) { 

			$array='';

		}

		$query->free_result();

		return $array;

	}

	function get_jml_lap($id_user, $id_cabang)

	{
		$this->db->from('credit_set_jumlah_lapangan');
		$this->db->where('id_user', $id_user);
		$this->db->where('id_cabang', $id_cabang);
		$query = $this->db->get();
		return $query->row();

	}

	function get_data_all($id_user)

	{

		$sql="SELECT * FROM credit_set_omzet AS o  LEFT JOIN credit_kasbon AS k ON k.id_set = o.id_set AND k.hari=o.hari  LEFT JOIN credit_rincian_biaya_op AS b ON b.id_set = o.id_set AND b.hari=o.hari LEFT JOIN credit_set_input AS i ON i.id_set = o.id_set WHERE o.id_user='$id_user' ORDER BY i.bulan, i.minggu, o.tanggal ASC ";

		$query = $this->db->query($sql);

		foreach ($query->result_array() as $row) {

			$array[] = $row;

		}

		if (!isset($array)) { 

			$array='';

		}

		$query->free_result();

		return $array;

	}

	function get_pencarian_data_all($id_user,$id_set)

	{

		if($id_set=='reset'){

			$sql="SELECT * FROM credit_set_omzet AS o  LEFT JOIN credit_kasbon AS k ON k.id_set = o.id_set AND k.hari=o.hari  LEFT JOIN credit_rincian_biaya_op AS b ON b.id_set = o.id_set AND b.hari=o.hari LEFT JOIN credit_set_input AS i ON i.id_set = o.id_set WHERE o.id_user='$id_user' ORDER BY i.bulan, i.minggu, o.tanggal ASC ";

			$query = $this->db->query($sql);

			foreach ($query->result_array() as $row) {

				$array[] = $row;

			}

			if (!isset($array)) { 

				$array='';

			}

			$query->free_result();

			return $array;

		}else{

			$sql="SELECT *, o.hari AS hari_omzet, o.tanggal AS tanggal_omzet FROM credit_set_omzet AS o  LEFT JOIN credit_kasbon AS k ON k.id_set = o.id_set AND k.tanggal = o.tanggal LEFT JOIN credit_rincian_biaya_op AS b ON b.id_set = o.id_set AND b.tanggal = o.tanggal LEFT JOIN credit_set_input AS i ON i.id_set = o.id_set WHERE o.tanggal BETWEEN i.tanggal_awal AND i.tanggal_akhir AND o.id_user='$id_user' AND o.id_set='$id_set' ORDER BY i.bulan, i.minggu, o.tanggal ASC ";

			$query = $this->db->query($sql);

			foreach ($query->result_array() as $row) {

				$array[] = $row;

			}

			if (!isset($array)) { 

				$array='';

			}

			$query->free_result();

			return $array;

		}

	}

	//function menampilkan data omzet berdasarkan user

	function get_data_pencarian($id_user,$id_set)

	{

		if($id_set=='reset'){

			$sql="SELECT * FROM credit_set_omzet AS o LEFT JOIN credit_set_input AS i ON i.id_set = o.id_set WHERE o.tanggal BETWEEN i.tanggal_awal AND i.tanggal_akhir AND o.id_user='$id_user' ORDER BY i.bulan, i.minggu, o.tanggal  ASC";

			$query = $this->db->query($sql);

			foreach ($query->result_array() as $row) {

				$array[] = $row;

			}

			if (!isset($array)) { 

				$array='';

			}

			$query->free_result();

			return $array;

		}else{

			$sql="SELECT * FROM credit_set_omzet AS o LEFT JOIN credit_set_input AS i ON i.id_set = o.id_set WHERE o.tanggal BETWEEN i.tanggal_awal AND i.tanggal_akhir AND o.id_user='$id_user' AND o.id_set='$id_set' ORDER BY i.bulan, i.minggu, o.tanggal ASC";

			$query = $this->db->query($sql);

			foreach ($query->result_array() as $row) {

				$array[] = $row;

			}

			if (!isset($array)) { 

				$array='';

			}

			$query->free_result();

			return $array;

		}

	}

	//function hapus data

	function hapus($id)

	{

		$sql = "DELETE FROM credit_set_omzet WHERE id_omzet = '$id'";

		$this->db->query($sql);

		return true;

	}	

	//tambah

	function simpan($id_user)

	{

		$id_u = $id_user;

		$id_cabutan = $this->input->post('cabutan');

		$id_set = $this->input->post('id_set');

		$hari = $this->input->post('hari');

		$tgl = date_create($this->input->post('tanggal'));

		$tanggal = date_format($tgl,'Y-m-d');

		$omzet_lap_1 = $this->input->post('omzet_lap_1');

		$omzet_lap_2 = $this->input->post('omzet_lap_2');

		$omzet_lap_3 = $this->input->post('omzet_lap_3');

		$omzet_lap_4 = $this->input->post('omzet_lap_4');

		$omzet_lap_5 = $this->input->post('omzet_lap_5');

		$omzet_lap_6 = $this->input->post('omzet_lap_6');

		$omzet_lap_7 = $this->input->post('omzet_lap_7');

		$omzet_lap_8 = $this->input->post('omzet_lap_8');

		$omzet_lap_9 = $this->input->post('omzet_lap_9');

		$omzet_lap_10 = $this->input->post('omzet_lap_10');

		$omzet_lap_11 = $this->input->post('omzet_lap_11');

		$this->db->from('credit_set_omzet');

		$this->db->where('id_user',$id_u);

		$this->db->where('id_set',$id_set);

		$this->db->where('hari',$hari);

		$this->db->where('tanggal',$tanggal);

		$query = $this->db->get();

		$cekData = $query->num_rows();

		if(!empty($id_u) && !empty($hari) && !empty($tanggal) && $cekData<1)

		{	
		    //insert

			$sql1 = "INSERT INTO credit_set_omzet 

			(id_omzet,id_user,id_set,id_cabutan,hari,tanggal,omzet_lap_1,omzet_lap_2,omzet_lap_3,omzet_lap_4,omzet_lap_5,omzet_lap_6,omzet_lap_7,omzet_lap_8,omzet_lap_9,omzet_lap_10,omzet_lap_11) 

			VALUES ('$id','$id_u','$id_set','$id_cabutan','$hari','$tanggal','$omzet_lap_1','$omzet_lap_2','$omzet_lap_3','$omzet_lap_4','$omzet_lap_5','$omzet_lap_6','$omzet_lap_7','$omzet_lap_8','$omzet_lap_9','$omzet_lap_10','$omzet_lap_11')";

			if($this->db->query($sql1)){
				
				return true;

			}else{

				return false;

			}


		}else{

			return false;	

		}

	}

	function ubah()

	{

		$id = $this->input->post('id');

		$id_cabutan = $this->input->post('cabutan');

		$id_u = $this->input->post('id_user');

		$id_set = $this->input->post('id_set');

		$hari = $this->input->post('hari');

		$tgl = date_create($this->input->post('tanggal'));

		$tanggal = date_format($tgl,'Y-m-d');

		$omzet_lap_1 = $this->input->post('omzet_lap_1');

		$omzet_lap_2 = $this->input->post('omzet_lap_2');

		$omzet_lap_3 = $this->input->post('omzet_lap_3');

		$omzet_lap_4 = $this->input->post('omzet_lap_4');

		$omzet_lap_5 = $this->input->post('omzet_lap_5');

		$omzet_lap_6 = $this->input->post('omzet_lap_6');

		$omzet_lap_7 = $this->input->post('omzet_lap_7');

		$omzet_lap_8 = $this->input->post('omzet_lap_8');

		$omzet_lap_9 = $this->input->post('omzet_lap_9');

		$omzet_lap_10 = $this->input->post('omzet_lap_10');

		$omzet_lap_11 = $this->input->post('omzet_lap_11');

		if(!empty($id) && !empty($id_u) && !empty($id_set) && !empty($hari))

		{

			$level = $this->session->userdata('level_user');

			$id_lapangan = $this->session->userdata('id_lapangan');

			$post = "omzet_lap_".$id_lapangan;

			$omzet_lap_by_id_lap = $this->input->post($post);

			if($level=="Operator"){

				$sql = "UPDATE credit_set_omzet SET

				id_user = '$id_u',

				id_set = '$id_set',

				id_cabutan = '$id_cabutan',

				hari = '$hari',

				tanggal = '$tanggal',

				omzet_lap_1 = '$omzet_lap_1',

				omzet_lap_2 = '$omzet_lap_2',

				omzet_lap_3 = '$omzet_lap_3',

				omzet_lap_4 = '$omzet_lap_4',

				omzet_lap_5 = '$omzet_lap_5',

				omzet_lap_6 = '$omzet_lap_6',

				omzet_lap_7 = '$omzet_lap_7',

				omzet_lap_8 = '$omzet_lap_8',

				omzet_lap_9 = '$omzet_lap_9',

				omzet_lap_10 = '$omzet_lap_10',

				omzet_lap_11 = '$omzet_lap_11'

				WHERE id_omzet='$id'";

			}else{

				$sql = "UPDATE credit_set_omzet SET

				id_user = '$id_u',

				id_set = '$id_set',

				id_cabutan = '$id_cabutan',

				hari = '$hari',

				tanggal = '$tanggal',

				omzet_lap_".$id_lapangan." = '$omzet_lap_by_id_lap'

				WHERE id_omzet='$id'";

			}

			if($this->db->query($sql)){

				return true;

			}else{

				return false;

			}

		}else{

			return false;	

		}
	}
}

?>
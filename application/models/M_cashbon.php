<?php

class M_cashbon extends CI_Model 

{

	function __construct()

	{

		parent::__construct();

	}

	function get_data($id_user)

	{
		$sql="SELECT * FROM credit_kasbon AS o LEFT JOIN credit_set_input AS i ON i.id_set = o.id_set WHERE o.id_user='$id_user' ORDER BY i.bulan, i.minggu, o.tanggal, o.id_cabutan ASC";

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

	//function menampilkan data kasbon berdasarkan user

	function get_data_pencarian($id_user,$id_set)

	{

		if($id_set=='reset'){

			$sql="SELECT * FROM credit_kasbon AS o LEFT JOIN credit_set_input AS i ON i.id_set = o.id_set WHERE o.tanggal BETWEEN i.tanggal_awal AND i.tanggal_akhir AND o.id_user='$id_user' ORDER BY i.bulan, i.minggu, o.tanggal, o.id_cabutan ASC";

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

			$sql="SELECT * FROM credit_kasbon AS o LEFT JOIN credit_set_input AS i ON i.id_set = o.id_set WHERE o.tanggal BETWEEN i.tanggal_awal AND i.tanggal_akhir AND o.id_user='$id_user' AND o.id_set='$id_set' ORDER BY i.bulan, i.minggu, o.tanggal, o.id_cabutan ASC";

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

		$sql = "DELETE FROM credit_kasbon WHERE id_kasbon = '$id'";

		if($this->db->query($sql)){

			return true;

		}else{

			return false;

		}


	}	

	//tambah

	function simpan($id_user)

	{

		$id_u = $id_user;

		$id_set = $this->input->post('id_set');

		$id_cabutan = $this->input->post('id_cabutan');

		$hari = $this->input->post('hari');

		$tgl = date_create($this->input->post('tanggal'));

		$tanggal = date_format($tgl,'Y-m-d');

		$kasbon_lap_1 = $this->input->post('kasbon_lap_1');

		$kasbon_lap_2 = $this->input->post('kasbon_lap_2');

		$kasbon_lap_3 = $this->input->post('kasbon_lap_3');

		$kasbon_lap_4 = $this->input->post('kasbon_lap_4');

		$kasbon_lap_5 = $this->input->post('kasbon_lap_5');

		$kasbon_lap_6 = $this->input->post('kasbon_lap_6');

		$kasbon_lap_7 = $this->input->post('kasbon_lap_7');

		$kasbon_lap_8 = $this->input->post('kasbon_lap_8');

		$kasbon_lap_9 = $this->input->post('kasbon_lap_9');

		$kasbon_lap_10 = $this->input->post('kasbon_lap_10');

		$kasbon_lap_11 = $this->input->post('kasbon_lap_11');

		$l1 = $this->input->post('l1');

		$l2 = $this->input->post('l2');

		$atl = $this->input->post('atl');

		$gl = $this->input->post('gl');

		$tm = $this->input->post('tm');

		$tr = $this->input->post('tr');

		$this->db->from('credit_kasbon');

		$this->db->where('id_user',$id_u);

		$this->db->where('id_set',$id_set);

		$this->db->where('hari',$hari);

		$this->db->where('tanggal',$tanggal);

		$query = $this->db->get();

		$cekData = $query->num_rows();

		if(!empty($id_u) && !empty($hari) && !empty($tanggal) && !empty($id_cabutan) && $cekData<1)

		{	
		    //insert

			$sql1 = "INSERT INTO credit_kasbon 

			(id_user,

			id_set,

			id_cabutan,

			hari,

			tanggal,

			kasbon_lap_1,

			kasbon_lap_2,

			kasbon_lap_3,

			kasbon_lap_4,

			kasbon_lap_5,

			kasbon_lap_6,

			kasbon_lap_7,

			kasbon_lap_8,

			kasbon_lap_9,

			kasbon_lap_10,

			kasbon_lap_11,

			kasbon_leader_1,

			kasbon_leader_2,

			kasbon_asis_tl,

			kasbon_gl,

			kasbon_t_masak,

			kasbon_training) 

			VALUES ('$id_u',

			'$id_set','$id_cabutan',

			'$hari','$tanggal',

			'$kasbon_lap_1',

			'$kasbon_lap_2',

			'$kasbon_lap_3',

			'$kasbon_lap_4',

			'$kasbon_lap_5',

			'$kasbon_lap_6',

			'$kasbon_lap_7',

			'$kasbon_lap_8',

			'$kasbon_lap_9',

			'$kasbon_lap_10',

			'$kasbon_lap_11',

			'$l1','$l2','$atl',

			'$gl','$tm','$tr')";

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

		$id_u = $this->input->post('id_user');

		$id_set = $this->input->post('id_set');

		$hari = $this->input->post('hari');

		$tgl = date_create($this->input->post('tanggal'));

		$tanggal = date_format($tgl,'Y-m-d');

		$kasbon_lap_1 = $this->input->post('kasbon_lap_1');

		$kasbon_lap_2 = $this->input->post('kasbon_lap_2');

		$kasbon_lap_3 = $this->input->post('kasbon_lap_3');

		$kasbon_lap_4 = $this->input->post('kasbon_lap_4');

		$kasbon_lap_5 = $this->input->post('kasbon_lap_5');

		$kasbon_lap_6 = $this->input->post('kasbon_lap_6');

		$kasbon_lap_7 = $this->input->post('kasbon_lap_7');

		$kasbon_lap_8 = $this->input->post('kasbon_lap_8');

		$kasbon_lap_9 = $this->input->post('kasbon_lap_9');

		$kasbon_lap_10 = $this->input->post('kasbon_lap_10');

		$kasbon_lap_11 = $this->input->post('kasbon_lap_11');

		$l1 = $this->input->post('l1');

		$l2 = $this->input->post('l2');

		$atl = $this->input->post('atl');

		$gl = $this->input->post('gl');

		$tm = $this->input->post('tm');

		$tr = $this->input->post('tr');

		if(!empty($id) && !empty($id_u) && !empty($kasbon_lap_1))

		{				

			$sql = "UPDATE credit_kasbon SET

			id_user = '$id_u',

			id_set = '$id_set',

			hari = '$hari',

			tanggal = '$tanggal',

			kasbon_lap_1 = '$kasbon_lap_1',

			kasbon_lap_2 = '$kasbon_lap_2',

			kasbon_lap_3 = '$kasbon_lap_3',

			kasbon_lap_4 = '$kasbon_lap_4',

			kasbon_lap_5 = '$kasbon_lap_5',

			kasbon_lap_6 = '$kasbon_lap_6',

			kasbon_lap_7 = '$kasbon_lap_7',

			kasbon_lap_8 = '$kasbon_lap_8',

			kasbon_lap_9 = '$kasbon_lap_9',

			kasbon_lap_10 = '$kasbon_lap_10',

			kasbon_lap_11 = '$kasbon_lap_11',

			kasbon_leader_1 = '$l1',

			kasbon_leader_2 = '$l2',

			kasbon_asis_tl = '$atl',

			kasbon_gl = '$gl',

			kasbon_t_masak = '$tm',

			kasbon_training = '$tr'

			WHERE id_kasbon='$id'"; 

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
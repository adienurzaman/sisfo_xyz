<?php
class M_view_progress_awal extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
    }	
	//function menampilkan data
	function get_data()
    {
    	$sql="SELECT * FROM credit_user WHERE level_user='Operator' ORDER BY id_cabang ASC";
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

	//function menampilkan data
	function get_data_set_input($id_user)
    {
		$query = $this->db->query("SELECT * FROM credit_set_input WHERE id_user='$id_user' ORDER BY bulan,minggu ASC");
		foreach ($query->result_array() as $row) {
			$array[] = $row;
		}
		if (!isset($array)) { 
			$array='';
		}
		$query->free_result();
		return $array;
	}

	function get_data_set_input_ajax($id_user,$bulan)
    {
		$query = $this->db->query("SELECT * FROM credit_set_input WHERE id_user='$id_user' AND bulan='$bulan' ORDER BY bulan,minggu ASC");
		foreach ($query->result_array() as $row) {
			$array[] = $row;
		}
		if (!isset($array)) { 
			$array='';
		}
		$query->free_result();
		return $array;
	}

	//function menampilkan data omzet berdasarkan user
	function get_data_omzet($id_user)
    {
    	$sql = "SELECT * FROM credit_set_omzet AS o LEFT JOIN credit_set_input AS i ON i.id_set = o.id_set WHERE o.tanggal BETWEEN i.tanggal_awal AND i.tanggal_akhir AND o.id_user='$id_user' ORDER BY i.bulan, i.minggu, o.tanggal ASC";

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

	function get_data_kasbon($id_user)
    {

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
	}

	//function menampilkan data
	function get_data_biaya_op($id_user)
    {
    	$sql="SELECT * FROM credit_rincian_biaya_op AS o LEFT JOIN credit_set_input AS i ON i.id_set = o.id_set WHERE o.tanggal BETWEEN i.tanggal_awal AND i.tanggal_akhir AND o.id_user='$id_user' ORDER BY i.bulan, i.minggu, o.tanggal, o.id_cabutan ASC";

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

	//function menampilkan data omzet berdasarkan user
	function get_data_gaji($id_user)
    {

    	$sql="SELECT o.id_omzet AS id_omzet, o.id_set AS id_set,o.id_user AS id_user, i.bulan AS bulan, i.minggu AS minggu, i.tanggal_awal AS tanggal_awal, i.tanggal_akhir AS tanggal_akhir,o.tanggal AS tanggal,o.hari AS hari, SUM(o.omzet_lap_1) AS omzet_lap_1, SUM(o.omzet_lap_2) AS omzet_lap_2, SUM(o.omzet_lap_3) AS omzet_lap_3, SUM(o.omzet_lap_4) AS omzet_lap_4, SUM(o.omzet_lap_5) AS omzet_lap_5, SUM(o.omzet_lap_6) AS omzet_lap_6, SUM(o.omzet_lap_7) AS omzet_lap_7, SUM(o.omzet_lap_8) AS omzet_lap_8, SUM(o.omzet_lap_9) AS omzet_lap_9, SUM(o.omzet_lap_10) AS omzet_lap_10, SUM(o.omzet_lap_11) AS omzet_lap_11  FROM credit_set_omzet AS o LEFT JOIN credit_set_input AS i ON i.id_set=o.id_set WHERE o.id_user='$id_user' AND o.tanggal BETWEEN i.tanggal_awal AND i.tanggal_akhir";

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

	function get_data_all($id_user)
    {

    	$sql="SELECT *, o.hari AS hari_omzet, o.tanggal AS tanggal_omzet FROM credit_set_omzet AS o  LEFT JOIN credit_kasbon AS k ON k.id_set = o.id_set AND k.tanggal = o.tanggal LEFT JOIN credit_rincian_biaya_op AS b ON b.id_set = o.id_set AND b.tanggal = o.tanggal LEFT JOIN credit_set_input AS i ON i.id_set = o.id_set WHERE o.tanggal BETWEEN i.tanggal_awal AND i.tanggal_akhir AND o.id_user='$id_user' ORDER BY i.bulan, i.minggu, o.tanggal ASC";

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
?>
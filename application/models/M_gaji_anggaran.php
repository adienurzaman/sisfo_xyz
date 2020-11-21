<?php

class M_gaji_anggaran extends CI_Model 

{

    function __construct()

    {
        parent::__construct();

    }	

	//function menampilkan data omzet berdasarkan user

	function get_data($id_user)

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

	function get_pencarian_data($id_user,$id_set)

    {

    	if($id_set=='reset'){

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

		}else{

			$sql="SELECT o.id_omzet AS id_omzet, o.id_set AS id_set,o.id_user AS id_user, i.bulan AS bulan, i.minggu AS minggu, i.tanggal_awal AS tanggal_awal, i.tanggal_akhir AS tanggal_akhir,o.tanggal AS tanggal,o.hari AS hari, SUM(o.omzet_lap_1) AS omzet_lap_1, SUM(o.omzet_lap_2) AS omzet_lap_2, SUM(o.omzet_lap_3) AS omzet_lap_3, SUM(o.omzet_lap_4) AS omzet_lap_4, SUM(o.omzet_lap_5) AS omzet_lap_5, SUM(o.omzet_lap_6) AS omzet_lap_6, SUM(o.omzet_lap_7) AS omzet_lap_7, SUM(o.omzet_lap_8) AS omzet_lap_8, SUM(o.omzet_lap_9) AS omzet_lap_9, SUM(o.omzet_lap_10) AS omzet_lap_10, SUM(o.omzet_lap_11) AS omzet_lap_11  FROM credit_set_omzet AS o LEFT JOIN credit_set_input AS i ON i.id_set=o.id_set WHERE o.id_user='$id_user' AND o.id_set='$id_set' AND o.tanggal BETWEEN i.tanggal_awal AND i.tanggal_akhir";

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

}

?>
<?php

class M_set_pelaporan extends CI_Model 

{

    function __construct()

    {

        parent::__construct();

    }	

	//function menampilkan data

	function get_data($id_user)

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

	//function hapus data dosen

	function hapus($id)

    {

		 $sql1 = "DELETE FROM credit_set_input WHERE id_set = '$id'";

		 $this->db->query($sql1);

		 return true;

    }	

	//tambah

	function simpan($id_user)

    {

		$id_u = $id_user;

		$bulan = $this->input->post('bulan'); 

		$minggu = $this->input->post('minggu');

		$t_awal = date_create($this->input->post('tanggal_awal'));

		$tanggal_awal = date_format($t_awal,'Y-m-d');

		$t_akhir = date_create($this->input->post('tanggal_akhir'));

		$tanggal_akhir = date_format($t_akhir,'Y-m-d');

		$this->db->from('credit_set_input');

		$this->db->where('id_user',$id_u);

		$this->db->where('bulan',$bulan);

		$this->db->where('minggu',$minggu);

		$this->db->where('tanggal_awal',$tanggal_awal);

		$this->db->where('tanggal_akhir',$tanggal_akhir);

		$query = $this->db->get();

		$cekData = $query->num_rows();

		if(!empty($id_u) && !empty($bulan) && !empty($minggu) && !empty($tanggal_awal) && !empty($tanggal_akhir) && $cekData<1)

		{
		    //insert
		    $sql = "INSERT INTO credit_set_input (id_user,bulan,minggu,tanggal_awal,tanggal_akhir) 

		    		VALUES ('$id_u','$bulan','$minggu','$tanggal_awal','$tanggal_akhir')";

		    if($this->db->query($sql)){
				
				return true;

		    }else{

		    	return false;

		    }


		}else{

			return false;	

		}	

    }

	function ubah($id)

    {

		$id_s = $id;

		$id_u = $this->input->post('id_user');

		$bulan = $this->input->post('bulan'); 

		$minggu = $this->input->post('minggu');

		$t_awal = date_create($this->input->post('tanggal_awal'));

		$tanggal_awal = date_format($t_awal,'Y-m-d');

		$t_akhir = date_create($this->input->post('tanggal_akhir'));

		$tanggal_akhir = date_format($t_akhir,'Y-m-d');

		if(!empty($id_u) && !empty($bulan) && !empty($minggu) && !empty($tanggal_awal) && !empty($tanggal_akhir))

		{				

			$sql = "UPDATE credit_set_input SET 

					id_user = '$id_u', 

					bulan = '$bulan',

					minggu = '$minggu',

					tanggal_awal = '$tanggal_awal',

					tanggal_akhir = '$tanggal_akhir'

					WHERE id_set='$id_s'"; 



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
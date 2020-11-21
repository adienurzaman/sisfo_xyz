<?php
class M_biaya_op extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
    }
	
	//function menampilkan data
	function get_data($id_user)
    {

    	$sql="SELECT * FROM credit_rincian_biaya_op AS o LEFT JOIN credit_set_input AS i ON i.id_set = o.id_set WHERE o.id_user='$id_user' ORDER BY i.bulan, i.minggu, o.tanggal, o.id_cabutan ASC";

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


	//function menampilkan data  berdasarkan user
	function get_data_pencarian($id_user,$id_set)
    {
    	if($id_set=='reset'){
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
    	}else{
    		$sql="SELECT * FROM credit_rincian_biaya_op AS o LEFT JOIN credit_set_input AS i ON i.id_set = o.id_set WHERE o.tanggal BETWEEN i.tanggal_awal AND i.tanggal_akhir AND o.id_user='$id_user' AND o.id_set='$id_set' ORDER BY i.bulan, i.minggu, o.tanggal, o.id_cabutan ASC";

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
		 $sql = "DELETE FROM credit_rincian_biaya_op WHERE id_rincian = '$id'";
		 $this->db->query($sql);
		 return true;
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
		$biaya_beras = $this->input->post('biaya_beras');
		$biaya_air_galon = $this->input->post('biaya_air_galon');
		$biaya_gas = $this->input->post('biaya_gas');
		$biaya_resiko = $this->input->post('biaya_resiko');
		$biaya_lain = $this->input->post('biaya_lain');

		$this->db->from('credit_rincian_biaya_op');
		$this->db->where('id_user',$id_u);
		$this->db->where('id_set',$id_set);
		$this->db->where('hari',$hari);
		$this->db->where('tanggal',$tanggal);

		$query = $this->db->get();
		$cekData = $query->num_rows();

		if(!empty($id_u) && !empty($hari) && !empty($tanggal) && !empty($id_cabutan) && $cekData<1)
		{	
		    //insert
		    $sql1 = "INSERT INTO credit_rincian_biaya_op 
		    		(id_rincian,id_user,id_set,id_cabutan,hari,tanggal,biaya_beras,biaya_air_galon,biaya_gas,biaya_resiko,biaya_lain) 
		    		VALUES ('$id','$id_u','$id_set','$id_cabutan','$hari','$tanggal','$biaya_beras','$biaya_air_galon','$biaya_gas','$biaya_resiko','$biaya_lain')";

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
		$id_cabutan = $this->input->post('id_cabutan');
		$hari = $this->input->post('hari');
		$tgl = date_create($this->input->post('tanggal'));
		$tanggal = date_format($tgl,'Y-m-d');
		$biaya_beras = $this->input->post('biaya_beras');
		$biaya_air_galon = $this->input->post('biaya_air_galon');
		$biaya_gas = $this->input->post('biaya_gas');
		$biaya_resiko = $this->input->post('biaya_resiko');
		$biaya_lain = $this->input->post('biaya_lain');
		if(!empty($id) && !empty($id_u) && !empty($biaya_beras))
		{				
			$sql = "UPDATE credit_rincian_biaya_op SET
			id_user = '$id_u',
			id_set = '$id_set',
			id_cabutan = '$id_cabutan',
			hari = '$hari',
			tanggal = '$tanggal',
			biaya_beras = '$biaya_beras',
			biaya_air_galon = '$biaya_air_galon',
			biaya_gas = '$biaya_gas',
			biaya_resiko = '$biaya_resiko',
			biaya_lain = '$biaya_lain'
			WHERE id_rincian='$id'"; 

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
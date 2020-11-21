<?php

class M_set_persen extends CI_Model 

{

    function __construct()
    
    {

        parent::__construct();

    }

	function get_data($id_user)

    {

		$query = $this->db->query("SELECT * FROM credit_set_penggajian WHERE id_user='$id_user'");

		foreach ($query->result_array() as $row) {

			$array[] = $row;

		}

		if (!isset($array)) { 

			$array='';

		}

		$query->free_result();

		return $array;

	}

	function get_data_set_al($id_user){

		$sql="SELECT * FROM credit_set_gaji_al WHERE id_user='$id_user'";

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

	function get_data_set_tm($id_user){

		$sql="SELECT * FROM credit_set_gaji_tm LEFT JOIN credit_set_input ON credit_set_input.id_set = credit_set_gaji_tm.id_set WHERE credit_set_gaji_tm.id_user='$id_user' ORDER BY credit_set_input.bulan,credit_set_input.minggu ASC";

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

	function get_data_set_by_op($id_user){

		$sql="SELECT * FROM credit_set_biaya_op LEFT JOIN credit_set_input ON credit_set_input.id_set = credit_set_biaya_op.id_set WHERE credit_set_biaya_op.id_user='$id_user' ORDER BY credit_set_input.bulan,credit_set_input.minggu ASC";

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

	function get_data_set_ongkos_belanja($id_user){

		$sql="SELECT * FROM credit_set_ongkos_belanja LEFT JOIN credit_set_input ON credit_set_input.id_set = credit_set_ongkos_belanja.id_set WHERE credit_set_ongkos_belanja.id_user='$id_user' ORDER BY credit_set_input.bulan,credit_set_input.minggu ASC";

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

	//function hapus data

	function hapus($id)

    {

		 $sql = "DELETE FROM credit_set_penggajian WHERE id_set_penggajian = '$id'";

		 $this->db->query($sql);

		 return true;

    }

    function hapus_tm($id)

    {

		 $sql = "DELETE FROM credit_set_gaji_tm WHERE id_set_gaji_tm = '$id'";

		 $this->db->query($sql);

		 return true;

    }

    function hapus_bop($id)

    {

		 $sql = "DELETE FROM credit_set_biaya_op WHERE id_set_biaya_op = '$id'";

		 $this->db->query($sql);

		 return true;

    }

    function hapus_ob($id)

    {

		 $sql = "DELETE FROM credit_set_ongkos_belanja WHERE id_set_ongkos_belanja = '$id'";

		 $this->db->query($sql);

		 return true;

    }	

	//tambah

	function simpan($id_user)

    {

		$id_u = $id_user;

		$gs = $this->input->post('gs');

		$tl1 = $this->input->post('tl1');

		$tl2 = $this->input->post('tl2');

		$gl = $this->input->post('gl');

		if(!empty($gs) && !empty($tl1) && !empty($tl2) && !empty($gl))

		{	
		    //insert

		    $sql = "INSERT INTO credit_set_penggajian (id_user, gaji_sales, gaji_team_leader_1, gaji_team_leader_2, gaji_grouf_leader) VALUES ($id_u', '$gs', '$tl1', '$tl2','$gl')";

		    if($this->db->query($sql)){
				
				return true;

		    }else{

		    	return false;

		    }

		}else{

			return false;	

		}

    }

    function simpan_al($id_user)

    {

		$id_u = $id_user;

		$status = $this->input->post('status');

		$ket = $this->input->post('keterangan');

		$mg = $this->input->post('minggu');		

		if(!empty($id_u) && !empty($status) && !empty($ket))

		{	
		    //insert

		    $sql = "INSERT INTO credit_set_gaji_al (id_user, status, keterangan, minggu) VALUES ($id_u', '$status', '$ket','$mg')";

		    if($this->db->query($sql)){
				
				return true;

		    }else{

		    	return false;

		    }

		}else{

			return false;	

		}

    }

    function simpan_tm($id_user)

    {

		$id_u = $id_user;

		$id_set = $this->input->post('id_set');

		$gaji = $this->input->post('gaji');

		$this->db->from('credit_set_gaji_tm');

		$this->db->where('id_set',$id_set);

		//cek data ganda

		$query = $this->db->get();

		$cekData = $query->num_rows();		

		if(!empty($id_u) && !empty($id_set) && !empty($gaji) && $cekData<1)

		{
		    //insert

		    $sql = "INSERT INTO credit_set_gaji_tm (id_user, id_set, gaji) VALUES ($id_u', '$id_set', '$gaji')";

		    if($this->db->query($sql)){
				
				return true;

		    }else{

		    	return false;

		    }

		}else{

			return false;	

		}

    }

    function simpan_bop($id_user)

    {

		$id_u = $id_user;

		$id_set = $this->input->post('id_set');

		$biaya_op = $this->input->post('biaya_op');

		$this->db->from('credit_set_biaya_op');

		$this->db->where('id_set',$id_set);

		$query = $this->db->get();

		$cekData = $query->num_rows();
		

		if(!empty($id_u) && !empty($id_set) && !empty($biaya_op) && $cekData<1)

		{	
		    //insert

		    $sql = "INSERT INTO credit_set_biaya_op (id_user, id_set, biaya_op) VALUES ('$id_u', '$id_set', '$biaya_op')";

		    if($this->db->query($sql)){
				
				return true;

		    }else{

		    	return false;

		    }

		}else{

			return false;	

		}

    }

    function simpan_ob($id_user)

    {

		$id_u = $id_user;

		$id_set = $this->input->post('id_set');

		$ongkos = $this->input->post('ongkos');

		$this->db->from('credit_set_ongkos_belanja');

		$this->db->where('id_set',$id_set);

		$query = $this->db->get();

		$cekData = $query->num_rows();		

		if(!empty($id_u) && !empty($id_set) && !empty($ongkos) && $cekData<1)

		{	
		    //insert

		    $sql = "INSERT INTO credit_set_ongkos_belanja (id_set_ongkos_belanja, id_user, id_set, ongkos) VALUES ('$id', '$id_u', '$id_set', '$ongkos')";

		    if($this->db->query($sql)){
				
				return true;

		    }else{

		    	return false;

		    }

		}else{

			return false;	

		}

    }

	function ubah($id_user)

    {

		$id = $this->input->post('id');

		$id_u = $id_user;

		$gs = $this->input->post('gs');

		$tl1 = $this->input->post('tl1');

		$tl2 = $this->input->post('tl2');

		$gl = $this->input->post('gl');

		if(!empty($gs) && !empty($tl1) && !empty($tl2) && !empty($gl))

		{				

			$sql = "UPDATE credit_set_penggajian SET 

			id_user = '$id_u',

			gaji_sales = '$gs', 

			gaji_team_leader_1 = '$tl1', 

			gaji_team_leader_2 = '$tl2', 

			gaji_grouf_leader='$gl'

			WHERE id_set_penggajian='$id'"; 

			if($this->db->query($sql)){

				return true;

			}else{

				return false;

			}

		}else{

			return false;	

		}

    }

    function ubah_al($id_user)

    {

		$id = $this->input->post('id');

		$id_u = $id_user;

		$status = $this->input->post('status');

		$ket = $this->input->post('keterangan');

		$mg = $this->input->post('minggu');		

		if(!empty($id) && !empty($id_u) && !empty($status) && !empty($ket))

		{	
		    //insert

		    $sql = "UPDATE credit_set_gaji_al 

		    		SET id_user = '$id_u', 

		    			status = '$status', 

		    			keterangan = '$ket',

		    			minggu = '$mg'

		    		WHERE id_set_gaji_al = '$id'";

		    if($this->db->query($sql)){
				
				return true;

		    }else{

		    	return false;

		    }

		}else{

			return false;	

		}	

    }

    function ubah_tm($id_user)

    {

		$id = $this->input->post('id');

		$id_u = $id_user;

		$id_set = $this->input->post('id_set');

		$gaji = $this->input->post('gaji');		

		if(!empty($id) && !empty($id_u) && !empty($id_set) && !empty($gaji))

		{	
		    //insert

		    $sql = "UPDATE credit_set_gaji_tm 

		    		SET id_user = '$id_u', 

		    			id_set = '$id_set', 

		    			gaji = '$gaji'

		    		WHERE id_set_gaji_tm = '$id'";

		   if($this->db->query($sql)){
				
				return true;

		    }else{

		    	return false;

		    }

		}else{

			return false;	

		}	

    }

    function ubah_bop($id_user)

    {

		$id = $this->input->post('id');

		$id_u = $id_user;

		$id_set = $this->input->post('id_set');

		$biaya_op = $this->input->post('biaya_op');		

		if(!empty($id) && !empty($id_u) && !empty($id_set) && !empty($biaya_op))

		{	//insert

		    $sql = "UPDATE credit_set_biaya_op 

		    		SET id_user = '$id_u', 

		    			id_set = '$id_set', 

		    			biaya_op = '$biaya_op'

		    		WHERE id_set_biaya_op = '$id'";

		    if($this->db->query($sql)){
				
				return true;

		    }else{

		    	return false;

		    }

		}else{

			return false;	

		}	

    }

    function ubah_ob($id_user)

    {

		$id = $this->input->post('id');

		$id_u = $id_user;

		$id_set = $this->input->post('id_set');

		$ongkos = $this->input->post('ongkos');		

		if(!empty($id) && !empty($id_u) && !empty($id_set) && !empty($ongkos))

		{	//insert

		    $sql = "UPDATE credit_set_ongkos_belanja 

		    		SET id_user = '$id_u', 

		    			id_set = '$id_set', 

		    			ongkos = '$ongkos'

		    		WHERE id_set_ongkos_belanja = '$id'";

		    if($this->db->query($sql)){
				
				return true;

		    }else{

		    	return false;

		    }

		}else{

			return false;	

		}

    }

    function get_data_pencarian_set_tm($id_user,$id_set){

		$sql="SELECT * FROM credit_set_gaji_tm LEFT JOIN credit_set_input ON credit_set_input.id_set = credit_set_gaji_tm.id_set WHERE credit_set_gaji_tm.id_user='$id_user' AND credit_set_gaji_tm.id_set='$id_set' ORDER BY credit_set_input.bulan,credit_set_input.minggu ASC";

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

	function get_data_pencarian_set_by_op($id_user,$id_set){

		$sql="SELECT * FROM credit_set_biaya_op LEFT JOIN credit_set_input ON credit_set_input.id_set = credit_set_biaya_op.id_set WHERE credit_set_biaya_op.id_user='$id_user' AND credit_set_biaya_op.id_set='$id_set' ORDER BY credit_set_input.bulan,credit_set_input.minggu ASC";

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

	function get_data_pencarian_set_ongkos_belanja($id_user,$id_set){

		$sql="SELECT * FROM credit_set_ongkos_belanja LEFT JOIN credit_set_input ON credit_set_input.id_set = credit_set_ongkos_belanja.id_set WHERE credit_set_ongkos_belanja.id_user='$id_user' AND credit_set_ongkos_belanja.id_set='$id_set' ORDER BY credit_set_input.bulan,credit_set_input.minggu ASC";

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
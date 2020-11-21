<?php

class M_user extends CI_Model 

{

    function __construct()

    {

        parent::__construct();

    }	

	//function menampilkan data dosen

	function get_data()

	{

		$sql="SELECT * FROM credit_user LEFT JOIN credit_set_cabang ON credit_user.id_cabang = credit_set_cabang.id_cabang ORDER BY credit_user.id_cabang, credit_user.id_lapangan";

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

	function get_cabang()

	{

		$this->db->from('credit_set_cabang');

		$query = $this->db->get();

		return $query->result();

	}

	function get_data_sales($id_cabang,$jabatan_sales)

    {

    	$sql="SELECT * FROM credit_user WHERE id_cabang = '$id_cabang' AND jabatan='$jabatan_sales' ORDER BY id_cabang, id_lapangan ";

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

	function get_data_tl1($id_cabang,$jabatan_tl1)

    {

    	$sql="SELECT * FROM credit_user WHERE id_cabang = '$id_cabang' AND jabatan='$jabatan_tl1'";

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

	function get_data_tl2($id_cabang,$jabatan_tl2)

    {

    	$sql="SELECT * FROM credit_user WHERE id_cabang = '$id_cabang' AND jabatan='$jabatan_tl2'";

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

	function get_data_gl($id_cabang,$jabatan_gl)

    {

    	$sql="SELECT * FROM credit_user WHERE id_cabang = '$id_cabang' AND jabatan='$jabatan_gl'";

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

	function get_data_al($id_cabang,$jabatan_al)

    {

    	$sql="SELECT * FROM credit_user WHERE id_cabang = '$id_cabang' AND jabatan='$jabatan_al'";

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



	function get_data_percabang($id_cabang)

	{

		$sql="SELECT * FROM credit_user WHERE id_cabang = '$id_cabang' ORDER BY id_cabang,id_lapangan";

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

	function get_data_individual($username)

	{

		$sql="SELECT * FROM credit_user WHERE username='$username'";

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

		$sql = "DELETE FROM credit_user WHERE id_user ='$id'";

		$this->db->query($sql);

		return true;

    }

    //function reset password

	function reset_pass($id)

    {

    	$password=md5('admin321');

		$sql = "UPDATE credit_user SET password='$password' WHERE id_user ='$id'";

		$this->db->query($sql);

		return true;

    }

	//tambah

	function simpan()

    {

		$username = $this->input->post('username');

		$id_cabang = $this->input->post('id_cabang');

		$level =  $this->input->post('level');

		$jabatan = $this->input->post('jabatan');

		$id_lapangan = $this->input->post('id_lapangan'); 

		if($level == 'Operator'){

			$this->db->from('credit_user');

			$this->db->where('level_user',$level);

			$this->db->where('id_cabang',$id_cabang);

			//cek username ganda

			$cekData = $this->db->get()->result();

			if(!empty($username) && count($cekData)<1)

			{

				$this->db->from('credit_user');

				$this->db->where('username',$username);

				$cekUsername = $this->db->get()->result();

				if(!empty($username) && count($cekUsername)<1)

				{

					$id_lapangan = $this->input->post('id_lapangan'); 

					$id_cabang = $this->input->post('id_cabang'); 

				    $username = $this->input->post('username');

				    $nama = ucwords($this->input->post('namauser'));

				    $password = md5($this->input->post('password'));

				    $jabatan = $this->input->post('jabatan');

				    $jk = $this->input->post('jk');

				    $tempat_lahir = ucwords($this->input->post('tempat_lahir'));

				    $tgl = date_create($this->input->post('tanggal_lahir'));

			    	$tanggal_lahir = date_format($tgl, "Y-m-d");

				    $alamat = ucfirst($this->input->post('alamat'));

				    $level = $this->input->post('level');

				    $status= 'Aktif';

				    $tlp = $this->input->post('tlp');

				    $email = $this->input->post('email');

				    $data = array(

				    		'id_lapangan' => $id_lapangan,

				    		'id_cabang' => $id_cabang,

				    		'username' => $username,

				    		'namauser' => $nama,

				    		'password' => $password,

				    		'jabatan' => $jabatan,

				    		'jk' => $jk,

				    		'tempat_lahir' => $tempat_lahir,

				    		'tanggal_lahir' => $tanggal_lahir,

				    		'alamat' => $alamat,

				    		'level_user' => $level,

				    		'no_tlp' => $tlp,

				    		'email' => $email,

				    		'status_user' => $status,

							'login_time' => '-',

							'logout_time' => '-'

				    		);

				    $sql = $this->db->insert('credit_user', $data);

					if($sql){

						return true;

					}else{

						return false;

					}

				}else{

					return false;

				}

			}else{

				return false;

			}

		}else{

			if($jabatan == 'Sales'){

				$this->db->from('credit_user');

				$this->db->where('jabatan',$jabatan);

				$this->db->where('id_cabang',$id_cabang);

				$this->db->where('id_lapangan',$id_lapangan);

				//cek username ganda

				$cekData = $this->db->get()->result();

				if(!empty($username) && count($cekData)<1)

				{

					$this->db->from('credit_user');

					$this->db->where('username',$username);

					$cekUsername = $this->db->get()->result();

					if(!empty($username) && count($cekUsername)<1)

					{					

						$id_lapangan = $this->input->post('id_lapangan'); 

						$id_cabang = $this->input->post('id_cabang'); 

					    $username = $this->input->post('username');

					    $nama = ucwords($this->input->post('namauser'));

					    $password = md5($this->input->post('password'));

					    $jabatan = $this->input->post('jabatan');

					    $jk = $this->input->post('jk');

					    $tempat_lahir = ucwords($this->input->post('tempat_lahir'));

					    $tgl = date_create($this->input->post('tanggal_lahir'));

				    	$tanggal_lahir = date_format($tgl, "Y-m-d");

					    $alamat = ucfirst($this->input->post('alamat'));

					    $level = $this->input->post('level');

					    $status= 'Aktif';

					    $tlp = $this->input->post('tlp');

					    $email = $this->input->post('email');

						$data = array(

				    		'id_lapangan' => $id_lapangan,

				    		'id_cabang' => $id_cabang,

				    		'username' => $username,

				    		'namauser' => $nama,

				    		'password' => $password,

				    		'jabatan' => $jabatan,

				    		'jk' => $jk,

				    		'tempat_lahir' => $tempat_lahir,

				    		'tanggal_lahir' => $tanggal_lahir,

				    		'alamat' => $alamat,

				    		'level_user' => $level,

				    		'no_tlp' => $tlp,

				    		'email' => $email,

				    		'status_user' => $status,

							'login_time' => '-',

							'logout_time' => '-'

				    		);

					    $sql = $this->db->insert('credit_user', $data);

						if($sql){

							return true;

						}else{

							return false;

						}

					}else{

						return false;

					}

				}else{

					return false;

				}

			}elseif(!empty($username) && !empty($id_cabang)){

				$this->db->from('credit_user');

				$this->db->where('username',$username);

				$cekUsername = $this->db->get()->result();

				if(!empty($username) && count($cekUsername)<1)

				{

					$id_user = 'null';

					$id_lapangan = $this->input->post('id_lapangan'); 

					$id_cabang = $this->input->post('id_cabang'); 

				    $username = $this->input->post('username');

				    $nama = ucwords($this->input->post('namauser'));

				    $password = md5($this->input->post('password'));

				    $jabatan = $this->input->post('jabatan');

				    $jk = $this->input->post('jk');

				    $tempat_lahir = ucwords($this->input->post('tempat_lahir'));

				    $tgl = date_create($this->input->post('tanggal_lahir'));

			    	$tanggal_lahir = date_format($tgl, "Y-m-d");

				    $alamat = ucfirst($this->input->post('alamat'));

				    $level = $this->input->post('level');

				    $status= 'Aktif';

				    $tlp = $this->input->post('tlp');

				    $email = $this->input->post('email');

					$data = array(

				    		'id_lapangan' => $id_lapangan,

				    		'id_cabang' => $id_cabang,

				    		'username' => $username,

				    		'namauser' => $nama,

				    		'password' => $password,

				    		'jabatan' => $jabatan,

				    		'jk' => $jk,

				    		'tempat_lahir' => $tempat_lahir,

				    		'tanggal_lahir' => $tanggal_lahir,

				    		'alamat' => $alamat,

				    		'level_user' => $level,

				    		'no_tlp' => $tlp,

				    		'email' => $email,

				    		'status_user' => $status,

							'login_time' => '-',

							'logout_time' => '-'

				    		);

					    $sql = $this->db->insert('credit_user', $data);

					if($sql){

						return true;

					}else{

						return false;

					}

				}else{

					return false;	

				}

			}else{

				return false;

			}

		}

    }

    //ubah data

	function ubah()

    {

		$id = $this->input->post('id_user');

		$password = $this->input->post('password');

		if($id!=''){

			if(empty($password)){

				$id_user = $this->input->post('id_user');

				$id_lapangan = $this->input->post('id_lapangan');

				$id_cabang = $this->input->post('id_cabang');

			    $username = $this->input->post('username');

			    $nama = ucwords($this->input->post('namauser'));

			    $jabatan = $this->input->post('jabatan');

			    $jk = $this->input->post('jk');

			    $tempat_lahir = ucwords($this->input->post('tempat_lahir'));

			    $tgl = date_create($this->input->post('tanggal_lahir'));

			    $tanggal_lahir = date_format($tgl, "Y-m-d");



			    $alamat = ucfirst($this->input->post('alamat'));

			    $level = $this->input->post('level');

			    $status= $this->input->post('status');

			    $tlp = $this->input->post('tlp');

			    $email = $this->input->post('email');



				$sql= "UPDATE credit_user SET

				id_lapangan = '$id_lapangan',

				id_cabang = '$id_cabang', 

				username = '$username',

				namauser = '$nama',

				jabatan = '$jabatan',

				jk  = '$jk', 

				tempat_lahir  = '$tempat_lahir',

				tanggal_lahir  = '$tanggal_lahir',

				alamat = '$alamat',

				level_user = '$level', 

				status_user = '$status',

				no_tlp = '$tlp',

				email = '$email'

				WHERE id_user='$id_user'";

				if($this->db->query($sql)){

					return true;
				}else{

					return false;

				}

			}elseif(!empty($password)){

				$id_user = $this->input->post('id_user');

				$id_lapangan = $this->input->post('id_lapangan'); 

				$id_cabang = $this->input->post('id_cabang'); 

			    $username = $this->input->post('username');

			    $nama = ucwords($this->input->post('namauser'));

			    $password = md5($this->input->post('password'));

			    $jabatan = $this->input->post('jabatan');

			    $jk = $this->input->post('jk');

			    $tempat_lahir = ucwords($this->input->post('tempat_lahir'));

			    $tgl = date_create($this->input->post('tanggal_lahir'));

			    $tanggal_lahir = date_format($tgl, "Y-m-d");

			    $alamat = ucfirst($this->input->post('alamat'));

			    $level = $this->input->post('level');

			    $status= $this->input->post('status');

			    $tlp = $this->input->post('tlp');

			    $email = $this->input->post('email');

			    $sql= "UPDATE credit_user SET 

				id_lapangan = '$id_lapangan',

				id_cabang = '$id_cabang', 

				username = '$username',

				password = '$password',

				namauser = '$nama',

				jabatan = '$jabatan',

				jk  = '$jk', 

				tempat_lahir  = '$tempat_lahir',

				tanggal_lahir  = '$tanggal_lahir',

				alamat = '$alamat',

				level_user = '$level', 

				status_user = '$status',

				no_tlp = '$tlp',

				email = '$email'

				WHERE id_user='$id_user'";

				if($this->db->query($sql)){

					return true;

				}else{

					return false;

				}

			}else{

				return false;	

			}

		}else{

			return false;

		}

    }

    function get_data_set_jml_lap($id_user){

		$sql="SELECT * FROM credit_set_jumlah_lapangan WHERE id_user='$id_user'";

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

	function simpan_jml_lap($id_user,$id_cabang)

    {

		$id_u = $id_user;

		$id_c = $id_cabang;

		$jumlah = $this->input->post('jumlah');		

		if(!empty($id_u) && !empty($id_cabang) && !empty($jumlah))

		{	
		    //insert

		    $sql = "INSERT INTO credit_set_jumlah_lapangan(id_user, id_cabang, jumlah) VALUES ('$id_u', '$id_c', '$jumlah')";

		    if($this->db->query($sql)){

		    	return true;

		    }else{

		    	return false;

		    }

		}else{

			return false;	

		}	

    }

    function ubah_jml_lap($id_user,$id_cabang)

    {

		$id = $this->input->post('id');

		$id_u = $id_user;

		$id_c = $id_cabang;

		$jumlah = $this->input->post('jumlah');		

		if(!empty($id) && !empty($id_u) && !empty($id_c) && !empty($jumlah))

		{	

		    $sql = "UPDATE credit_set_jumlah_lapangan 

		    		SET id_user = '$id_u', 

		    			id_cabang = '$id_c', 

		    			jumlah = '$jumlah'

		    		WHERE id_jumlah = '$id'";

		    if($this->db->query($sql)){

		    	return true;

		    }else{

		    	return false;

		    }

		}else{

			return false;	

		}	

    }

    function set_login($username,$time)

    {

		if(!empty($username) && !empty($time))

		{
		    //insert
		    $sql = "UPDATE credit_user 

		    		SET login_time = '$time', 

		    			logout_time = '-'

		    		WHERE username = '$username'";

		    if($this->db->query($sql)){

		    	return true;

		    }else{

		    	return false;

		    }

		}else{

			return false;	

		}	

    }

    function set_logout($username,$time)

    {

		if(!empty($username) && !empty($time))

		{	
		    //insert
		    $sql = "UPDATE credit_user 

		    		SET logout_time = '$time'

		    		WHERE username = '$username'";

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
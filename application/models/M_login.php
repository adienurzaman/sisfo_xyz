<?php
class M_login extends CI_Model 
{
    private $ci;
    private $error = array();

	
	function get_datauser($username)
    {
		$this->db->from('credit_user u');
		$this->db->join('credit_set_cabang c','u.id_cabang = c.id_cabang','left');
		$this->db->where('u.username',$username);

		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$array = $row;
		}
		if (!isset($array)) 
		{ 
			$array='';
		}

		return $array;
    }
    
    function check_data_username($username)
    {
		$query = $this->db->get_where('credit_user', array('username' => $username, 'status_user' => 'Aktif'));

		foreach ($query->result_array() as $row) {
			$array = $row;
		}
		if (!isset($array)) 
		{ 
			$array='';
		}

		$query->free_result();
		return $array;
    }

    function check_data($username,$password)
    {
		$password = md5($password);

		$query = $this->db->get_where('credit_user', array('username' => $username, 'password' => $password, 'status_user' => 'Aktif'));

		foreach ($query->result_array() as $row) {
			$array = $row;
		}
		if (!isset($array)) 
		{ 
			$array='';
		}

		$query->free_result();
		return $array;
    }
       
}
?>

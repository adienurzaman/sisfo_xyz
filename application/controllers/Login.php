<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_user');
	}

	public function index()
	{
		if(!$this->session->userdata('username'))
		{
			$this->load->view('login');
		}
		else
		{
			redirect('backend/welcome');	
		}

		if(!empty($this->input->post('username')) && !empty($this->input->post('password'))){
			$username = $this->input->post('username',true);
			$password = $this->input->post('password',true);

			$check_user = $this->m_login->check_data_username($username);
			if (!empty($check_user)) {
				$check = $this->m_login->check_data($username, $password);
				if(!empty($check)){
        			// create session
					$userdata = $this->m_login->get_datauser($username);
					$this->session->set_userdata($userdata);
					$status = $this->session->userdata('status');
					$username = $this->session->userdata('username');
					$waktu_login = date('H:i:s');
					$this->m_user->set_login($username,$waktu_login);

					$this->session->set_flashdata('login_berhasil','Selamat Datang. Anda berhasil Log-in');
					redirect('backend/welcome');
				}else{
					//Jika tidak berhasil Login Kareng Password Salah
					$this->session->set_flashdata('password_salah','Segera Hubungi Admin Sistem. PASSWORD yang anda masukan TIDAK TEPAT');
					redirect('login');
				}
			}else{
        		//Jika tidak berhasil Login
				$this->session->set_flashdata('error_login','Login Gagal');
				redirect('login');    
			}
		}
	}

	public function logout(){
		$username = $this->session->userdata('username');
		$waktu_login = date('H:i:s');
		$this->m_user->set_logout($username,$waktu_login);

		/** HAPUS SESSION **/
		$this->session->sess_destroy();
		redirect('login');
	}

	public function forgot()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			$email = $this->input->post('email');

            #cek_email

			$query = $this->db->get_where('credit_user', array('email' => $email));

			if($query->num_rows() > 0){

				$row = $query->row();

				$username = $row->username;

				$nama = $row->namauser;

				$id_user = $row->id_user;

				$generated = $this->_generate_pass(8);

				if($this->_mail($email,$username,$nama,$generated) == true){

					if($id_user!=''){

						$passwordBaru = md5($generated);

						$this->db->set('password',$passwordBaru);

						$this->db->where('id_user',$id_user);

						$query = $this->db->update('credit_user');

						if($query){

							echo json_encode(array('status' => TRUE));

						}else{

							echo json_encode(array('status' => FALSE)); 

						}

					}

				}else{

					echo json_encode(array('status' => FALSE));

				}

			}

		}else{

			$result['success'] = "0";

			$result['message'] = "error";

			echo json_encode($result);

			redirect('login');

		}
	}

	/**

    public private mail()

    Kirim data Reset Password ke Email yang berelasi dengan username

    **/

    private function _mail($email,$username,$nama,$password){

    	if (!empty($email)) {            

            // Konfigurasi email

    		$config = [

    			'mailtype'  => 'html',

    			'charset'   => 'utf-8',

    			'protocol'  => 'smtp',

    			'smtp_host' => 'ssl://mail.senjamaja.id',

    			'smtp_user' => 'dederamdan94@senjamaja.id',    

    			'smtp_pass' => 'demoks94',                  

    			'smtp_port' => '465',

    			'crlf'      => "\r\n",

    			'newline'   => "\r\n"

    		];

            // Load library email dan konfigurasinya

    		$this->load->library('email',$config);

            // $this->email->initialize($config);

            // Email dan nama pengirim

    		$this->email->from('dederamdan94@senjamaja.id', '[no-reply] Developer | XYZ APP');

            // Email penerima

    		$this->email->to($email); 

            // Lampiran email, isi dengan url/path file

            // $this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

            // Subject email

    		$this->email->subject('RESET PASSWORD | XYZ APP');

    		$this->email->message("Hai Tn/Ny/Nn ".$nama.", Username Anda : ".$username.", Password Baru Anda : <b>".$password."</b>. <br> Setelah berhasil Login segera lakukan Perubahan Password Kembali. Password yang dikirimkan adalah password Default. <br><br> Terimakasih. Hormat Kami Developer XYZ.");


    		if ($this->email->send()) {

    			return true;

    		} else {

    			return false;

    		}

    	}else{

    		$result['success'] = "0";

    		$result['message'] = "error";        

    		echo json_encode($result);

    		redirect('login');

    	}

    }

    /**

    private function generate_pass($panjang)

    Generate secara acak password baru ketika terdapat permintaan reset password

    **/

    private function _generate_pass($panjang)

    {

    	$karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';

    	$string = '';

    	for ($i = 0; $i < $panjang; $i++) {

    		$pos = rand(0, strlen($karakter)-1);

    		$string .= $karakter{$pos};

    	}	    

    	return $string;

    }

}

?>

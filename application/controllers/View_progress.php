<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View_progress extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_set_pelaporan');
		$this->load->model('m_gaji_anggaran');
		$this->load->model('m_set_persen');
		$this->load->model('m_view_progress');
		$this->load->model('m_view_progress_awal');
		$this->load->model('m_omzet_harian');
		$this->load->model('m_cashbon');
		$this->load->model('m_biaya_op');
		$this->load->model('m_login');
		$this->load->model('m_user');
		if(!$this->session->userdata('username'))
		{
			redirect('login');
		}
	}

	public function index()
	{
		$level = $this->session->userdata('level_user');
		if($level!='Admin'){
			$this->session->set_flashdata('access_denied','Laman tersebut tidak dapat di akses');
			redirect('backend/welcome');
		}
		$this->session->set_userdata(array('location' => 'Informasi View Progress Pelaporan Credit'));
		$data['sess_location'] = $this->session->userdata('location');
		$data['session'] = $this->session->all_userdata();
		$username = $this->session->userdata('username');
		//get all data ON Operator
		$data['get_operator'] = $this->m_view_progress->get_data();
		$session = $this->session->all_userdata();
		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));
		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));
		$data['firstname'] = strtoupper($data['namadepan'][0]);
		$data['tampilan'] = 'view_progress/proses_cari_data';
		//new
		$this->load->view('layout/master', $data);
	}

	public function get_operator()
	{
		$this->session->set_userdata(array('location' => 'Informasi View Progress Pelaporan Credit'));
		$data['sess_location'] = $this->session->userdata('location');
		$data['session'] = $this->session->all_userdata();
		$username = $this->session->userdata('username');
		$id_user = $this->uri->segment(3);
		$data['get_id']=$id_user;
		$id_cabang = $this->uri->segment(4);
		$data['get_c']=$id_cabang;
		$id_set = $this->input->post('id_set');

		if(empty($id_set)){
			// var_dump ($id_set);
			// die();
			$data['get'] = '1';
			//get all data ON Operator			
			$jabatan_sales = 'Sales';
			$jabatan_tl1 = 'Team Leader 1';
			$jabatan_tl2 = 'Team Leader 2';
			$jabatan_gl = 'Gruof Leader';
			$jabatan_al = 'Asis Leader';
			$data['get_sales'] = $this->m_user->get_data_sales($id_cabang,$jabatan_sales);
			$data['get_tl1'] = $this->m_user->get_data_tl1($id_cabang,$jabatan_tl1);
			$data['get_tl2'] = $this->m_user->get_data_tl2($id_cabang,$jabatan_tl2);
			$data['get_gl'] = $this->m_user->get_data_gl($id_cabang,$jabatan_gl);
			$data['get_al'] = $this->m_user->get_data_al($id_cabang,$jabatan_al);
			// $data['get_set_input']=$this->m_view_progress_awal->get_data_set_input($id_user);
			$data['get_omzet']=$this->m_view_progress_awal->get_data_omzet($id_user);
			$data['get_kasbon']=$this->m_view_progress_awal->get_data_kasbon($id_user);
			$data['get_biaya']=$this->m_view_progress_awal->get_data_biaya_op($id_user);
			$data['get_all']=$this->m_view_progress_awal->get_data_all($id_user);
			$data['get_gaji']=$this->m_view_progress_awal->get_data_gaji($id_user);
			$data['get_persen'] = $this->m_set_persen->get_data($id_user);
			$data['get_gaji_al'] = $this->m_set_persen->get_data_set_al($id_user);
			$data['get_jml_lap'] = $this->m_user->get_data_set_jml_lap($id_user);
			$data['get_gaji_tm'] = $this->m_set_persen->get_data_set_tm($id_user);
			$data['get_bop'] = $this->m_set_persen->get_data_set_by_op($id_user);
			$data['get_ob'] = $this->m_set_persen->get_data_set_ongkos_belanja($id_user);
		}else{
			// var_dump ($id_set);
			// die();
			$data['get'] = '2';
			$data['$id_set_tmp'] = $this->input->post('id_set');
			$jabatan_sales = 'Sales';
			$jabatan_tl1 = 'Team Leader 1';
			$jabatan_tl2 = 'Team Leader 2';
			$jabatan_gl = 'Gruof Leader';
			$jabatan_al = 'Asis Leader';
			$data['get_sales'] = $this->m_user->get_data_sales($id_cabang,$jabatan_sales);
			$data['get_tl1'] = $this->m_user->get_data_tl1($id_cabang,$jabatan_tl1);
			$data['get_tl2'] = $this->m_user->get_data_tl2($id_cabang,$jabatan_tl2);
			$data['get_gl'] = $this->m_user->get_data_gl($id_cabang,$jabatan_gl);
			$data['get_al'] = $this->m_user->get_data_al($id_cabang,$jabatan_al);
			// $data['get_set_input']=$this->m_view_progress->get_data_set_input($id_user);
			$data['get_omzet'] = $this->m_omzet_harian->get_data_pencarian($id_user,$id_set);
			$data['get_kasbon'] = $this->m_cashbon->get_data_pencarian($id_user,$id_set);
			$data['get_biaya'] = $this->m_biaya_op->get_data_pencarian($id_user,$id_set);
			$data['get_all'] = $this->m_omzet_harian->get_pencarian_data_all($id_user,$id_set);
			$data['get_gaji'] = $this->m_gaji_anggaran->get_pencarian_data($id_user,$id_set);
			$data['get_persen'] = $this->m_set_persen->get_data($id_user);
			$data['get_gaji_al'] = $this->m_set_persen->get_data_set_al($id_user);
			$data['get_jml_lap'] = $this->m_user->get_data_set_jml_lap($id_user);
			$data['get_gaji_tm'] = $this->m_set_persen->get_data_pencarian_set_tm($id_user,$id_set);
			$data['get_bop'] = $this->m_set_persen->get_data_pencarian_set_by_op($id_user,$id_set);
			$data['get_ob'] = $this->m_set_persen->get_data_pencarian_set_ongkos_belanja($id_user,$id_set);
		}
		$session = $this->session->all_userdata();
		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));
		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));
		$data['firstname'] = strtoupper($data['namadepan'][0]);
		$data['tampilan'] = 'view_progress/daftar_posisi_uang';
		//new
		$this->load->view('layout/master', $data);
	}

	public function filter_bulan()
	{
		$id_user = $this->input->post('id_user');
		$bulan = $this->input->post('bulan');
		$get_set_input = $this->m_view_progress_awal->get_data_set_input_ajax($id_user,$bulan);
		?>
		<label for="id_set">ID Pencarian :</label>
		<select id="id_set_coba" class="form-control" name="id_set" onchange="cek_id();" required>
			<?php 
			if(!empty($get_set_input)){
				?>
				<!-- <option value="reset">Seluruh Data (ALL TIME)</option> -->
				<option value="">-- Pilih Set Input --</option>
				<?php
				foreach ($get_set_input as $data_tambah) {
					$tgl1 = date_create($data_tambah['tanggal_awal']);
					$tgl2 = date_create($data_tambah['tanggal_akhir']);
					$tanggal_awal = date_format($tgl1, 'd-m-Y');
					$tanggal_akhir = date_format($tgl2, 'd-m-Y');
					?>
					<option value="<?php echo $data_tambah['id_set'];?>"><?php echo 'Bulan : '.$data_tambah['bulan'].' - Minggu : '.$data_tambah['minggu'].' ( '.$tanggal_awal.' s/d '.$tanggal_akhir.' )';?></option>

					<?php
				}
			}else{
				?>
				<option value="">Data Belum Ada, Segera Lakukan Setting Input</option>
				<?php
			}
			?>
		</select>
		<?php
	}

	private function cari_all_data()
	{
		$this->session->set_userdata(array('location' => 'Proses Cari All Data'));
		$data['sess_location'] = $this->session->userdata('location');
		$data['session'] = $this->session->all_userdata();
		$username = $this->session->userdata('username');
		$id_user = $this->input->post('id_user');
		$id_set = $this->input->post('id_set');
		//get all data ON Operator
		$data['get_omzet'] = $this->m_omzet_harian->get_data_pencarian($id_user,$id_set);
		$data['get_kasbon'] = $this->m_cashbon->get_data_pencarian($id_user,$id_set);
		$data['get_biaya'] = $this->m_biaya_op->get_data_pencarian($id_user,$id_set);
		$data['get_all'] = $this->m_omzet_harian->get_pencarian_data_all($id_user,$id_set);
		$data['get_set_input'] = $this->m_set_pelaporan->get_data($id_user);
		$data['get_persen'] = $this->m_set_persen->get_data();
		$session = $this->session->all_userdata();
		$data['namalengkap'] =strtoupper($this->session->userdata('namauser'));
		$data['namadepan'] = explode(' ',$this->session->userdata('namauser'));
		$data['firstname'] = strtoupper($data['namadepan'][0]);
		$data['tampilan'] = 'view_progress/daftar_posisi_uang';
		//new
		$this->load->view('layout/master', $data);
	}
	
}

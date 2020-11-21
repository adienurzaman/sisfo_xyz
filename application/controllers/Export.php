<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_omzet_harian');
    $this->load->model('m_cashbon');
    $this->load->model('m_gaji_anggaran');
    $this->load->model('m_set_persen');
    $this->load->model('m_set_pelaporan');
    $this->load->model('m_view_progress');
    $this->load->model('m_biaya_op');
    $this->load->model('m_user');
 		//error_reporting(0 & ~0);
    if(!$this->session->userdata('username'))
    {
     redirect('login');
   }
 }

 /*============================================OMZET========================================*/

 function e_omzet(){
  error_reporting(0);
  $this->session->set_userdata(array('location' => 'Proses Export Data Omzet'));
  $data['sess_location'] = $this->session->userdata('location');
  $data['session'] = $this->session->all_userdata();
  $username = $this->session->userdata('username');
  $id_user = $this->session->userdata('id_user');
  $id_set = $this->input->post('id_set');
  $get_omzet = $this->m_omzet_harian->get_data_pencarian($id_user,$id_set);
  $session = $this->session->all_userdata();
  $data['namalengkap'] =strtoupper($this->session->userdata('namauser'));
  $data['namadepan'] = explode(' ',$this->session->userdata('namauser'));
  $data['firstname'] = strtoupper($data['namadepan'][0]);
  $id_cabang = $this->session->userdata('id_cabang');
  $jabatan_sales = 'Sales';
  $get_sales = $this->m_user->get_data_sales($id_cabang,$jabatan_sales);

  if(empty($get_omzet)){
    $this->session->set_flashdata('gagal_cetak','Data yang anda inginkan belum terdapat di database. Export Tidak Berhasil');
    redirect('omzet');
  }
  else{
    ob_start();
    ?>
    <html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" >
      <style>
        .tengah{
          text-align:center;
        }
        .kiri{
          text-align:left;
        }
        .kanan{
          text-align:right;
        }
      </style>
    </head><body>
      <table border='0' align='LEFT'>
        <tr>
          <th>
            <img src="<?php echo base_url('build/img/xyz_2.png');?>"  align="left" width='165' height='150px' >
          </th>
          <th width="20">
          </th>
          <th width="2339px" align="left">
            <?php $value = date('Y-m-d');
            $tgl = date_create($value);
            $hasil = date_format($tgl,'d-m-Y');?>  
            <h1><left> EXPORT LAPORAN <br>CV. XYZ<br></left>
              <center><?php echo "Tanggal Diterbitkan : $hasil"; ?> </center></h1>
            </th>
          </tr>
        </table>
        <hr style="height:4px;" />
        <h4 class="tengah"><b><u>LAPORAN REKAPITULASI OMZET</u></b></h4>
        <br>
        <div class="x_content">
          <div class="table-responsive">
            <table width="100%" class="table table-striped" border="1">
              <thead>
                <tr>
                  <th rowspan="3" class="tengah" width="3%">No</th>
                  <th rowspan="3" class="tengah" width="5%">Bulan</th>
                  <th rowspan="3" class="tengah" width="5%">Minggu</th>
                  <th rowspan="3" class="tengah" width="4%">Cab</th>
                  <th rowspan="3" class="tengah" width="5%">Hari</th>
                  <th rowspan="3" class="tengah" width="6%">Tanggal</th>
                  <th colspan="11" class="tengah">Lapangan/Nama</th>
                  <th rowspan="3" class="tengah" width="5%">Jumlah</th>
                </tr>
                <tr>
                  <th rowspan="1" class="tengah" width="5%">1</th>
                  <th rowspan="1" class="tengah" width="5%">2</th>
                  <th rowspan="1" class="tengah" width="5%">3</th>
                  <th rowspan="1" class="tengah" width="5%">4</th>
                  <th rowspan="1" class="tengah" width="5%">5</th>
                  <th rowspan="1" class="tengah" width="5%">6</th>
                  <th rowspan="1" class="tengah" width="5%">7</th>
                  <th rowspan="1" class="tengah" width="5%">8</th>
                  <th rowspan="1" class="tengah" width="5%">9</th>
                  <th rowspan="1" class="tengah" width="5%">10</th>
                  <th rowspan="1" class="tengah" width="5%">11</th>
                </tr>
                <tr>
                  <?php if(!empty($get_sales)){
                    foreach ($get_sales as $data) {
                      $nama = $data['namauser'];
                      ?>
                      <th rowspan="1" class="tengah"><font size="1"><?php echo ucwords($nama);?></font></th>
                      <?php 
                    }
                  } 
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php 
                $v = isset($get_omzet[0]['tanggal_awal'])?$get_omzet[0]['tanggal_awal']:'';
                $tgl_a = date_create($v);
                $tahun = date_format($tgl_a,'Y');
                ?>
                <tr>
                  <th colspan="18" class="tengah"><font size="1">Minggu ke - <?php echo isset($get_omzet[0]['minggu'])?$get_omzet[0]['minggu']:'';?> (<?php echo isset($get_omzet[0]['bulan'])?$get_omzet[0]['bulan']:'';?> - <?php echo $tahun;?>)</font></th>
                </tr>
                <?php
                if(!empty($get_omzet))
                {
                  $jum=0;
                  $no=1;
                  $total=0;
                  $tl1 = 0;
                  $tl2 = 0;
                  $tl3 = 0;
                  $tl4 = 0;
                  $tl5 = 0;
                  $tl6 = 0;
                  $tl7 = 0;
                  $tl8 = 0;
                  $tl9 = 0;
                  $tl10 = 0;
                  $tl11 = 0;
                  $tmp_bln;
                  $tmp_mg;
                  foreach ($get_omzet as $data) {
                    $tgl1 = date_create($data['tanggal_awal']);
                    $tgl2 = date_create($data['tanggal_akhir']);
                    $tanggal_awal = date_format($tgl1, 'd-m-Y');
                    $tanggal_akhir = date_format($tgl2, 'd-m-Y');
                    $bln = $data['bulan'];
                    $mg = $data['minggu'];
                    $hari = $data['hari'];
                    $cab = $data['id_cabutan'];
                    $tgl = date_create($data['tanggal']);
                    $tanggal = date_format($tgl, "d-m-Y");
                    $lap1 = $data['omzet_lap_1'];
                    $lap2 = $data['omzet_lap_2'];
                    $lap3 = $data['omzet_lap_3'];
                    $lap4 = $data['omzet_lap_4'];
                    $lap5 = $data['omzet_lap_5'];
                    $lap6 = $data['omzet_lap_6'];
                    $lap7 = $data['omzet_lap_7'];
                    $lap8 = $data['omzet_lap_8'];
                    $lap9 = $data['omzet_lap_9'];
                    $lap10 = $data['omzet_lap_10'];
                    $lap11 = $data['omzet_lap_11'];
                    $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11;
                    $jml = "Rp " . number_format($jum,0,',','.');
                    $total += $jum;
                    $tl1 += $lap1;
                    $tl2 += $lap2;
                    $tl3 += $lap3;
                    $tl4 += $lap4;
                    $tl5 += $lap5;
                    $tl6 += $lap6;
                    $tl7 += $lap7;
                    $tl8 += $lap8;
                    $tl9 += $lap9;
                    $tl10 += $lap10;
                    $tl11 += $lap11;
                    ?>
                    <tr>
                      <td class="tengah"><font size="1"><?php echo $no++; ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $cab; ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $hari; ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $tanggal; ?></font></td>                      
                      <td class="tengah"><font size="1"> <?php echo $lap1 = " Rp " . number_format($lap1,0,',','.'); ?></font></td> 
                      <td class="tengah"><font size="1"> <?php echo $lap2 = " Rp " . number_format($lap2,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"> <?php echo $lap3 = " Rp " . number_format($lap3,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"> <?php echo $lap4 = " Rp " . number_format($lap4,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"> <?php echo $lap5 = " Rp " . number_format($lap5,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"> <?php echo $lap6 = " Rp " . number_format($lap6,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"> <?php echo $lap7 = " Rp " . number_format($lap7,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"> <?php echo $lap8 = " Rp " . number_format($lap8,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"> <?php echo $lap9 = " Rp " . number_format($lap9,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"> <?php echo $lap10 = " Rp " . number_format($lap10,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"> <?php echo $lap11 = " Rp " . number_format($lap11,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"> <?php echo $jml; ?></font></td>
                    </tr>
                    <?php
                  }
                }else{
                 ?>
                 <table>
                  <tr>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <i class="icon fa fa-close"></i> Belum terdapat data apapun pada database.
                    </div>
                  </tr>
                </table>
                <?php
              }
              ?>
            </tbody>
            <?php if(!empty($get_omzet)){?>
              <tfoot>
                <tr>
                  <th colspan="6" class="tengah"><font size="1">Total Jumlah</font></th>
                  <th colspan="1" class="tengah"><font size="1"><strong><?php echo $tl1 = " Rp " . number_format($tl1,0,',','.'); ?></strong></font></th>
                  <th colspan="1" class="tengah"><font size="1"><strong><?php echo $tl2 = " Rp " . number_format($tl2,0,',','.'); ?></strong></font></th>
                  <th colspan="1" class="tengah"><font size="1"><strong><?php echo $tl3 = " Rp " . number_format($tl3,0,',','.'); ?></strong></font></th>
                  <th colspan="1" class="tengah"><font size="1"><strong><?php echo $tl4 = " Rp " . number_format($tl4,0,',','.'); ?></strong></font></th>
                  <th colspan="1" class="tengah"><font size="1"><strong><?php echo $tl5 = " Rp " . number_format($tl5,0,',','.'); ?></strong></font></th>
                  <th colspan="1" class="tengah"><font size="1"><strong><?php echo $tl6 = " Rp " . number_format($tl6,0,',','.'); ?></strong></font></th>
                  <th colspan="1" class="tengah"><font size="1"><strong><?php echo $tl7 = " Rp " . number_format($tl7,0,',','.'); ?></strong></font></th>
                  <th colspan="1" class="tengah"><font size="1"><strong><?php echo $tl8 = " Rp " . number_format($tl8,0,',','.'); ?></strong></font></th>
                  <th colspan="1" class="tengah"><font size="1"><strong><?php echo $tl9 = " Rp " . number_format($tl9,0,',','.'); ?></strong></font></th>
                  <th colspan="1" class="tengah"><font size="1"><strong><?php echo $tl10 = " Rp " . number_format($tl10,0,',','.'); ?></strong></font></th>
                  <th colspan="1" class="tengah"><font size="1"><strong><?php echo $tl11 = " Rp " . number_format($tl11,0,',','.'); ?></strong></font></th>
                  <th colspan="1" class="tengah"><font size="1"><strong><?php echo $total = " Rp " . number_format($total,0,',','.'); ?></strong></font></th> 
                </tr>
              </tfoot>
              <?php 
            } 
            ?>
          </table>
        </div>
        <?php 
        if($id_set=='reset'){
          echo "<p>Seluruh Data (All Time)</p>";
        }else{
          ?>
          <p><?php echo 'Data Pada Bulan : '.$data['bulan'].' - Minggu ke - '.$data['minggu'].' ( '.$tanggal_awal.' s/d '.$tanggal_akhir.' )';?></p>
          <?php
        }
        ?>
      </div></body></html>
      <?php

        $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        require_once(APPPATH . 'third_party/mpdf60/mpdf.php');
        $nama_dokumen='Export_Data_Rekapitulasi_Omzet_C_'.$id_cabang.'_'.$tanggal_awal.'_'.$tanggal_akhir;
        $mpdf=new mPDF('utf-8', 'F4-L');
        $mpdf->SetDisplayMode('fullwidth');
        $mpdf->WriteHTML(utf8_encode($html));
        ob_end_clean();
        $mpdf->Output($nama_dokumen.".pdf" ,'D');
      }
    }

    /*============================================POSISI UANG========================================*/
    function e_posisi_uang(){
      error_reporting(0);
      $this->session->set_userdata(array('location' => 'Proses Export Data Posisi Uang'));
      $data['sess_location'] = $this->session->userdata('location');
      $data['session'] = $this->session->all_userdata();
      $level = $this->session->userdata('level_user');
      $username = $this->session->userdata('username');
      $id_cabang = $this->session->userdata('id_cabang');
      if($level == 'Admin'){
        $id_user = $this->input->get('id');
      }else{
        $id_user = $this->session->userdata('id_user');
      }
      $id_set = $this->input->post('id_set');
      $get_all = $this->m_omzet_harian->get_pencarian_data_all($id_user,$id_set);
      $data['namalengkap'] =strtoupper($this->session->userdata('namauser'));
      $data['namadepan'] = explode(' ',$this->session->userdata('namauser'));
      $data['firstname'] = strtoupper($data['namadepan'][0]);
      if(empty($get_omzet) && empty($get_kasbon) && empty($get_biaya) && empty($get_all)){
        $this->session->set_flashdata('gagal_cetak','Data yang anda inginkan belum terdapat di database, Export Data Gagal.');
        if($level == 'Admin'){
          redirect('view_progress');
        }else{
          redirect('posisi_uang');
        }
      }
      else{
        ob_start();
        ?>
        <html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" >
          <style>
            .tengah{
              text-align:center;
            }
            .kiri{
              text-align:left;
            }
            .kanan{
              text-align:right;
            }
          </style>
        </head><body>
          <table border='0' align='LEFT'>
            <tr>
              <th>
                <img src="<?php echo base_url('build/img/xyz_2.png');?>"  align="left" width='165' height='150px' >
              </th>
              <th width="20">
              </th>
              <th width="2339px" align="left">
                <?php $value = date('Y-m-d');
                $tgl = date_create($value);
                $hasil = date_format($tgl,'d-m-Y');?>  
                <h1> <left> EXPORT LAPORAN <br>CV. XYZ<br> </left><center> <?php echo "Tanggal Diterbitkan : $hasil"; ?> </center></h1>
              </th>
            </tr>
          </table>
          <hr style="height:4px;" />
          <br>
          <h4 class="tengah"><font face="arial"><strong><u>LAPORAN INFORMASI POSISI UANG</u></strong></font></h4>
          <br>
          <div class="x_content">
            <div class="table-responsive">
              <table border="1" class="table">
                <thead>
                  <tr>
                    <th rowspan="2" class="tengah" width="3%">No</th>
                    <th rowspan="2" class="tengah" width="2%">Bulan</th>
                    <th rowspan="2" class="tengah" width="2%">Minggu</th>
                    <th rowspan="2" class="tengah" width="2%">Hari</th>
                    <th rowspan="2" class="tengah" width="2%">Tanggal</th>
                    <th colspan="3" class="tengah">Item Perhitungan</th>
                    <th rowspan="2" class="tengah" width="2%">Posisi Uang</th>
                  </tr>
                  <tr>
                    <th rowspan="1" class="tengah" width="2%">Total Omzet</th>
                    <th rowspan="1" class="tengah" width="2%">Total Casbon</th>
                    <th rowspan="1" class="tengah" width="2%">Total Biaya Operasional</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $v = isset($get_all[0]['tanggal_awal'])?$get_all[0]['tanggal_awal']:'';
                  $tgl_a = date_create($v);
                  $tahun = date_format($tgl_a,'Y');
                  ?>
                  <tr>
                    <th colspan="9" class="tengah"><font size="2">Minggu ke - <?php echo isset($get_all[0]['minggu'])?$get_all[0]['minggu']:'';?> (<?php echo isset($get_all[0]['bulan'])?$get_all[0]['bulan']:'';?> - <?php echo $tahun;?>)</font></th>
                  </tr>
                  <?php
                  if(!empty($get_all))
                  {
                    $jum_b=0;
                    $jum_o=0;
                    $jum_k=0;
                    $no=1;
                    $total_b=0;
                    $total_k=0;
                    $total_o=0;
                    $total_all=0;
                    $posisi_uang=0;
                    $tl1 = 0;
                    $tl2 = 0;
                    $tl3 = 0;
                    foreach ($get_all as $data) {
                      $tgl1 = date_create($data['tanggal_awal']);
                      $tgl2 = date_create($data['tanggal_akhir']);
                      $tanggal_awal = date_format($tgl1, 'd-m-Y');
                      $tanggal_akhir = date_format($tgl2, 'd-m-Y');
                      $bln = $data['bulan'];
                      $mg = $data['minggu'];
                      $tgl = date_create($data['tanggal_omzet']);
                      $tanggal = date_format($tgl, "d-m-Y");
                      $hari = $data['hari_omzet'];
                      $omzet1 = $data['omzet_lap_1'];
                      $omzet2 = $data['omzet_lap_2'];
                      $omzet3 = $data['omzet_lap_3'];
                      $omzet4 = $data['omzet_lap_4'];
                      $omzet5 = $data['omzet_lap_5'];
                      $omzet6 = $data['omzet_lap_6'];
                      $omzet7 = $data['omzet_lap_7'];
                      $omzet8 = $data['omzet_lap_8'];
                      $omzet9 = $data['omzet_lap_9'];
                      $omzet10 = $data['omzet_lap_10'];
                      $omzet11 = $data['omzet_lap_11'];
                      $jum_o = $omzet1+$omzet2+$omzet3+$omzet4+$omzet5+$omzet6+$omzet7+$omzet8+$omzet9+$omzet10+$omzet11;
                      $jml_omzet = "Rp" . number_format($jum_o,0,',','.');
                      if (is_numeric($jum_o)) {
                        $total_o += $jum_o;
                      } else {
                        $total_0 = 0;
                      }

                      $kasbon1 = $data['kasbon_lap_1'];
                      $kasbon2 = $data['kasbon_lap_2'];
                      $kasbon3 = $data['kasbon_lap_3'];
                      $kasbon4 = $data['kasbon_lap_4'];
                      $kasbon5 = $data['kasbon_lap_5'];
                      $kasbon6 = $data['kasbon_lap_6'];
                      $kasbon7 = $data['kasbon_lap_7'];
                      $kasbon8 = $data['kasbon_lap_8'];
                      $kasbon9 = $data['kasbon_lap_9'];
                      $kasbon10 = $data['kasbon_lap_10'];
                      $kasbon11 = $data['kasbon_lap_11'];
                      $L1 = $data['kasbon_leader_1'];
                      $L2 = $data['kasbon_leader_2'];
                      $ATL = $data['kasbon_asis_tl'];
                      $GL = $data['kasbon_gl'];
                      $TM = $data['kasbon_t_masak'];
                      $TR = $data['kasbon_training'];
                      $jum_k = $kasbon1+$kasbon2+$kasbon3+$kasbon4+$kasbon5+$kasbon6+$kasbon7+$kasbon8+$kasbon9+$kasbon10+$kasbon11+$L1+$L2+$ATL+$GL+$TM+$TR;
                      $jml_kasbon = "Rp " . number_format($jum_k,0,',','.');
                      if (is_numeric($jum_k)) {
                        $total_k += $jum_k;
                      } else {
                        $total_k = 0;
                      }

                      $b1 = $data['biaya_beras'];
                      $b2 = $data['biaya_air_galon'];
                      $b3 = $data['biaya_gas'];
                      $b4 = $data['biaya_resiko'];
                      $b5 = $data['biaya_lain'];
                      $jum_b = $b1+$b2+$b3+$b4+$b5;
                      $jml_biaya = "Rp " . number_format($jum_b,0,',','.');
                      if (is_numeric($jum_b)) {
                        $total_b += $jum_b;
                      } else {
                        $total_b = 0;
                      }

                      $posisi_uang=($total_o-$total_k-$total_b);
                      $p_u = "Rp " . number_format($posisi_uang,0,',','.');
                      if (is_numeric($posisi_uang)) {
                        $total_all += $posisi_uang;
                      } else {
                        $total_all = 0;
                      }

                      $tl1 += $total_o;
                      $tl2 += $total_k;
                      $tl3 += $total_b;
                      ?>
                      <tr>
                        <td class="tengah"><font size="2"><?php echo $no++; ?></font></td>
                        <td class="tengah"><font size="2"><?php echo $bln; ?></font></td>
                        <td class="tengah"><font size="2"><?php echo $mg; ?></font></td>
                        <td class="tengah"><font size="2"><?php echo $hari; ?></font></td>
                        <td class="tengah"><font size="2"><?php echo $tanggal; ?></font></td>                      
                        <td class="tengah"><font size="2"> <?php echo $total_o = "Rp " . number_format($total_o,0,',','.'); ?></font></td> 
                        <td class="tengah"><font size="2"> <?php echo $total_k = "Rp " . number_format($total_k,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="2"> <?php echo $total_b = "Rp " . number_format($total_b,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="2"> <?php echo $p_u; ?></font></td>
                      </tr>
                      <?php 
                    }
                  }else{
                   ?>
                   <table>
                    <tr>
                      <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-close"></i> Belum terdapat data apapun pada database.
                      </div>
                    </tr>
                  </table>
                  <?php
                }
                ?>
              </tbody>
              <?php if(!empty($get_all)){?>
                <tfoot>
                  <tr>
                    <th colspan="5" class="tengah"><font size="3">Total Jumlah</font></th>
                    <th colspan="1" class="tengah"><font size="3"><strong><?php echo $tl1 = "Rp " . number_format($tl1,0,',','.'); ?></strong></font></th>
                    <th colspan="1" class="tengah"><font size="3"><strong><?php echo $tl2 = "Rp " . number_format($tl2,0,',','.'); ?></strong></font></th>
                    <th colspan="1" class="tengah"><font size="3"><strong><?php echo $tl3 = "Rp " . number_format($tl3,0,',','.'); ?></strong></font></th>
                    <th colspan="1" class="tengah"><font size="3"><strong><?php echo $total_all = "Rp " . number_format($total_all,0,',','.'); ?></strong></font></th> 
                  </tr>
                </tfoot>
              <?php } ?>
            </table>
          </div>
          <?php 
          if($id_set=='reset'){
            echo "<p>Seluruh Data (All Time)</p><br><br>";
          }else{
            ?>
            <p><?php echo 'Data Pada Bulan : '.$data['bulan'].' - Minggu ke - '.$data['minggu'].' ( '.$tanggal_awal.' s/d '.$tanggal_akhir.' )';?></p><br><br>
            <?php
          }
          ?>
        </div></body></html>
        <?php
        $html = ob_get_clean();
        $nama_dokumen='Export_Laporan_Posisi_Uang_C-'.$id_cabang.'('.$tanggal_awal.'s_d'.$tanggal_akhir.')';
        require_once(APPPATH . 'third_party/mpdf60/mpdf.php');
        $mpdf=new mPDF('utf-8', 'F4-L'); // Create new mPDF Document
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen.".pdf" ,'D');
        exit;
      }
    }

    /*===========================================DETAIL=======================================*/
    function e_detail(){
      error_reporting(0);
      $this->session->set_userdata(array('location' => 'Proses Export Data Posisi Uang'));
      $data['sess_location'] = $this->session->userdata('location');
      $data['session'] = $this->session->all_userdata();
      $level = $this->session->userdata('level_user');
      $username = $this->session->userdata('username');
      $id_set = $this->input->post('id_set');
      $id_user = $this->uri->segment(3);
      $data['get_id']=$id_user;
      $id_cabang = $this->uri->segment(4);
      $data['get_c']=$id_cabang;
      $jabatan_sales = 'Sales';
      $jabatan_tl1 = 'Team Leader 1';
      $jabatan_tl2 = 'Team Leader 2';
      $jabatan_gl = 'Gruof Leader';
      $jabatan_al = 'Asis Leader';
      $get_sales = $this->m_user->get_data_sales($id_cabang,$jabatan_sales);
      $get_tl1 = $this->m_user->get_data_tl1($id_cabang,$jabatan_tl1);
      $get_tl2 = $this->m_user->get_data_tl2($id_cabang,$jabatan_tl2);
      $get_gl = $this->m_user->get_data_gl($id_cabang,$jabatan_gl);
      $get_al = $this->m_user->get_data_al($id_cabang,$jabatan_al);

      $get_set_input =$this->m_view_progress->get_data_set_input($id_user);
      $get_omzet=$this->m_view_progress->get_data_omzet($id_user, $id_set);
      $get_kasbon=$this->m_view_progress->get_data_kasbon($id_user, $id_set);
      $get_biaya=$this->m_view_progress->get_data_biaya_op($id_user, $id_set);
      $get_all=$this->m_view_progress->get_data_all($id_user, $id_set);
      $get_gaji=$this->m_view_progress->get_data_gaji($id_user, $id_set);

      $get_persen = $this->m_set_persen->get_data($id_user);
      $get_gaji_al = $this->m_set_persen->get_data_set_al($id_user);
      $get_jml_lap = $this->m_user->get_data_set_jml_lap($id_user);
      $get_gaji_tm = $this->m_set_persen->get_data_pencarian_set_tm($id_user,$id_set);
      $get_bop = $this->m_set_persen->get_data_pencarian_set_by_op($id_user,$id_set);
      $get_ob = $this->m_set_persen->get_data_pencarian_set_ongkos_belanja($id_user,$id_set);
      $data['namalengkap'] =strtoupper($this->session->userdata('namauser'));
      $data['namadepan'] = explode(' ',$this->session->userdata('namauser'));
      $data['firstname'] = strtoupper($data['namadepan'][0]);

      if(empty($get_omzet) && empty($get_kasbon) && empty($get_biaya) && empty($get_all) && empty($get_gaji) && empty($get_gaji_tm) && empty($get_bop) && empty($get_ob)){
        $this->session->set_flashdata('gagal_cetak','Data yang anda inginkan belum terdapat di database, Export Data Gagal.');
        if($level == 'Admin'){
          redirect('view_progress');
        }
      }
      else{
        ob_start();?>
        <html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
          <style>
            .tengah{
              text-align:center;
            }
            .kiri{
              text-align:left;
            }
            .kanan{
              text-align:right;
            }
          </style>
        </head><body>
          <table border='0' align='LEFT'>
            <tr>
              <th>
                <img src="<?php echo base_url('build/img/xyz_2.png');?>"  align="left" width='165' height='150px' >
              </th>
              <th width="20">
              </th>
              <th width="2339px" align="left">
                <?php $value = date('Y-m-d');
                $tgl = date_create($value);
                $hasil = date_format($tgl,'d-m-Y');?>  
                <h1> <left> EXPORT LAPORAN <br>CV. XYZ<br> </left><center> <?php echo "Tanggal Diterbitkan : $hasil"; ?> </center></h1>
              </th>
            </tr>
          </table>
          <hr style="height:4px;" />
          <br>
          <h4 class="tengah"><font face="arial"><strong><u>LAPORAN INFORMASI DETAIL</u></strong></font></h4>
          <br>
          <div class="x_content">
            <p>*Data Posisi Uang</p>
            <div class="table-responsive">
              <table border="1" class="table">
                <thead>
                  <tr>
                    <th rowspan="2" class="tengah" width="3%">No</th>
                    <th rowspan="2" class="tengah" width="2%">Bulan</th>
                    <th rowspan="2" class="tengah" width="2%">Minggu</th>
                    <th rowspan="2" class="tengah" width="2%">Hari</th>
                    <th rowspan="2" class="tengah" width="2%">Tanggal</th>
                    <th colspan="3" class="tengah">Item Perhitungan</th>
                    <th rowspan="2" class="tengah" width="2%">Posisi Uang</th>
                  </tr>
                  <tr>
                    <th rowspan="1" class="tengah" width="2%">Total Omzet</th>
                    <th rowspan="1" class="tengah" width="2%">Total Casbon</th>
                    <th rowspan="1" class="tengah" width="2%">Total Biaya Operasional</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $v = isset($get_all[0]['tanggal_awal'])?$get_all[0]['tanggal_awal']:'';
                  $tgl_a = date_create($v);
                  $tahun = date_format($tgl_a,'Y');
                  ?>
                  <tr>
                    <th colspan="9" class="tengah">Minggu ke - <?php echo isset($get_all[0]['minggu'])?$get_all[0]['minggu']:'';?> (<?php echo isset($get_all[0]['bulan'])?$get_all[0]['bulan']:'';?> - <?php echo $tahun;?>)</th>
                  </tr>
                  <?php
                  //jika data user tidak kosong maka jalankan perintah dibawah ini
                  if(!empty($get_all))
                  {
                    //load data user
                    //load data user
                    $jum_b=0;
                    $jum_o=0;
                    $jum_k=0;
                    $no=1;
                    $total_b=0;
                    $total_k=0;
                    $total_o=0;
                    $total_all=0;
                    $posisi_uang=0;
                    $tl1 = 0;
                    $tl2 = 0;
                    $tl3 = 0;
                    foreach ($get_all as $data) {
                      $bln = $data['bulan'];
                      $mg = $data['minggu'];
                      $tgl = date_create($data['tanggal_omzet']);
                      $tanggal = date_format($tgl, "d-m-Y");
                      $hari = $data['hari_omzet'];

                      $tgl1 = date_create($data['tanggal_awal']);
                      $tgl2 = date_create($data['tanggal_akhir']);
                      $tanggal_awal = date_format($tgl1, 'd-m-Y');
                      $tanggal_akhir = date_format($tgl2, 'd-m-Y');
                      $omzet1 = $data['omzet_lap_1'];
                      $omzet2 = $data['omzet_lap_2'];
                      $omzet3 = $data['omzet_lap_3'];
                      $omzet4 = $data['omzet_lap_4'];
                      $omzet5 = $data['omzet_lap_5'];
                      $omzet6 = $data['omzet_lap_6'];
                      $omzet7 = $data['omzet_lap_7'];
                      $omzet8 = $data['omzet_lap_8'];
                      $omzet9 = $data['omzet_lap_9'];
                      $omzet10 = $data['omzet_lap_10'];
                      $omzet11 = $data['omzet_lap_11'];
                      $jum_o = $omzet1+$omzet2+$omzet3+$omzet4+$omzet5+$omzet6+$omzet7+$omzet8+$omzet9+$omzet10+$omzet11;
                      $jml_omzet = "Rp" . number_format($jum_o,0,',','.');
                      if (is_numeric($jum_o)) {
                        $total_o += $jum_o;
                      } else {
                        $total_0 = 0;
                      }

                      $kasbon1 = $data['kasbon_lap_1'];
                      $kasbon2 = $data['kasbon_lap_2'];
                      $kasbon3 = $data['kasbon_lap_3'];
                      $kasbon4 = $data['kasbon_lap_4'];
                      $kasbon5 = $data['kasbon_lap_5'];
                      $kasbon6 = $data['kasbon_lap_6'];
                      $kasbon7 = $data['kasbon_lap_7'];
                      $kasbon8 = $data['kasbon_lap_8'];
                      $kasbon9 = $data['kasbon_lap_9'];
                      $kasbon10 = $data['kasbon_lap_10'];
                      $kasbon11 = $data['kasbon_lap_11'];
                      $L1 = $data['kasbon_leader_1'];
                      $L2 = $data['kasbon_leader_2'];
                      $ATL = $data['kasbon_asis_tl'];
                      $GL = $data['kasbon_gl'];
                      $TM = $data['kasbon_t_masak'];
                      $TR = $data['kasbon_training'];
                      $jum_k = $kasbon1+$kasbon2+$kasbon3+$kasbon4+$kasbon5+$kasbon6+$kasbon7+$kasbon8+$kasbon9+$kasbon10+$kasbon11+$L1+$L2+$ATL+$GL+$TM+$TR;
                      $jml_kasbon = "Rp " . number_format($jum_k,0,',','.');
                      if (is_numeric($jum_k)) {
                        $total_k += $jum_k;
                      } else {
                        $total_k = 0;
                      }

                      $b1 = $data['biaya_beras'];
                      $b2 = $data['biaya_air_galon'];
                      $b3 = $data['biaya_gas'];
                      $b4 = $data['biaya_resiko'];
                      $b5 = $data['biaya_lain'];
                      $jum_b = $b1+$b2+$b3+$b4+$b5;
                      $jml_biaya = "Rp " . number_format($jum_b,0,',','.');
                      if (is_numeric($jum_b)) {
                        $total_b += $jum_b;
                      } else {
                        $total_b = 0;
                      }

                      $posisi_uang=($total_o-$total_k-$total_b);
                      $p_u = "Rp " . number_format($posisi_uang,0,',','.');
                      if (is_numeric($posisi_uang)) {
                        $total_all += $posisi_uang;
                      } else {
                        $total_all = 0;
                      }

                      $tl1 += $total_o;
                      $tl2 += $total_k;
                      $tl3 += $total_b;
                      ?>
                      <tr>
                        <td class="tengah"><font size="2"><?php echo $no++; ?></font></td>
                        <td class="tengah"><font size="2"><?php echo $bln; ?></font></td>
                        <td class="tengah"><font size="2"><?php echo $mg; ?></font></td>
                        <td class="tengah"><font size="2"><?php echo $hari; ?></font></td>
                        <td class="tengah"><font size="2"><?php echo $tanggal; ?></font></td>                      
                        <td><font size="2"> <?php echo $total_o = "Rp " . number_format($total_o,0,',','.'); ?></font></td> 
                        <td><font size="2"> <?php echo $total_k = "Rp " . number_format($total_k,0,',','.'); ?></font></td>
                        <td><font size="2"> <?php echo $total_b = "Rp " . number_format($total_b,0,',','.'); ?></font></td>
                        <td><font size="2"> <?php echo $p_u; ?></font></td>
                      </tr>
                      <?php
                    }
                  }else{
                   ?>
                   <table>
                    <tr>
                      <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-close"></i> Belum terdapat data apapun pada database.
                      </div>
                    </tr>
                  </table>
                  <?php
                }
                ?>
              </tbody>
              <?php if(!empty($get_all)){?>
                <tfoot>
                  <tr>                
                    <th colspan="5" class="tengah">Total Jumlah</th>
                    <th colspan="1" class="kiri"><font size="2"><strong><?php echo $tl1 = "Rp " . number_format($tl1,0,',','.'); ?></strong></font></th>
                    <th colspan="1" class="kiri"><font size="2"><strong><?php echo $tl2 = "Rp " . number_format($tl2,0,',','.'); ?></strong></font></th>
                    <th colspan="1" class="kiri"><font size="2"><strong><?php echo $tl3 = "Rp " . number_format($tl3,0,',','.'); ?></strong></font></th>
                    <th colspan="1" class="kiri"><font size="2"><strong><?php echo $total_all = "Rp " . number_format($total_all,0,',','.'); ?></strong></font></th> 
                  </tr>
                </tfoot>
              <?php } ?>
            </table>
          </div>
          <?php 
          if($id_set=='reset'){
            echo "<p>Seluruh Data (All Time)</p><br><br>";
          }else{
            ?>
            <p><?php echo 'Data Pada Bulan : '.$data['bulan'].' - Minggu ke - '.$data['minggu'].' ( '.$tanggal_awal.' s/d '.$tanggal_akhir.' )';?></p>
            <?php
          }
          ?>
        </div>
        <hr style="height:2px;" />
        <p>Dengan Rincian sebagai berikut :</p>
        <div style="page-break-after:always;">
          <div class="x_content">
            <p>*Data Omzet</p>
            <div class="table-responsive">
              <table border="1" class="table">
                <thead>
                  <tr>
                    <th rowspan="3" class="tengah" width="3%">No</th>
                    <th rowspan="3" class="tengah" width="5%">Bulan</th>
                    <th rowspan="3" class="tengah" width="5%">Minggu</th>
                    <th rowspan="3" class="tengah" width="4%">Cab</th>
                    <th rowspan="3" class="tengah" width="5%">Hari</th>
                    <th rowspan="3" class="tengah" width="6%">Tanggal</th>
                    <th colspan="11" class="tengah">Lapangan/Nama</th>
                    <th rowspan="3" class="tengah" width="5%">Jumlah</th>
                  </tr>
                  <tr>
                    <th rowspan="1" class="tengah" width="5%">1</th>
                    <th rowspan="1" class="tengah" width="5%">2</th>
                    <th rowspan="1" class="tengah" width="5%">3</th>
                    <th rowspan="1" class="tengah" width="5%">4</th>
                    <th rowspan="1" class="tengah" width="5%">5</th>
                    <th rowspan="1" class="tengah" width="5%">6</th>
                    <th rowspan="1" class="tengah" width="5%">7</th>
                    <th rowspan="1" class="tengah" width="5%">8</th>
                    <th rowspan="1" class="tengah" width="5%">9</th>
                    <th rowspan="1" class="tengah" width="5%">10</th>
                    <th rowspan="1" class="tengah" width="5%">11</th>
                  </tr>
                  <tr>
                    <?php if(!empty($get_sales)){
                      foreach ($get_sales as $data) {
                        $nama = $data['namauser'];
                        ?>
                        <th rowspan="1" class="tengah" width="100"><font size="1"><?php echo ucwords($nama);?></font></th>
                        <?php 
                      }
                    } 
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $v = isset($get_omzet[0]['tanggal_awal'])?$get_omzet[0]['tanggal_awal']:'';
                  $tgl_a = date_create($v);
                  $tahun = date_format($tgl_a,'Y');
                  ?>
                  <tr>
                    <th colspan="18" class="tengah">Minggu ke - <?php echo isset($get_omzet[0]['minggu'])?$get_omzet[0]['minggu']:'';?> (<?php echo isset($get_omzet[0]['bulan'])?$get_omzet[0]['bulan']:'';?> - <?php echo $tahun;?>)</th>
                  </tr>
                  <?php
                  if(!empty($get_omzet))
                  {
                    $jum=0;
                    $no=1;
                    $total=0;
                    $tl1 = 0;
                    $tl2 = 0;
                    $tl3 = 0;
                    $tl4 = 0;
                    $tl5 = 0;
                    $tl6 = 0;
                    $tl7 = 0;
                    $tl8 = 0;
                    $tl9 = 0;
                    $tl10 = 0;
                    $tl11 = 0;
                    foreach ($get_omzet as $data) {
                      $bln = $data['bulan'];
                      $mg = $data['minggu'];
                      $tgl = date_create($data['tanggal']);
                      $tanggal = date_format($tgl, "d-m-Y");
                      $hari = $data['hari'];
                      $cab = $data['id_cabutan'];
                      $lap1 = $data['omzet_lap_1'];
                      $lap2 = $data['omzet_lap_2'];
                      $lap3 = $data['omzet_lap_3'];
                      $lap4 = $data['omzet_lap_4'];
                      $lap5 = $data['omzet_lap_5'];
                      $lap6 = $data['omzet_lap_6'];
                      $lap7 = $data['omzet_lap_7'];
                      $lap8 = $data['omzet_lap_8'];
                      $lap9 = $data['omzet_lap_9'];
                      $lap10 = $data['omzet_lap_10'];
                      $lap11 = $data['omzet_lap_11'];
                      $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11;
                      $jml = "Rp " . number_format($jum,0,',','.');
                      $total += $jum;
                      $tl1 += $lap1;
                      $tl2 += $lap2;
                      $tl3 += $lap3;
                      $tl4 += $lap4;
                      $tl5 += $lap5;
                      $tl6 += $lap6;
                      $tl7 += $lap7;
                      $tl8 += $lap8;
                      $tl9 += $lap9;
                      $tl10 += $lap10;
                      $tl11 += $lap11;
                      ?>
                      <tr>
                        <td class="tengah"><font size="1"><?php echo $no++; ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $cab; ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $hari; ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $tanggal; ?></font></td>                      
                        <td><font size="1"> <?php echo $lap1 = "Rp " . number_format($lap1,0,',','.'); ?></font></td> 
                        <td><font size="1"> <?php echo $lap2 = "Rp " . number_format($lap2,0,',','.'); ?></font></td>
                        <td><font size="1"> <?php echo $lap3 = "Rp " . number_format($lap3,0,',','.'); ?></font></td>
                        <td><font size="1"> <?php echo $lap4 = "Rp " . number_format($lap4,0,',','.'); ?></font></td>
                        <td><font size="1"> <?php echo $lap5 = "Rp " . number_format($lap5,0,',','.'); ?></font></td>
                        <td><font size="1"> <?php echo $lap6 = "Rp " . number_format($lap6,0,',','.'); ?></font></td>
                        <td><font size="1"> <?php echo $lap7 = "Rp " . number_format($lap7,0,',','.'); ?></font></td>
                        <td><font size="1"> <?php echo $lap8 = "Rp " . number_format($lap8,0,',','.'); ?></font></td>
                        <td><font size="1"> <?php echo $lap9 = "Rp " . number_format($lap9,0,',','.'); ?></font></td>
                        <td><font size="1"> <?php echo $lap10 = "Rp " . number_format($lap10,0,',','.'); ?></font></td>
                        <td><font size="1"> <?php echo $lap11 = "Rp " . number_format($lap11,0,',','.'); ?></font></td>
                        <td><font size="1"> <?php echo $jml; ?></font></td>
                      </tr>
                      <?php
                    }
                  }else{
                   ?>
                   <table>
                    <tr>
                      <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-close"></i> Belum terdapat data apapun pada database.
                      </div>
                    </tr>
                  </table>
                  <?php
                }
                ?>
              </tbody>
              <?php if(!empty($get_omzet)){?>
                <tfoot>
                  <tr>                
                    <th colspan="6" class="tengah">Total Jumlah</th>
                    <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl1 = "Rp " . number_format($tl1,0,',','.'); ?></strong></font></th>
                    <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl2 = "Rp " . number_format($tl2,0,',','.'); ?></strong></font></th>
                    <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl3 = "Rp " . number_format($tl3,0,',','.'); ?></strong></font></th>
                    <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl4 = "Rp " . number_format($tl4,0,',','.'); ?></strong></font></th>
                    <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl5 = "Rp " . number_format($tl5,0,',','.'); ?></strong></font></th>
                    <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl6 = "Rp " . number_format($tl6,0,',','.'); ?></strong></font></th>
                    <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl7 = "Rp " . number_format($tl7,0,',','.'); ?></strong></font></th>
                    <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl8 = "Rp " . number_format($tl8,0,',','.'); ?></strong></font></th>
                    <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl9 = "Rp " . number_format($tl9,0,',','.'); ?></strong></font></th>
                    <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl10 = "Rp " . number_format($tl10,0,',','.'); ?></strong></font></th>
                    <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl11 = "Rp " . number_format($tl11,0,',','.'); ?></strong></font></th>
                    <th colspan="1" class="kiri"><font size="1"><strong><?php echo $total = "Rp " . number_format($total,0,',','.'); ?></strong></font></th> 
                  </tr>
                </tfoot>
              <?php } ?>
            </table>
          </div>
        </div>
      </div>
      <div style="page-break-inside:avoid;">
        <div class="x_content">
          <p>*Data Cashbon</p>
          <div class="table-responsive">
            <table border="1" class="table">
              <thead>
                <tr>
                  <th rowspan="2" class="tengah" width="3%"><font size="3">No</font></th>
                  <th rowspan="2" class="tengah" width="5%"><font size="3">Bln</font></th>
                  <th rowspan="2" class="tengah" width="3%"><font size="3">Mg</font></th>
                  <th rowspan="2" class="tengah" width="3%"><font size="3">Cab</font></th>
                  <th rowspan="2" class="tengah" width="3%"><font size="3">Hari</font></th>
                  <th rowspan="2" class="tengah" width="3%"><font size="3">Tgl</font></th>
                  <th colspan="17" class="tengah"><font size="3">Jabatan/Lapangan</font></th>
                  <th rowspan="2" class="tengah" width="6%"><font size="3">Jml</font></th>
                </tr>
                <tr>
                  <th rowspan="1" class="tengah" width="5%"><font size="3">1</font></th>
                  <th rowspan="1" class="tengah" width="5%"><font size="3">2</font></th>
                  <th rowspan="1" class="tengah" width="5%"><font size="3">3</font></th>
                  <th rowspan="1" class="tengah" width="5%"><font size="3">4</font></th>
                  <th rowspan="1" class="tengah" width="5%"><font size="3">5</font></th>
                  <th rowspan="1" class="tengah" width="5%"><font size="3">6</font></th>
                  <th rowspan="1" class="tengah" width="5%"><font size="3">7</font></th>
                  <th rowspan="1" class="tengah" width="5%"><font size="3">8</font></th>
                  <th rowspan="1" class="tengah" width="5%"><font size="3">9</font></th>
                  <th rowspan="1" class="tengah" width="5%"><font size="3">10</font></th>
                  <th rowspan="1" class="tengah" width="5%"><font size="3">11</font></th>
                  <th rowspan="1" class="tengah" width="5%"><font size="3">L1</font></th>
                  <th rowspan="1" class="tengah" width="5%"><font size="3">L2</font></th>
                  <th rowspan="1" class="tengah" width="5%"><font size="3">ATL</font></th>
                  <th rowspan="1" class="tengah" width="5%"><font size="3">GL</font></th>
                  <th rowspan="1" class="tengah" width="5%"><font size="3">TM</font></th>
                  <th rowspan="1" class="tengah" width="5%"><font size="3">TR</font></th>
                </tr>
              </thead>
              <tbody>
               <?php 
               $v = isset($get_kasbon[0]['tanggal_awal'])?$get_kasbon[0]['tanggal_awal']:'';
               $tgl_a = date_create($v);
               $tahun = date_format($tgl_a,'Y');
               ?>
               <tr>
                <th colspan="24" class="tengah">Minggu ke - <?php echo isset($get_kasbon[0]['minggu'])?$get_kasbon[0]['minggu']:'';?> (<?php echo isset($get_kasbon[0]['bulan'])?$get_kasbon[0]['bulan']:'';?> - <?php echo $tahun;?>)</th>
              </tr>
              <?php
              if(!empty($get_kasbon))
              {
                $jum=0;
                $no=1;
                $total=0;
                $tl1 = 0;
                $tl2 = 0;
                $tl3 = 0;
                $tl4 = 0;
                $tl5 = 0;
                $tl6 = 0;
                $tl7 = 0;
                $tl8 = 0;
                $tl9 = 0;
                $tl10 = 0;
                $tl11 = 0;
                $tl12 = 0;
                $tl13 = 0;
                $tl14 = 0;
                $tl15 = 0;
                $tl16 = 0;
                $tl17 = 0;

                foreach ($get_kasbon as $data) {
                  $bln = $data['bulan'];
                  $mg = $data['minggu'];
                  $cab = $data['id_cabutan'];
                  $tgl = date_create($data['tanggal']);
                  $tanggal = date_format($tgl, "d-m-Y");
                  $hari = $data['hari'];
                  $lap1 = $data['kasbon_lap_1'];
                  $lap2 = $data['kasbon_lap_2'];
                  $lap3 = $data['kasbon_lap_3'];
                  $lap4 = $data['kasbon_lap_4'];
                  $lap5 = $data['kasbon_lap_5'];
                  $lap6 = $data['kasbon_lap_6'];
                  $lap7 = $data['kasbon_lap_7'];
                  $lap8 = $data['kasbon_lap_8'];
                  $lap9 = $data['kasbon_lap_9'];
                  $lap10 = $data['kasbon_lap_10'];
                  $lap11 = $data['kasbon_lap_11'];
                  $L1 = $data['kasbon_leader_1'];
                  $L2 = $data['kasbon_leader_2'];
                  $ATL = $data['kasbon_asis_tl'];
                  $GL = $data['kasbon_gl'];
                  $TM = $data['kasbon_t_masak'];
                  $TR = $data['kasbon_training'];
                  $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11+$L1+$L2+$ATL+$GL+$TM+$TR;
                  $jml = "Rp " . number_format($jum,0,',','.');
                  $total += $jum;
                  $tl1 += $lap1;
                  $tl2 += $lap2;
                  $tl3 += $lap3;
                  $tl4 += $lap4;
                  $tl5 += $lap5;
                  $tl6 += $lap6;
                  $tl7 += $lap7;
                  $tl8 += $lap8;
                  $tl9 += $lap9;
                  $tl10 += $lap10;
                  $tl11 += $lap11;

                  $tl12 += $L1;
                  $tl13 += $L2;
                  $tl14 += $ATL;
                  $tl15 += $GL;
                  $tl16 += $TM;
                  $tl17 += $TR;

                  ?>
                  <tr>
                    <td class="tengah"><font size="1"><?php echo $no++; ?></font></td>
                    <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                    <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                    <td class="tengah"><font size="1"><?php echo $cab; ?></font></td>
                    <td class="tengah"><font size="1"><?php echo $hari; ?></font></td>
                    <td class="tengah"><font size="1"><?php echo $tanggal; ?></font></td>                      
                    <td><font size="1"> <?php echo $lap1 = "Rp " . number_format($lap1,0,',','.'); ?></font></td> 
                    <td><font size="1"> <?php echo $lap2 = "Rp " . number_format($lap2,0,',','.'); ?></font></td>
                    <td><font size="1"> <?php echo $lap3 = "Rp " . number_format($lap3,0,',','.'); ?></font></td>
                    <td><font size="1"> <?php echo $lap4 = "Rp " . number_format($lap4,0,',','.'); ?></font></td>
                    <td><font size="1"> <?php echo $lap5 = "Rp " . number_format($lap5,0,',','.'); ?></font></td>
                    <td><font size="1"> <?php echo $lap6 = "Rp " . number_format($lap6,0,',','.'); ?></font></td>
                    <td><font size="1"> <?php echo $lap7 = "Rp " . number_format($lap7,0,',','.'); ?></font></td>
                    <td><font size="1"> <?php echo $lap8 = "Rp " . number_format($lap8,0,',','.'); ?></font></td>
                    <td><font size="1"> <?php echo $lap9 = "Rp " . number_format($lap9,0,',','.'); ?></font></td>
                    <td><font size="1"> <?php echo $lap10 = "Rp " . number_format($lap10,0,',','.'); ?></font></td>
                    <td><font size="1"> <?php echo $lap11 = "Rp " . number_format($lap11,0,',','.'); ?></font></td>
                    <td><font size="1"> <?php echo $L1 = "Rp " . number_format($L1,0,',','.'); ?></font></td>
                    <td><font size="1"> <?php echo $L2 = "Rp " . number_format($L2,0,',','.'); ?></font></td>
                    <td><font size="1"> <?php echo $ATL = "Rp " . number_format($ATL,0,',','.'); ?></font></td>
                    <td><font size="1"> <?php echo $GL = "Rp " . number_format($GL,0,',','.'); ?></font></td>
                    <td><font size="1"> <?php echo $TM = "Rp " . number_format($TM,0,',','.'); ?></font></td>
                    <td><font size="1"> <?php echo $TR = "Rp " . number_format($TR,0,',','.'); ?></font></td>
                    <td><font size="1"> <?php echo $jml; ?></font></td>
                  </tr>
                  <?php
                }
              }else{
               ?>
               <table>
                <tr>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-close"></i> Belum terdapat data apapun pada database.
                  </div>
                </tr>
              </table>
              <?php
            }
            ?>
          </tbody>
          <?php if(!empty($get_kasbon)){?>
            <tfoot>
              <tr>                
                <th colspan="6" class="tengah">Total Jumlah</th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl1 = "Rp " . number_format($tl1,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl2 = "Rp " . number_format($tl2,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl3 = "Rp " . number_format($tl3,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl4 = "Rp " . number_format($tl4,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl5 = "Rp " . number_format($tl5,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl6 = "Rp " . number_format($tl6,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl7 = "Rp " . number_format($tl7,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl8 = "Rp " . number_format($tl8,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl9 = "Rp " . number_format($tl9,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl10 = "Rp " . number_format($tl10,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl11 = "Rp " . number_format($tl11,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl12 = "Rp " . number_format($tl12,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl13 = "Rp " . number_format($tl13,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl14 = "Rp " . number_format($tl14,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl15 = "Rp " . number_format($tl15,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl16 = "Rp " . number_format($tl16,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $tl17 = "Rp " . number_format($tl17,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="kiri"><font size="1"><strong><?php echo $total = "Rp " . number_format($total,0,',','.'); ?></strong></font></th> 
              </tr>
            </tfoot>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
  <div style="page-break-inside:avoid;">
    <div class="x_content">
      <p>*Data Biaya Operasional</p>
      <div class="table-responsive">
        <table border="1" class="table">
          <thead>
            <tr>
              <th rowspan="2" class="tengah">No</th>
              <th rowspan="2" class="tengah">Bulan</th>
              <th rowspan="2" class="tengah">Minggu</th>
              <th rowspan="2" class="tengah">ID Cabutan</th>
              <th rowspan="2" class="tengah">Hari</th>
              <th rowspan="2" class="tengah">Tanggal</th>
              <th colspan="5" class="tengah">Item Biaya Operasional</th>
              <th rowspan="2" class="tengah">Jumlah</th>
            </tr>
            <tr>
              <th rowspan="1" class="tengah">Beras</th>
              <th rowspan="1" class="tengah">Air Galon</th>
              <th rowspan="1" class="tengah">Gas LPG</th>
              <th rowspan="1" class="tengah">Resiko</th>
              <th rowspan="1" class="tengah">Lain-lain</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $v = isset($get_biaya[0]['tanggal_awal'])?$get_biaya[0]['tanggal_awal']:'';
            $tgl_a = date_create($v);
            $tahun = date_format($tgl_a,'Y');
            ?>
            <tr>
              <th colspan="12" class="tengah">Minggu ke - <?php echo isset($get_biaya[0]['minggu'])?$get_biaya[0]['minggu']:'';?> (<?php echo isset($get_biaya[0]['bulan'])?$get_biaya[0]['bulan']:'';?> - <?php echo $tahun;?>)</th>
            </tr>
            <?php
            if(!empty($get_biaya))
            {
              $jum=0;
              $no=1;
              $total=0;
              $tl1 = 0;
              $tl2 = 0;
              $tl3 = 0;
              $tl4 = 0;
              $tl5 = 0;

              foreach ($get_biaya as $data) {
                $bln = $data['bulan'];
                $mg = $data['minggu'];
                $cab = $data['id_cabutan'];
                $tgl = date_create($data['tanggal']);
                $tanggal = date_format($tgl, "d-m-Y");
                $hari = $data['hari'];
                $lap1 = $data['biaya_beras'];
                $lap2 = $data['biaya_air_galon'];
                $lap3 = $data['biaya_gas'];
                $lap4 = $data['biaya_resiko'];
                $lap5 = $data['biaya_lain'];
                $jum = $lap1+$lap2+$lap3+$lap4+$lap5;
                $jml = "Rp " . number_format($jum,0,',','.');
                $total += $jum;
                $tl1 += $lap1;
                $tl2 += $lap2;
                $tl3 += $lap3;
                $tl4 += $lap4;
                $tl5 += $lap5;
                ?>
                <tr>
                  <td class="tengah"><font size="2"><?php echo $no++; ?></font></td>
                  <td class="tengah"><font size="2"><?php echo $bln; ?></font></td>
                  <td class="tengah"><font size="2"><?php echo $mg; ?></font></td>
                  <td class="tengah"><font size="2"><?php echo $cab; ?></font></td>
                  <td class="tengah"><font size="2"><?php echo $hari; ?></font></td>
                  <td class="tengah"><font size="2"><?php echo $tanggal; ?></font></td>                      
                  <td><font size="2"> <?php echo $lap1 = "Rp " . number_format($lap1,0,',','.'); ?></font></td> 
                  <td><font size="2"> <?php echo $lap2 = "Rp " . number_format($lap2,0,',','.'); ?></font></td>
                  <td><font size="2"> <?php echo $lap3 = "Rp " . number_format($lap3,0,',','.'); ?></font></td>
                  <td><font size="2"> <?php echo $lap4 = "Rp " . number_format($lap4,0,',','.'); ?></font></td>
                  <td><font size="2"> <?php echo $lap5 = "Rp " . number_format($lap5,0,',','.'); ?></font></td>
                  <td><font size="2"> <?php echo $jml; ?></font></td>
                </tr>
                <?php
              }
            }else{
             ?>
             <table>
              <tr>
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="icon fa fa-close"></i> Belum terdapat data apapun pada database.
                </div>
              </tr>
            </table>
            <?php
          }
          ?>
        </tbody>
        <?php if(!empty($get_biaya)){?>
          <tfoot>
            <tr>                
              <th colspan="6" class="tengah">Total Jumlah</th>
              <th colspan="1" class="kiri"><font size="2"><strong><?php echo $tl1 = "Rp " . number_format($tl1,0,',','.'); ?></strong></font></th>
              <th colspan="1" class="kiri"><font size="2"><strong><?php echo $tl2 = "Rp " . number_format($tl2,0,',','.'); ?></strong></font></th>
              <th colspan="1" class="kiri"><font size="2"><strong><?php echo $tl3 = "Rp " . number_format($tl3,0,',','.'); ?></strong></font></th>
              <th colspan="1" class="kiri"><font size="2"><strong><?php echo $tl4 = "Rp " . number_format($tl4,0,',','.'); ?></strong></font></th>
              <th colspan="1" class="kiri"><font size="2"><strong><?php echo $tl5 = "Rp " . number_format($tl5,0,',','.'); ?></strong></font></th>
              <th colspan="1" class="kiri"><font size="2"><strong><?php echo $total = "Rp " . number_format($total,0,',','.'); ?></strong></font></th> 
            </tr>
          </tfoot>
        <?php } ?>
      </table>
    </div>
  </div>
</div>
<div style="page-break-inside:avoid;">
  <div class="x_content">
    <p>*Data Rekap Gaji</p>
    <div class="table-responsive">
      <table border="1" class="table">
        <thead>
          <tr>
            <th rowspan="3" class="tengah" width="7%">Jabatan</th>
            <th rowspan="3" class="tengah" width="3%">Nama</th>
            <th rowspan="3" class="tengah" width="5%">Bln</th>
            <th rowspan="3" class="tengah" width="3%">Mg</th>
            <th colspan="11" class="tengah">Lapangan/Nama</th>
            <th rowspan="3" class="tengah" width="6%">Jumlah</th>
          </tr>
          <tr>
            <th rowspan="1" class="tengah" width="3%">1</th>
            <th rowspan="1" class="tengah" width="3%">2</th>
            <th rowspan="1" class="tengah" width="3%">3</th>
            <th rowspan="1" class="tengah" width="3%">4</th>
            <th rowspan="1" class="tengah" width="3%">5</th>
            <th rowspan="1" class="tengah" width="3%">6</th>
            <th rowspan="1" class="tengah" width="3%">7</th>
            <th rowspan="1" class="tengah" width="3%">8</th>
            <th rowspan="1" class="tengah" width="3%">9</th>
            <th rowspan="1" class="tengah" width="3%">10</th>
            <th rowspan="1" class="tengah" width="3%">11</th>
          </tr>
          <tr>
            <?php if(!empty($get_sales)){
              foreach ($get_sales as $data) {
                $nama = $data['namauser'];
                ?>
                <th rowspan="1" class="tengah"><font size="1"><?php echo ucwords($nama);?></font></th>
                <?php 
              }
            }else{
              ?>
              <th rowspan="1" class="tengah"><font size="1">#</font></th>
              <?php
            } 
            ?>
          </thead>
          <tbody>
            <?php 
            $v = isset($get_omzet[0]['tanggal_awal'])?$get_omzet[0]['tanggal_awal']:'';
            $tgl_a = date_create($v);
            $tahun = date_format($tgl_a,'Y');
            ?>
            <tr>
              <th colspan="16" class="tengah">Minggu ke - <?php echo isset($get_omzet[0]['minggu'])?$get_omzet[0]['minggu']:'';?> (<?php echo isset($get_omzet[0]['bulan'])?$get_omzet[0]['bulan']:'';?> - <?php echo $tahun;?>)</th>
            </tr>
            <tr>
              <td class="tengah"><font size="1">Gaji Sales</font></td>
              <td class="tengah"><font size="1">#</font></td>
              <?php if(!empty($get_gaji) && !empty($get_persen) && !empty($get_jml_lap)){
                $jum=0;
                $no=1;
                $total=0;
                $tl1 = 0;
                $tl2 = 0;
                $tl3 = 0;
                $tl4 = 0;
                $tl5 = 0;
                $tl6 = 0;
                $tl7 = 0;
                $tl8 = 0;
                $tl9 = 0;
                $tl10 = 0;
                $tl11 = 0;
                foreach ($get_gaji as $data){
                  foreach ($get_persen as $data_persen){
                    foreach ($get_jml_lap as $data_jml){
                      $id = $data_persen['id_set_penggajian'];
                      $gs = $data_persen['gaji_sales']; 
                      $tl1 = $data_persen['gaji_team_leader_1'];
                      $tl2 = $data_persen['gaji_team_leader_2']; 
                      $gl = $data_persen['gaji_grouf_leader'];

                      $tgl1 = date_create($data['tanggal_awal']);
                      $tgl2 = date_create($data['tanggal_akhir']);
                      $tanggal_awal = date_format($tgl1, 'd-m-Y');
                      $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                      $bln = $data['bulan'];
                      $mg = $data['minggu'];
                      $tgl = date_create($data['tanggal']);
                      $tanggal = date_format($tgl, "d-m-Y");
                      $hari = $data['hari'];

                      $jml_lapangan = $data_jml['jumlah'];

                      if($jml_lapangan == 1){
                        $lap1 = $data['omzet_lap_1']*$gs/100;
                        $lap2 = 0;
                        $lap3 = 0;
                        $lap4 = 0;
                        $lap5 = 0;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;
                      }elseif($jml_lapangan == 2){
                        $lap1 = $data['omzet_lap_1']*$gs/100;
                        $lap2 = $data['omzet_lap_2']*$gs/100;
                        $lap3 = 0;
                        $lap4 = 0;
                        $lap5 = 0;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0; 
                      }elseif($jml_lapangan == 3){
                        $lap1 = $data['omzet_lap_1']*$gs/100;
                        $lap2 = $data['omzet_lap_2']*$gs/100;
                        $lap3 = $data['omzet_lap_3']*$gs/100;
                        $lap4 = 0;
                        $lap5 = 0;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;    
                      }elseif($jml_lapangan == 4){
                        $lap1 = $data['omzet_lap_1']*$gs/100;
                        $lap2 = $data['omzet_lap_2']*$gs/100;
                        $lap3 = $data['omzet_lap_3']*$gs/100;
                        $lap4 = $data['omzet_lap_4']*$gs/100;
                        $lap5 = 0;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;  
                      }elseif($jml_lapangan == 5){
                        $lap1 = $data['omzet_lap_1']*$gs/100;
                        $lap2 = $data['omzet_lap_2']*$gs/100;
                        $lap3 = $data['omzet_lap_3']*$gs/100;
                        $lap4 = $data['omzet_lap_4']*$gs/100;
                        $lap5 = $data['omzet_lap_5']*$gs/100;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;  
                      }elseif($jml_lapangan == 6){
                        $lap1 = $data['omzet_lap_1']*$gs/100;
                        $lap2 = $data['omzet_lap_2']*$gs/100;
                        $lap3 = $data['omzet_lap_3']*$gs/100;
                        $lap4 = $data['omzet_lap_4']*$gs/100;
                        $lap5 = $data['omzet_lap_5']*$gs/100;
                        $lap6 = $data['omzet_lap_6']*$gs/100;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;  
                      }elseif($jml_lapangan == 7){
                        $lap1 = $data['omzet_lap_1']*$gs/100;
                        $lap2 = $data['omzet_lap_2']*$gs/100;
                        $lap3 = $data['omzet_lap_3']*$gs/100;
                        $lap4 = $data['omzet_lap_4']*$gs/100;
                        $lap5 = $data['omzet_lap_5']*$gs/100;
                        $lap6 = $data['omzet_lap_6']*$gs/100;
                        $lap7 = $data['omzet_lap_7']*$gs/100;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;  
                      }elseif($jml_lapangan == 8){
                        $lap1 = $data['omzet_lap_1']*$gs/100;
                        $lap2 = $data['omzet_lap_2']*$gs/100;
                        $lap3 = $data['omzet_lap_3']*$gs/100;
                        $lap4 = $data['omzet_lap_4']*$gs/100;
                        $lap5 = $data['omzet_lap_5']*$gs/100;
                        $lap6 = $data['omzet_lap_6']*$gs/100;
                        $lap7 = $data['omzet_lap_7']*$gs/100;
                        $lap8 = $data['omzet_lap_8']*$gs/100;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;
                      }elseif($jml_lapangan == 9){
                        $lap1 = $data['omzet_lap_1']*$gs/100;
                        $lap2 = $data['omzet_lap_2']*$gs/100;
                        $lap3 = $data['omzet_lap_3']*$gs/100;
                        $lap4 = $data['omzet_lap_4']*$gs/100;
                        $lap5 = $data['omzet_lap_5']*$gs/100;
                        $lap6 = $data['omzet_lap_6']*$gs/100;
                        $lap7 = $data['omzet_lap_7']*$gs/100;
                        $lap8 = $data['omzet_lap_8']*$gs/100;
                        $lap9 = $data['omzet_lap_9']*$gs/100;
                        $lap10 = 0;
                        $lap11 = 0;
                      }elseif($jml_lapangan == 10){
                        $lap1 = $data['omzet_lap_1']*$gs/100;
                        $lap2 = $data['omzet_lap_2']*$gs/100;
                        $lap3 = $data['omzet_lap_3']*$gs/100;
                        $lap4 = $data['omzet_lap_4']*$gs/100;
                        $lap5 = $data['omzet_lap_5']*$gs/100;
                        $lap6 = $data['omzet_lap_6']*$gs/100;
                        $lap7 = $data['omzet_lap_7']*$gs/100;
                        $lap8 = $data['omzet_lap_8']*$gs/100;
                        $lap9 = $data['omzet_lap_9']*$gs/100;
                        $lap10 = $data['omzet_lap_10']*$gs/100;
                        $lap11 = 0;
                      }else{
                        $lap1 = $data['omzet_lap_1']*$gs/100;
                        $lap2 = $data['omzet_lap_2']*$gs/100;
                        $lap3 = $data['omzet_lap_3']*$gs/100;
                        $lap4 = $data['omzet_lap_4']*$gs/100;
                        $lap5 = $data['omzet_lap_5']*$gs/100;
                        $lap6 = $data['omzet_lap_6']*$gs/100;
                        $lap7 = $data['omzet_lap_7']*$gs/100;
                        $lap8 = $data['omzet_lap_8']*$gs/100;
                        $lap9 = $data['omzet_lap_9']*$gs/100;
                        $lap10 = $data['omzet_lap_10']*$gs/100;
                        $lap11 = $data['omzet_lap_11']*$gs/100;
                      }

                      $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11;
                      $jml = "Rp " . number_format($jum,0,',','.');
                      $total += $jum;
                      $tl1 += $lap1;
                      $tl2 += $lap2;
                      $tl3 += $lap3;
                      $tl4 += $lap4;
                      $tl5 += $lap5;
                      $tl6 += $lap6;
                      $tl7 += $lap7;
                      $tl8 += $lap8;
                      $tl9 += $lap9;
                      $tl10 += $lap10;
                      $tl11 += $lap11;
                      if($get_id==1){
                        $bln='ALL';
                        $mg='ALL';
                      }
                      ?>
                      <input type="hidden" id="s_1" value="<?php echo $lap1; ?>">
                      <input type="hidden" id="s_2" value="<?php echo $lap2; ?>">
                      <input type="hidden" id="s_3" value="<?php echo $lap3; ?>">
                      <input type="hidden" id="s_4" value="<?php echo $lap4; ?>">
                      <input type="hidden" id="s_5" value="<?php echo $lap5; ?>">
                      <input type="hidden" id="s_6" value="<?php echo $lap6; ?>">
                      <input type="hidden" id="s_7" value="<?php echo $lap7; ?>">
                      <input type="hidden" id="s_8" value="<?php echo $lap8; ?>">
                      <input type="hidden" id="s_9" value="<?php echo $lap9; ?>">
                      <input type="hidden" id="s_10" value="<?php echo $lap10; ?>">
                      <input type="hidden" id="s_11" value="<?php echo $lap11; ?>">
                      <input type="hidden" id="omzet_1" value="<?php echo $data['omzet_lap_1']; ?>">
                      <input type="hidden" id="omzet_2" value="<?php echo $data['omzet_lap_2']; ?>">
                      <input type="hidden" id="omzet_3" value="<?php echo $data['omzet_lap_3']; ?>">
                      <input type="hidden" id="omzet_4" value="<?php echo $data['omzet_lap_4']; ?>">
                      <input type="hidden" id="omzet_5" value="<?php echo $data['omzet_lap_5']; ?>">
                      <input type="hidden" id="omzet_6" value="<?php echo $data['omzet_lap_6']; ?>">
                      <input type="hidden" id="omzet_7" value="<?php echo $data['omzet_lap_7']; ?>">
                      <input type="hidden" id="omzet_8" value="<?php echo $data['omzet_lap_8']; ?>">
                      <input type="hidden" id="omzet_9" value="<?php echo $data['omzet_lap_9']; ?>">
                      <input type="hidden" id="omzet_10" value="<?php echo $data['omzet_lap_10']; ?>">
                      <input type="hidden" id="omzet_11" value="<?php echo $data['omzet_lap_11']; ?>">
                      <input type="hidden" id="jum1" value="<?php echo $jum; ?>">

                      <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap1 = "Rp " . number_format($lap1,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap2 = "Rp " . number_format($lap2,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap3 = "Rp " . number_format($lap3,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap4 = "Rp " . number_format($lap4,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap5 = "Rp " . number_format($lap5,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap6 = "Rp " . number_format($lap6,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap7 = "Rp " . number_format($lap7,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap8 = "Rp " . number_format($lap8,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap9 = "Rp " . number_format($lap9,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap10 = "Rp " . number_format($lap10,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap11 = "Rp " . number_format($lap11,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $jml; ?></font></td>

                      <?php 
                    }
                  }
                } 
              }
              ?>
            </tr>
            <tr>
              <td class="tengah"><font size="1">Gaji Team Leader 1</font></td>
              <?php if(!empty($get_tl1)){
                foreach ($get_tl1 as $data) {
                  ?>
                  <td class="tengah"><font size="1"><?php echo $data['namauser'] ?></font></td>
                  <?php
                }
              }else{
                ?>
                <th rowspan="1" class="tengah"><font size="1">#</font></th>
                <?php
              } 
              ?>
              <?php if(!empty($get_gaji) && !empty($get_persen) && !empty($get_jml_lap)){
                $jum=0;
                $no=1;
                $total=0;
                $tl1 = 0;
                $tl2 = 0;
                $tl3 = 0;
                $tl4 = 0;
                $tl5 = 0;
                $tl6 = 0;
                $tl7 = 0;
                $tl8 = 0;
                $tl9 = 0;
                $tl10 = 0;
                $tl11 = 0;
                foreach ($get_gaji as $data){
                  foreach ($get_persen as $data_persen){
                    foreach ($get_jml_lap as $data_jml){
                      $id = $data_persen['id_set_penggajian'];
                      $gs = $data_persen['gaji_sales']; 
                      $tl1 = $data_persen['gaji_team_leader_1'];
                      $tl2 = $data_persen['gaji_team_leader_2']; 
                      $gl = $data_persen['gaji_grouf_leader'];

                      $tgl1 = date_create($data['tanggal_awal']);
                      $tgl2 = date_create($data['tanggal_akhir']);
                      $tanggal_awal = date_format($tgl1, 'd-m-Y');
                      $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                      $bln = $data['bulan'];
                      $mg = $data['minggu'];
                      $tgl = date_create($data['tanggal']);
                      $tanggal = date_format($tgl, "d-m-Y");
                      $hari = $data['hari'];

                      $jml_lapangan = $data_jml['jumlah'];

                      if($jml_lapangan == 1){
                        $lap1 = $data['omzet_lap_1']*$tl1/100;
                        $lap2 = 0;
                        $lap3 = 0;
                        $lap4 = 0;
                        $lap5 = 0;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;

                      }elseif($jml_lapangan == 2){
                        $lap1 = $data['omzet_lap_1']*$tl1/100;
                        $lap2 = $data['omzet_lap_2']*$tl1/100;
                        $lap3 = 0;
                        $lap4 = 0;
                        $lap5 = 0;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0; 

                      }elseif($jml_lapangan == 3){
                        $lap1 = $data['omzet_lap_1']*$tl1/100;
                        $lap2 = $data['omzet_lap_2']*$tl1/100;
                        $lap3 = $data['omzet_lap_3']*$tl1/100;
                        $lap4 = 0;
                        $lap5 = 0;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;    

                      }elseif($jml_lapangan == 4){
                        $lap1 = $data['omzet_lap_1']*$tl1/100;
                        $lap2 = $data['omzet_lap_2']*$tl1/100;
                        $lap3 = $data['omzet_lap_3']*$tl1/100;
                        $lap4 = $data['omzet_lap_4']*$tl1/100;
                        $lap5 = 0;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;  

                      }elseif($jml_lapangan == 5){
                        $lap1 = $data['omzet_lap_1']*$tl1/100;
                        $lap2 = $data['omzet_lap_2']*$tl1/100;
                        $lap3 = $data['omzet_lap_3']*$tl1/100;
                        $lap4 = $data['omzet_lap_4']*$tl1/100;
                        $lap5 = $data['omzet_lap_5']*$tl1/100;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;  

                      }elseif($jml_lapangan == 6){
                        $lap1 = $data['omzet_lap_1']*$tl1/100;
                        $lap2 = $data['omzet_lap_2']*$tl1/100;
                        $lap3 = $data['omzet_lap_3']*$tl1/100;
                        $lap4 = $data['omzet_lap_4']*$tl1/100;
                        $lap5 = $data['omzet_lap_5']*$tl1/100;
                        $lap6 = $data['omzet_lap_6']*$tl1/100;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;  

                      }elseif($jml_lapangan == 7){
                        $lap1 = $data['omzet_lap_1']*$tl1/100;
                        $lap2 = $data['omzet_lap_2']*$tl1/100;
                        $lap3 = $data['omzet_lap_3']*$tl1/100;
                        $lap4 = $data['omzet_lap_4']*$tl1/100;
                        $lap5 = $data['omzet_lap_5']*$tl1/100;
                        $lap6 = $data['omzet_lap_6']*$tl1/100;
                        $lap7 = $data['omzet_lap_7']*$tl1/100;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;  

                      }elseif($jml_lapangan == 8){
                        $lap1 = $data['omzet_lap_1']*$tl1/100;
                        $lap2 = $data['omzet_lap_2']*$tl1/100;
                        $lap3 = $data['omzet_lap_3']*$tl1/100;
                        $lap4 = $data['omzet_lap_4']*$tl1/100;
                        $lap5 = $data['omzet_lap_5']*$tl1/100;
                        $lap6 = $data['omzet_lap_6']*$tl1/100;
                        $lap7 = $data['omzet_lap_7']*$tl1/100;
                        $lap8 = $data['omzet_lap_8']*$tl1/100;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;

                      }elseif($jml_lapangan == 9){
                        $lap1 = $data['omzet_lap_1']*$tl1/100;
                        $lap2 = $data['omzet_lap_2']*$tl1/100;
                        $lap3 = $data['omzet_lap_3']*$tl1/100;
                        $lap4 = $data['omzet_lap_4']*$tl1/100;
                        $lap5 = $data['omzet_lap_5']*$tl1/100;
                        $lap6 = $data['omzet_lap_6']*$tl1/100;
                        $lap7 = $data['omzet_lap_7']*$tl1/100;
                        $lap8 = $data['omzet_lap_8']*$tl1/100;
                        $lap9 = $data['omzet_lap_9']*$tl1/100;
                        $lap10 = 0;
                        $lap11 = 0;

                      }elseif($jml_lapangan == 10){
                        $lap1 = $data['omzet_lap_1']*$tl1/100;
                        $lap2 = $data['omzet_lap_2']*$tl1/100;
                        $lap3 = $data['omzet_lap_3']*$tl1/100;
                        $lap4 = $data['omzet_lap_4']*$tl1/100;
                        $lap5 = $data['omzet_lap_5']*$tl1/100;
                        $lap6 = $data['omzet_lap_6']*$tl1/100;
                        $lap7 = $data['omzet_lap_7']*$tl1/100;
                        $lap8 = $data['omzet_lap_8']*$tl1/100;
                        $lap9 = $data['omzet_lap_9']*$tl1/100;
                        $lap10 = $data['omzet_lap_10']*$tl1/100;
                        $lap11 = 0;

                      }else{
                        $lap1 = $data['omzet_lap_1']*$tl1/100;
                        $lap2 = $data['omzet_lap_2']*$tl1/100;
                        $lap3 = $data['omzet_lap_3']*$tl1/100;
                        $lap4 = $data['omzet_lap_4']*$tl1/100;
                        $lap5 = $data['omzet_lap_5']*$tl1/100;
                        $lap6 = $data['omzet_lap_6']*$tl1/100;
                        $lap7 = $data['omzet_lap_7']*$tl1/100;
                        $lap8 = $data['omzet_lap_8']*$tl1/100;
                        $lap9 = $data['omzet_lap_9']*$tl1/100;
                        $lap10 = $data['omzet_lap_10']*$tl1/100;
                        $lap11 = $data['omzet_lap_11']*$tl1/100;
                      }

                      $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11;
                      $jml = "Rp " . number_format($jum,0,',','.');
                      $total += $jum;
                      $tl1 += $lap1;
                      $tl2 += $lap2;
                      $tl3 += $lap3;
                      $tl4 += $lap4;
                      $tl5 += $lap5;
                      $tl6 += $lap6;
                      $tl7 += $lap7;
                      $tl8 += $lap8;
                      $tl9 += $lap9;
                      $tl10 += $lap10;
                      $tl11 += $lap11;
                      if($get_id==1){
                        $bln='ALL';
                        $mg='ALL';
                      }
                      ?>
                      <input type="hidden" id="tm_1_1" value="<?php echo $lap1; ?>">
                      <input type="hidden" id="tm_1_2" value="<?php echo $lap2; ?>">
                      <input type="hidden" id="tm_1_3" value="<?php echo $lap3; ?>">
                      <input type="hidden" id="tm_1_4" value="<?php echo $lap4; ?>">
                      <input type="hidden" id="tm_1_5" value="<?php echo $lap5; ?>">
                      <input type="hidden" id="tm_1_6" value="<?php echo $lap6; ?>">
                      <input type="hidden" id="tm_1_7" value="<?php echo $lap7; ?>">
                      <input type="hidden" id="tm_1_8" value="<?php echo $lap8; ?>">
                      <input type="hidden" id="tm_1_9" value="<?php echo $lap9; ?>">
                      <input type="hidden" id="tm_1_10" value="<?php echo $lap10; ?>">
                      <input type="hidden" id="tm_1_11" value="<?php echo $lap11; ?>">
                      <input type="hidden" id="jum2" value="<?php echo $jum; ?>">
                      <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap1 = "Rp " . number_format($lap1,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap2 = "Rp " . number_format($lap2,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap3 = "Rp " . number_format($lap3,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap4 = "Rp " . number_format($lap4,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap5 = "Rp " . number_format($lap5,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap6 = "Rp " . number_format($lap6,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap7 = "Rp " . number_format($lap7,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap8 = "Rp " . number_format($lap8,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap9 = "Rp " . number_format($lap9,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap10 = "Rp " . number_format($lap10,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap11 = "Rp " . number_format($lap11,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $jml; ?></font></td>
                      <?php 
                    }
                  }
                }
              } 
              ?>
            </tr>
            <tr>
              <td class="tengah"><font size="1">Gaji Team Leader 2</font></td>
              <?php if(!empty($get_tl2)){
                foreach ($get_tl2 as $data) {
                  ?>
                  <td class="tengah"><font size="1"><?php echo $data['namauser'] ?></font></td>
                  <?php
                }
              }else{
                ?>
                <th rowspan="1" class="tengah"><font size="1">#</font></th>
                <?php
              } 
              ?>
              <?php if(!empty($get_gaji) && !empty($get_persen) && !empty($get_jml_lap)){
                $jum=0;
                $no=1;
                $total=0;
                $tl1 = 0;
                $tl2 = 0;
                $tl3 = 0;
                $tl4 = 0;
                $tl5 = 0;
                $tl6 = 0;
                $tl7 = 0;
                $tl8 = 0;
                $tl9 = 0;
                $tl10 = 0;
                $tl11 = 0;
                foreach ($get_gaji as $data){
                  foreach ($get_persen as $data_persen){
                    foreach ($get_jml_lap as $data_jml){
                      $id = $data_persen['id_set_penggajian'];
                      $gs = $data_persen['gaji_sales']; 
                      $tl1 = $data_persen['gaji_team_leader_1'];
                      $tl2 = $data_persen['gaji_team_leader_2']; 
                      $gl = $data_persen['gaji_grouf_leader'];

                      $tgl1 = date_create($data['tanggal_awal']);
                      $tgl2 = date_create($data['tanggal_akhir']);
                      $tanggal_awal = date_format($tgl1, 'd-m-Y');
                      $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                      $bln = $data['bulan'];
                      $mg = $data['minggu'];
                      $tgl = date_create($data['tanggal']);
                      $tanggal = date_format($tgl, "d-m-Y");
                      $hari = $data['hari'];

                      $jml_lapangan = $data_jml['jumlah'];

                      if($jml_lapangan == 1){
                        $lap1 = $data['omzet_lap_1']*$tl2/100;
                        $lap2 = 0;
                        $lap3 = 0;
                        $lap4 = 0;
                        $lap5 = 0;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;

                      }elseif($jml_lapangan == 2){
                        $lap1 = $data['omzet_lap_1']*$tl2/100;
                        $lap2 = $data['omzet_lap_2']*$tl2/100;
                        $lap3 = 0;
                        $lap4 = 0;
                        $lap5 = 0;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0; 
                      }elseif($jml_lapangan == 3){
                        $lap1 = $data['omzet_lap_1']*$tl2/100;
                        $lap2 = $data['omzet_lap_2']*$tl2/100;
                        $lap3 = $data['omzet_lap_3']*$tl2/100;
                        $lap4 = 0;
                        $lap5 = 0;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;    

                      }elseif($jml_lapangan == 4){
                        $lap1 = $data['omzet_lap_1']*$tl2/100;
                        $lap2 = $data['omzet_lap_2']*$tl2/100;
                        $lap3 = $data['omzet_lap_3']*$tl2/100;
                        $lap4 = $data['omzet_lap_4']*$tl2/100;
                        $lap5 = 0;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;  

                      }elseif($jml_lapangan == 5){
                        $lap1 = $data['omzet_lap_1']*$tl2/100;
                        $lap2 = $data['omzet_lap_2']*$tl2/100;
                        $lap3 = $data['omzet_lap_3']*$tl2/100;
                        $lap4 = $data['omzet_lap_4']*$tl2/100;
                        $lap5 = $data['omzet_lap_5']*$tl2/100;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;  

                      }elseif($jml_lapangan == 6){
                        $lap1 = $data['omzet_lap_1']*$tl2/100;
                        $lap2 = $data['omzet_lap_2']*$tl2/100;
                        $lap3 = $data['omzet_lap_3']*$tl2/100;
                        $lap4 = $data['omzet_lap_4']*$tl2/100;
                        $lap5 = $data['omzet_lap_5']*$tl2/100;
                        $lap6 = $data['omzet_lap_6']*$tl2/100;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;  

                      }elseif($jml_lapangan == 7){
                        $lap1 = $data['omzet_lap_1']*$tl2/100;
                        $lap2 = $data['omzet_lap_2']*$tl2/100;
                        $lap3 = $data['omzet_lap_3']*$tl2/100;
                        $lap4 = $data['omzet_lap_4']*$tl2/100;
                        $lap5 = $data['omzet_lap_5']*$tl2/100;
                        $lap6 = $data['omzet_lap_6']*$tl2/100;
                        $lap7 = $data['omzet_lap_7']*$tl2/100;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;  

                      }elseif($jml_lapangan == 8){
                        $lap1 = $data['omzet_lap_1']*$tl2/100;
                        $lap2 = $data['omzet_lap_2']*$tl2/100;
                        $lap3 = $data['omzet_lap_3']*$tl2/100;
                        $lap4 = $data['omzet_lap_4']*$tl2/100;
                        $lap5 = $data['omzet_lap_5']*$tl2/100;
                        $lap6 = $data['omzet_lap_6']*$tl2/100;
                        $lap7 = $data['omzet_lap_7']*$tl2/100;
                        $lap8 = $data['omzet_lap_8']*$tl2/100;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;

                      }elseif($jml_lapangan == 9){
                        $lap1 = $data['omzet_lap_1']*$tl2/100;
                        $lap2 = $data['omzet_lap_2']*$tl2/100;
                        $lap3 = $data['omzet_lap_3']*$tl2/100;
                        $lap4 = $data['omzet_lap_4']*$tl2/100;
                        $lap5 = $data['omzet_lap_5']*$tl2/100;
                        $lap6 = $data['omzet_lap_6']*$tl2/100;
                        $lap7 = $data['omzet_lap_7']*$tl2/100;
                        $lap8 = $data['omzet_lap_8']*$tl2/100;
                        $lap9 = $data['omzet_lap_9']*$tl2/100;
                        $lap10 = 0;
                        $lap11 = 0;

                      }elseif($jml_lapangan == 10){
                        $lap1 = $data['omzet_lap_1']*$tl2/100;
                        $lap2 = $data['omzet_lap_2']*$tl2/100;
                        $lap3 = $data['omzet_lap_3']*$tl2/100;
                        $lap4 = $data['omzet_lap_4']*$tl2/100;
                        $lap5 = $data['omzet_lap_5']*$tl2/100;
                        $lap6 = $data['omzet_lap_6']*$tl2/100;
                        $lap7 = $data['omzet_lap_7']*$tl2/100;
                        $lap8 = $data['omzet_lap_8']*$tl2/100;
                        $lap9 = $data['omzet_lap_9']*$tl2/100;
                        $lap10 = $data['omzet_lap_10']*$tl2/100;
                        $lap11 = 0;

                      }else{
                        $lap1 = $data['omzet_lap_1']*$tl2/100;
                        $lap2 = $data['omzet_lap_2']*$tl2/100;
                        $lap3 = $data['omzet_lap_3']*$tl2/100;
                        $lap4 = $data['omzet_lap_4']*$tl2/100;
                        $lap5 = $data['omzet_lap_5']*$tl2/100;
                        $lap6 = $data['omzet_lap_6']*$tl2/100;
                        $lap7 = $data['omzet_lap_7']*$tl2/100;
                        $lap8 = $data['omzet_lap_8']*$tl2/100;
                        $lap9 = $data['omzet_lap_9']*$tl2/100;
                        $lap10 = $data['omzet_lap_10']*$tl2/100;
                        $lap11 = $data['omzet_lap_11']*$tl2/100;
                      }

                      $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11;
                      $jml = "Rp " . number_format($jum,0,',','.');
                      $total += $jum;
                      $tl1 += $lap1;
                      $tl2 += $lap2;
                      $tl3 += $lap3;
                      $tl4 += $lap4;
                      $tl5 += $lap5;
                      $tl6 += $lap6;
                      $tl7 += $lap7;
                      $tl8 += $lap8;
                      $tl9 += $lap9;
                      $tl10 += $lap10;
                      $tl11 += $lap11;

                      if($get_id==1){
                        $bln='ALL';
                        $mg='ALL';
                      }
                      ?>
                      <input type="hidden" id="tm_2_1" value="<?php echo $lap1; ?>">
                      <input type="hidden" id="tm_2_2" value="<?php echo $lap2; ?>">
                      <input type="hidden" id="tm_2_3" value="<?php echo $lap3; ?>">
                      <input type="hidden" id="tm_2_4" value="<?php echo $lap4; ?>">
                      <input type="hidden" id="tm_2_5" value="<?php echo $lap5; ?>">
                      <input type="hidden" id="tm_2_6" value="<?php echo $lap6; ?>">
                      <input type="hidden" id="tm_2_7" value="<?php echo $lap7; ?>">
                      <input type="hidden" id="tm_2_8" value="<?php echo $lap8; ?>">
                      <input type="hidden" id="tm_2_9" value="<?php echo $lap9; ?>">
                      <input type="hidden" id="tm_2_10" value="<?php echo $lap10; ?>">
                      <input type="hidden" id="tm_2_11" value="<?php echo $lap11; ?>">
                      <input type="hidden" id="jum3" value="<?php echo $jum; ?>">
                      <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap1 = "Rp " . number_format($lap1,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap2 = "Rp " . number_format($lap2,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap3 = "Rp " . number_format($lap3,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap4 = "Rp " . number_format($lap4,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap5 = "Rp " . number_format($lap5,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap6 = "Rp " . number_format($lap6,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap7 = "Rp " . number_format($lap7,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap8 = "Rp " . number_format($lap8,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap9 = "Rp " . number_format($lap9,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap10 = "Rp " . number_format($lap10,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap11 = "Rp " . number_format($lap11,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $jml; ?></font></td>

                      <?php 
                    }
                  }
                }
              } 
              ?>
            </tr>
            <tr>
              <td class="tengah"><font size="1">Gaji Grouf Leader</font></td>
              <?php if(!empty($get_gl)){
                foreach ($get_gl as $data) {
                  ?>
                  <td class="tengah"><font size="1"><?php echo $data['namauser'] ?></font></td>
                  <?php
                }
              }else{
                ?>
                <th rowspan="1" class="tengah"><font size="1">#</font></th>
                <?php
              } 
              ?>
              <?php if(!empty($get_gaji) && !empty($get_persen) && !empty($get_jml_lap)){
                             //load data user
                $jum=0;
                $no=1;
                $total=0;
                $tl1 = 0;
                $tl2 = 0;
                $tl3 = 0;
                $tl4 = 0;
                $tl5 = 0;
                $tl6 = 0;
                $tl7 = 0;
                $tl8 = 0;
                $tl9 = 0;
                $tl10 = 0;
                $tl11 = 0;

                foreach ($get_gaji as $data){
                  foreach ($get_persen as $data_persen){
                    foreach ($get_jml_lap as $data_jml){

                      $id = $data_persen['id_set_penggajian'];
                      $gs = $data_persen['gaji_sales']; 
                      $tl1 = $data_persen['gaji_team_leader_1'];
                      $tl2 = $data_persen['gaji_team_leader_2']; 
                      $gl = $data_persen['gaji_grouf_leader'];

                      $tgl1 = date_create($data['tanggal_awal']);
                      $tgl2 = date_create($data['tanggal_akhir']);
                      $tanggal_awal = date_format($tgl1, 'd-m-Y');
                      $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                      $bln = $data['bulan'];
                      $mg = $data['minggu'];
                      $tgl = date_create($data['tanggal']);
                      $tanggal = date_format($tgl, "d-m-Y");
                      $hari = $data['hari'];

                      $jml_lapangan = $data_jml['jumlah'];

                      if($jml_lapangan == 1){
                        $lap1 = $data['omzet_lap_1']*$gl/100;
                        $lap2 = 0;
                        $lap3 = 0;
                        $lap4 = 0;
                        $lap5 = 0;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;

                      }elseif($jml_lapangan == 2){
                        $lap1 = $data['omzet_lap_1']*$gl/100;
                        $lap2 = $data['omzet_lap_2']*$gl/100;
                        $lap3 = 0;
                        $lap4 = 0;
                        $lap5 = 0;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0; 
                      }elseif($jml_lapangan == 3){
                        $lap1 = $data['omzet_lap_1']*$gl/100;
                        $lap2 = $data['omzet_lap_2']*$gl/100;
                        $lap3 = $data['omzet_lap_3']*$gl/100;
                        $lap4 = 0;
                        $lap5 = 0;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;    

                      }elseif($jml_lapangan == 4){
                        $lap1 = $data['omzet_lap_1']*$gl/100;
                        $lap2 = $data['omzet_lap_2']*$gl/100;
                        $lap3 = $data['omzet_lap_3']*$gl/100;
                        $lap4 = $data['omzet_lap_4']*$gl/100;
                        $lap5 = 0;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;  

                      }elseif($jml_lapangan == 5){
                        $lap1 = $data['omzet_lap_1']*$gl/100;
                        $lap2 = $data['omzet_lap_2']*$gl/100;
                        $lap3 = $data['omzet_lap_3']*$gl/100;
                        $lap4 = $data['omzet_lap_4']*$gl/100;
                        $lap5 = $data['omzet_lap_5']*$gl/100;
                        $lap6 = 0;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;  

                      }elseif($jml_lapangan == 6){
                        $lap1 = $data['omzet_lap_1']*$gl/100;
                        $lap2 = $data['omzet_lap_2']*$gl/100;
                        $lap3 = $data['omzet_lap_3']*$gl/100;
                        $lap4 = $data['omzet_lap_4']*$gl/100;
                        $lap5 = $data['omzet_lap_5']*$gl/100;
                        $lap6 = $data['omzet_lap_6']*$gl/100;
                        $lap7 = 0;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;  

                      }elseif($jml_lapangan == 7){
                        $lap1 = $data['omzet_lap_1']*$gl/100;
                        $lap2 = $data['omzet_lap_2']*$gl/100;
                        $lap3 = $data['omzet_lap_3']*$gl/100;
                        $lap4 = $data['omzet_lap_4']*$gl/100;
                        $lap5 = $data['omzet_lap_5']*$gl/100;
                        $lap6 = $data['omzet_lap_6']*$gl/100;
                        $lap7 = $data['omzet_lap_7']*$gl/100;
                        $lap8 = 0;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;  

                      }elseif($jml_lapangan == 8){
                        $lap1 = $data['omzet_lap_1']*$gl/100;
                        $lap2 = $data['omzet_lap_2']*$gl/100;
                        $lap3 = $data['omzet_lap_3']*$gl/100;
                        $lap4 = $data['omzet_lap_4']*$gl/100;
                        $lap5 = $data['omzet_lap_5']*$gl/100;
                        $lap6 = $data['omzet_lap_6']*$gl/100;
                        $lap7 = $data['omzet_lap_7']*$gl/100;
                        $lap8 = $data['omzet_lap_8']*$gl/100;
                        $lap9 = 0;
                        $lap10 = 0;
                        $lap11 = 0;

                      }elseif($jml_lapangan == 9){
                        $lap1 = $data['omzet_lap_1']*$gl/100;
                        $lap2 = $data['omzet_lap_2']*$gl/100;
                        $lap3 = $data['omzet_lap_3']*$gl/100;
                        $lap4 = $data['omzet_lap_4']*$gl/100;
                        $lap5 = $data['omzet_lap_5']*$gl/100;
                        $lap6 = $data['omzet_lap_6']*$gl/100;
                        $lap7 = $data['omzet_lap_7']*$gl/100;
                        $lap8 = $data['omzet_lap_8']*$gl/100;
                        $lap9 = $data['omzet_lap_9']*$gl/100;
                        $lap10 = 0;
                        $lap11 = 0;

                      }elseif($jml_lapangan == 10){
                        $lap1 = $data['omzet_lap_1']*$gl/100;
                        $lap2 = $data['omzet_lap_2']*$gl/100;
                        $lap3 = $data['omzet_lap_3']*$gl/100;
                        $lap4 = $data['omzet_lap_4']*$gl/100;
                        $lap5 = $data['omzet_lap_5']*$gl/100;
                        $lap6 = $data['omzet_lap_6']*$gl/100;
                        $lap7 = $data['omzet_lap_7']*$gl/100;
                        $lap8 = $data['omzet_lap_8']*$gl/100;
                        $lap9 = $data['omzet_lap_9']*$gl/100;
                        $lap10 = $data['omzet_lap_10']*$gl/100;
                        $lap11 = 0;

                      }else{
                        $lap1 = $data['omzet_lap_1']*$gl/100;
                        $lap2 = $data['omzet_lap_2']*$gl/100;
                        $lap3 = $data['omzet_lap_3']*$gl/100;
                        $lap4 = $data['omzet_lap_4']*$gl/100;
                        $lap5 = $data['omzet_lap_5']*$gl/100;
                        $lap6 = $data['omzet_lap_6']*$gl/100;
                        $lap7 = $data['omzet_lap_7']*$gl/100;
                        $lap8 = $data['omzet_lap_8']*$gl/100;
                        $lap9 = $data['omzet_lap_9']*$gl/100;
                        $lap10 = $data['omzet_lap_10']*$gl/100;
                        $lap11 = $data['omzet_lap_11']*$gl/100;
                      }

                      $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11;
                      $jml = "Rp " . number_format($jum,0,',','.');
                      $total += $jum;
                      $tl1 += $lap1;
                      $tl2 += $lap2;
                      $tl3 += $lap3;
                      $tl4 += $lap4;
                      $tl5 += $lap5;
                      $tl6 += $lap6;
                      $tl7 += $lap7;
                      $tl8 += $lap8;
                      $tl9 += $lap9;
                      $tl10 += $lap10;
                      $tl11 += $lap11;

                      ?>
                      <input type="hidden" id="gl_1" value="<?php echo $lap1; ?>">
                      <input type="hidden" id="gl_2" value="<?php echo $lap2; ?>">
                      <input type="hidden" id="gl_3" value="<?php echo $lap3; ?>">
                      <input type="hidden" id="gl_4" value="<?php echo $lap4; ?>">
                      <input type="hidden" id="gl_5" value="<?php echo $lap5; ?>">
                      <input type="hidden" id="gl_6" value="<?php echo $lap6; ?>">
                      <input type="hidden" id="gl_7" value="<?php echo $lap7; ?>">
                      <input type="hidden" id="gl_8" value="<?php echo $lap8; ?>">
                      <input type="hidden" id="gl_9" value="<?php echo $lap9; ?>">
                      <input type="hidden" id="gl_10" value="<?php echo $lap10; ?>">
                      <input type="hidden" id="gl_11" value="<?php echo $lap11; ?>">
                      <input type="hidden" id="jum4" value="<?php echo $jum; ?>">
                      <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap1 = "Rp " . number_format($lap1,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap2 = "Rp " . number_format($lap2,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap3 = "Rp " . number_format($lap3,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap4 = "Rp " . number_format($lap4,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap5 = "Rp " . number_format($lap5,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap6 = "Rp " . number_format($lap6,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap7 = "Rp " . number_format($lap7,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap8 = "Rp " . number_format($lap8,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap9 = "Rp " . number_format($lap9,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap10 = "Rp " . number_format($lap10,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $lap11 = "Rp " . number_format($lap11,0,',','.'); ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $jml; ?></font></td>

                      <?php 
                    }
                  }
                } 
              }
              ?>
            </tr>
            <tr>
              <td class="tengah"><font size="1">Gaji Asis Leader</font></td>
              <?php if(!empty($get_al)){
                foreach ($get_al as $data) {
                  ?>
                  <td class="tengah"><font size="1"><?php echo $data['namauser'] ?></font></td>
                  <?php
                }
              }else{
                ?>
                <td class="tengah"><font size="1">#</font></td>
                <?php 
              } 
              ?>
              <?php if(!empty($get_gaji) && !empty($get_gaji_al) && !empty($get_jml_lap)){
                             //load data user
                $jum=0;
                $no=1;
                $total=0;
                $tl1 = 0;
                $tl2 = 0;
                $tl3 = 0;
                $tl4 = 0;
                $tl5 = 0;
                $tl6 = 0;
                $tl7 = 0;
                $tl8 = 0;
                $tl9 = 0;
                $tl10 = 0;
                $tl11 = 0;

                foreach ($get_gaji as $data){
                  foreach ($get_gaji_al as $data_gaji_al){
                    foreach ($get_jml_lap as $data_jml){
                      $id = $data_gaji_al['id_set_gaji_al'];
                      $status = $data_gaji_al['status'];
                      $jml_lapangan = $data_jml['jumlah'];

                      $tgl1 = date_create($data['tanggal_awal']);
                      $tgl2 = date_create($data['tanggal_akhir']);
                      $tanggal_awal = date_format($tgl1, 'd-m-Y');
                      $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                      if($status == 'Training'){
                        $v=0;
                        $gaji = 1000000;
                                //$hasil = "Rp " . number_format($gaji,0,',','.');
                        if($jml_lapangan == 1){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = 0;
                          $lap3 = 0;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 2){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan; 
                          $lap3 = 0;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0; 
                        }elseif($jml_lapangan == 3){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;    

                        }elseif($jml_lapangan == 4){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = $gaji/$jml_lapangan;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 5){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = $gaji/$jml_lapangan;
                          $lap5 = $gaji/$jml_lapangan;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 6){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = $gaji/$jml_lapangan;
                          $lap5 = $gaji/$jml_lapangan;
                          $lap6 = $gaji/$jml_lapangan;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 7){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = $gaji/$jml_lapangan;
                          $lap5 = $gaji/$jml_lapangan;
                          $lap6 = $gaji/$jml_lapangan;
                          $lap7 = $gaji/$jml_lapangan;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 8){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = $gaji/$jml_lapangan;
                          $lap5 = $gaji/$jml_lapangan;
                          $lap6 = $gaji/$jml_lapangan;
                          $lap7 = $gaji/$jml_lapangan;
                          $lap8 = $gaji/$jml_lapangan;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 9){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = $gaji/$jml_lapangan;
                          $lap5 = $gaji/$jml_lapangan;
                          $lap6 = $gaji/$jml_lapangan;
                          $lap7 = $gaji/$jml_lapangan;
                          $lap8 = $gaji/$jml_lapangan;
                          $lap9 = $gaji/$jml_lapangan;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 10){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = $gaji/$jml_lapangan;
                          $lap5 = $gaji/$jml_lapangan;
                          $lap6 = $gaji/$jml_lapangan;
                          $lap7 = $gaji/$jml_lapangan;
                          $lap8 = $gaji/$jml_lapangan;
                          $lap9 = $gaji/$jml_lapangan;
                          $lap10 = $gaji/$jml_lapangan;
                          $lap11 = 0;

                        }else{
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = $gaji/$jml_lapangan;
                          $lap5 = $gaji/$jml_lapangan;
                          $lap6 = $gaji/$jml_lapangan;
                          $lap7 = $gaji/$jml_lapangan;
                          $lap8 = $gaji/$jml_lapangan;
                          $lap9 = $gaji/$jml_lapangan;
                          $lap10 = $gaji/$jml_lapangan;
                          $lap11 = $gaji/$jml_lapangan;
                        }
                        $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11;
                        $jml = "Rp " . number_format($jum,0,',','.');
                        $total += $jum;
                      }elseif ($status == 'Pasca Training') {
                        $v=0;
                        $gaji = 1250000;
                                //$hasil = "Rp " . number_format($gaji,0,',','.');
                        if($jml_lapangan == 1){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = 0;
                          $lap3 = 0;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 2){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan; 
                          $lap3 = 0;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0; 
                        }elseif($jml_lapangan == 3){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;    

                        }elseif($jml_lapangan == 4){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = $gaji/$jml_lapangan;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 5){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = $gaji/$jml_lapangan;
                          $lap5 = $gaji/$jml_lapangan;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 6){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = $gaji/$jml_lapangan;
                          $lap5 = $gaji/$jml_lapangan;
                          $lap6 = $gaji/$jml_lapangan;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 7){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = $gaji/$jml_lapangan;
                          $lap5 = $gaji/$jml_lapangan;
                          $lap6 = $gaji/$jml_lapangan;
                          $lap7 = $gaji/$jml_lapangan;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 8){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = $gaji/$jml_lapangan;
                          $lap5 = $gaji/$jml_lapangan;
                          $lap6 = $gaji/$jml_lapangan;
                          $lap7 = $gaji/$jml_lapangan;
                          $lap8 = $gaji/$jml_lapangan;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 9){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = $gaji/$jml_lapangan;
                          $lap5 = $gaji/$jml_lapangan;
                          $lap6 = $gaji/$jml_lapangan;
                          $lap7 = $gaji/$jml_lapangan;
                          $lap8 = $gaji/$jml_lapangan;
                          $lap9 = $gaji/$jml_lapangan;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 10){
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = $gaji/$jml_lapangan;
                          $lap5 = $gaji/$jml_lapangan;
                          $lap6 = $gaji/$jml_lapangan;
                          $lap7 = $gaji/$jml_lapangan;
                          $lap8 = $gaji/$jml_lapangan;
                          $lap9 = $gaji/$jml_lapangan;
                          $lap10 = $gaji/$jml_lapangan;
                          $lap11 = 0;

                        }else{
                          $lap1 = $gaji/$jml_lapangan;
                          $lap2 = $gaji/$jml_lapangan;
                          $lap3 = $gaji/$jml_lapangan;
                          $lap4 = $gaji/$jml_lapangan;
                          $lap5 = $gaji/$jml_lapangan;
                          $lap6 = $gaji/$jml_lapangan;
                          $lap7 = $gaji/$jml_lapangan;
                          $lap8 = $gaji/$jml_lapangan;
                          $lap9 = $gaji/$jml_lapangan;
                          $lap10 = $gaji/$jml_lapangan;
                          $lap11 = $gaji/$jml_lapangan;
                        }
                        $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11;
                        $jml = "Rp " . number_format($jum,0,',','.');
                        $total += $jum;
                      }else{
                        $v=1;
                        $gaji = 5/100;
                        if($jml_lapangan == '1'){
                          $lap1 = $data['omzet_lap_1']*$gaji;
                          $lap2 = 0;
                          $lap3 = 0;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  
                        }elseif($jml_lapangan == '2'){
                          $lap1 = $data['omzet_lap_1']*$gaji;
                          $lap2 = $data['omzet_lap_2']*$gaji;  
                          $lap3 = 0;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;
                        }elseif($jml_lapangan == '3'){
                          $lap1 = $data['omzet_lap_1']*$gaji;
                          $lap2 = $data['omzet_lap_2']*$gaji;
                          $lap3 = $data['omzet_lap_3']*$gaji;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;
                        }elseif($jml_lapangan == '4'){
                          $lap1 = $data['omzet_lap_1']*$gaji;
                          $lap2 = $data['omzet_lap_2']*$gaji;
                          $lap3 = $data['omzet_lap_3']*$gaji;
                          $lap4 = $data['omzet_lap_4']*$gaji;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;
                        }elseif($jml_lapangan == '5'){
                          $lap1 = $data['omzet_lap_1']*$gaji;
                          $lap2 = $data['omzet_lap_2']*$gaji;
                          $lap3 = $data['omzet_lap_3']*$gaji;
                          $lap4 = $data['omzet_lap_4']*$gaji;
                          $lap5 = $data['omzet_lap_5']*$gaji;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;
                        }elseif($jml_lapangan == '6'){
                          $lap1 = $data['omzet_lap_1']*$gaji;
                          $lap2 = $data['omzet_lap_2']*$gaji;
                          $lap3 = $data['omzet_lap_3']*$gaji;
                          $lap4 = $data['omzet_lap_4']*$gaji;
                          $lap5 = $data['omzet_lap_5']*$gaji;
                          $lap6 = $data['omzet_lap_6']*$gaji;    
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;                          
                        }elseif($jml_lapangan == '7'){
                          $lap1 = $data['omzet_lap_1']*$gaji;
                          $lap2 = $data['omzet_lap_2']*$gaji;
                          $lap3 = $data['omzet_lap_3']*$gaji;
                          $lap4 = $data['omzet_lap_4']*$gaji;
                          $lap5 = $data['omzet_lap_5']*$gaji;
                          $lap6 = $data['omzet_lap_6']*$gaji;
                          $lap7 = $data['omzet_lap_7']*$gaji;   
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;                               
                        }elseif($jml_lapangan == '8'){
                          $lap1 = $data['omzet_lap_1']*$gaji;
                          $lap2 = $data['omzet_lap_2']*$gaji;
                          $lap3 = $data['omzet_lap_3']*$gaji;
                          $lap4 = $data['omzet_lap_4']*$gaji;
                          $lap5 = $data['omzet_lap_5']*$gaji;
                          $lap6 = $data['omzet_lap_6']*$gaji;
                          $lap7 = $data['omzet_lap_7']*$gaji;
                          $lap8 = $data['omzet_lap_8']*$gaji;  
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;                                
                        }elseif($jml_lapangan == '9'){
                          $lap1 = $data['omzet_lap_1']*$gaji;
                          $lap2 = $data['omzet_lap_2']*$gaji;
                          $lap3 = $data['omzet_lap_3']*$gaji;
                          $lap4 = $data['omzet_lap_4']*$gaji;
                          $lap5 = $data['omzet_lap_5']*$gaji;
                          $lap6 = $data['omzet_lap_6']*$gaji;
                          $lap7 = $data['omzet_lap_7']*$gaji;
                          $lap8 = $data['omzet_lap_8']*$gaji;
                          $lap9 = $data['omzet_lap_9']*$gaji; 
                          $lap10 = 0;
                          $lap11 = 0;                                
                        }elseif($jml_lapangan == '10'){
                          $lap1 = $data['omzet_lap_1']*$gaji;
                          $lap2 = $data['omzet_lap_2']*$gaji;
                          $lap3 = $data['omzet_lap_3']*$gaji;
                          $lap4 = $data['omzet_lap_4']*$gaji;
                          $lap5 = $data['omzet_lap_5']*$gaji;
                          $lap6 = $data['omzet_lap_6']*$gaji;
                          $lap7 = $data['omzet_lap_7']*$gaji;
                          $lap8 = $data['omzet_lap_8']*$gaji;
                          $lap9 = $data['omzet_lap_9']*$gaji;
                          $lap10 = $data['omzet_lap_10']*$gaji;
                          $lap11 = 0;
                        }else{
                          $lap1 = $data['omzet_lap_1']*$gaji;
                          $lap2 = $data['omzet_lap_2']*$gaji;
                          $lap3 = $data['omzet_lap_3']*$gaji;
                          $lap4 = $data['omzet_lap_4']*$gaji;
                          $lap5 = $data['omzet_lap_5']*$gaji;
                          $lap6 = $data['omzet_lap_6']*$gaji;
                          $lap7 = $data['omzet_lap_7']*$gaji;
                          $lap8 = $data['omzet_lap_8']*$gaji;
                          $lap9 = $data['omzet_lap_9']*$gaji;
                          $lap10 = $data['omzet_lap_10']*$gaji;
                          $lap11 = $data['omzet_lap_11']*$gaji;
                        }
                        $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11;
                        $jml = "Rp " . number_format($jum,0,',','.');
                        $total += $jum;
                      }

                      $bln = $data['bulan'];
                      $mg = $data['minggu'];

                      if($mg != $data_gaji_al['minggu']){
                        ?>
                        <input type="hidden" id="al_1" value="0">
                        <input type="hidden" id="al_2" value="0">
                        <input type="hidden" id="al_3" value="0">
                        <input type="hidden" id="al_4" value="0">
                        <input type="hidden" id="al_5" value="0">
                        <input type="hidden" id="al_6" value="0">
                        <input type="hidden" id="al_7" value="0">
                        <input type="hidden" id="al_8" value="0">
                        <input type="hidden" id="al_9" value="0">
                        <input type="hidden" id="al_10" value="0">
                        <input type="hidden" id="al_11" value="0">
                        <input type="hidden" id="jum5" value="0">
                        <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                        <td colspan="12" class="tengah"><font size="2">Gaji Asis Leader Belum Keluar</font></td>
                        <?php
                      }else{
                        if($v == 1){
                          ?>
                          <input type="hidden" id="al_1" value="<?php echo $lap1; ?>">
                          <input type="hidden" id="al_2" value="<?php echo $lap2; ?>">
                          <input type="hidden" id="al_3" value="<?php echo $lap3; ?>">
                          <input type="hidden" id="al_4" value="<?php echo $lap4; ?>">
                          <input type="hidden" id="al_5" value="<?php echo $lap5; ?>">
                          <input type="hidden" id="al_6" value="<?php echo $lap6; ?>">
                          <input type="hidden" id="al_7" value="<?php echo $lap7; ?>">
                          <input type="hidden" id="al_8" value="<?php echo $lap8; ?>">
                          <input type="hidden" id="al_9" value="<?php echo $lap9; ?>">
                          <input type="hidden" id="al_10" value="<?php echo $lap10; ?>">
                          <input type="hidden" id="al_11" value="<?php echo $lap11; ?>">
                          <input type="hidden" id="jum5" value="<?php echo $jum; ?>">
                          <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap1 = "Rp " . number_format($lap1,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap2 = "Rp " . number_format($lap2,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap3 = "Rp " . number_format($lap3,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap4 = "Rp " . number_format($lap4,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap5 = "Rp " . number_format($lap5,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap6 = "Rp " . number_format($lap6,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap7 = "Rp " . number_format($lap7,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap8 = "Rp " . number_format($lap8,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap9 = "Rp " . number_format($lap9,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap10 = "Rp " . number_format($lap10,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap11 = "Rp " . number_format($lap11,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $jml; ?></font></td>
                          <?php 
                        }else{ 
                          ?>
                          <input type="hidden" id="al_1" value="<?php echo $lap1; ?>">
                          <input type="hidden" id="al_2" value="<?php echo $lap2; ?>">
                          <input type="hidden" id="al_3" value="<?php echo $lap3; ?>">
                          <input type="hidden" id="al_4" value="<?php echo $lap4; ?>">
                          <input type="hidden" id="al_5" value="<?php echo $lap5; ?>">
                          <input type="hidden" id="al_6" value="<?php echo $lap6; ?>">
                          <input type="hidden" id="al_7" value="<?php echo $lap7; ?>">
                          <input type="hidden" id="al_8" value="<?php echo $lap8; ?>">
                          <input type="hidden" id="al_9" value="<?php echo $lap9; ?>">
                          <input type="hidden" id="al_10" value="<?php echo $lap10; ?>">
                          <input type="hidden" id="al_11" value="<?php echo $lap11; ?>">
                          <input type="hidden" id="jum5" value="<?php echo $jum; ?>">
                          <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap1 = "Rp " . number_format($lap1,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap2 = "Rp " . number_format($lap2,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap3 = "Rp " . number_format($lap3,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap4 = "Rp " . number_format($lap4,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap5 = "Rp " . number_format($lap5,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap6 = "Rp " . number_format($lap6,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap7 = "Rp " . number_format($lap7,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap8 = "Rp " . number_format($lap8,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap9 = "Rp " . number_format($lap9,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap10 = "Rp " . number_format($lap10,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $lap11 = "Rp " . number_format($lap11,0,',','.'); ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $jml; ?></font></td>
                          <?php
                        }
                      } 
                    }
                  }
                }
              } 
              ?>
            </tr>
            <tr>
              <td class="tengah"><font size="1">Gaji Tukang Masak</font></td>
              <?php if(!empty($get_gls)){
                foreach ($get_gls as $data) {
                  ?>
                  <td class="tengah"><font size="1"><?php echo $data['namauser'] ?></font></td>
                  <?php
                }
              }else{
                ?>
                <td class="tengah"><font size="1">#</font></td>
                <?php
              } 
              ?>
              <?php if(!empty($get_gaji) && !empty($get_jml_lap) && !empty($get_gaji_tm)){
                             //load data user
                $jum=0;
                $no=1;
                $total=0;
                $tl1 = 0;
                $tl2 = 0;
                $tl3 = 0;
                $tl4 = 0;
                $tl5 = 0;
                $tl6 = 0;
                $tl7 = 0;
                $tl8 = 0;
                $tl9 = 0;
                $tl10 = 0;
                $tl11 = 0;

                foreach ($get_gaji as $data){
                  foreach ($get_jml_lap as $data_jml){
                    foreach ($get_gaji_tm as $data_gaji_tm){

                      $tgl1 = date_create($data['tanggal_awal']);
                      $tgl2 = date_create($data['tanggal_akhir']);
                      $tanggal_awal = date_format($tgl1, 'd-m-Y');
                      $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                      $bln = $data['bulan'];
                      $mg = $data['minggu'];

                      $jml_lap = $data_jml['jumlah'];
                              //$gaji_tm = $data_gaji_tm['gaji']*7;
                      $gaji_tm = $data_gaji_tm['gaji'];
                      $pembagian = $gaji_tm / $jml_lap;
                      $hasil = 0;
                      $lap = 0;
                      ?>
                      <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                      <?php
                      for($i=1;$i<=$jml_lap;$i++){
                        $lap = $pembagian;
                        $hasil += $lap;
                        ?>
                        <td class="tengah"><font size="1"><?php echo $lap = "Rp " . number_format($lap,0,',','.'); ?></font></td>
                        <?php  
                      }
                      ?>
                      <?php if($jml_lap==11){?>
                        <input type="hidden" id="tm" value="<?php echo $pembagian; ?>">
                        <input type="hidden" id="jum6" value="<?php echo $hasil; ?>">
                        <td class="tengah"><font size="1"><?php echo $hasil = "Rp " . number_format($hasil,0,',','.'); ?></font></td>
                      <?php }else{ ?>
                        <input type="hidden" id="tm" value="0">
                        <?php 
                        $id = 12-$jml_lap;
                        for($i=1;$i<$id;$i++){
                          $value = 0;
                          ?>
                          <td class="tengah"><font size="1"><?php echo $value = "Rp " . number_format($value,0,',','.'); ?></font></td>
                          <?php
                        }
                        ?>
                        <input type="hidden" id="jum6" value="<?php echo $hasil; ?>">
                        <td class="tengah"><font size="1"><?php echo $hasil = "Rp " . number_format($hasil,0,',','.'); ?></font></td>
                        <?php 
                      } 
                    }
                  }
                }
              }else{ 
                ?>
                <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                <td colspan="12" class="tengah"><font size="2">Setting Jumlah Lapangan Belum Dilakukan atau Setting Gaji Tukang Masak Belum Dilakukan </font></td>
              <?php } ?>
            </tr>
            <tr>
              <td class="tengah"><font size="1">By Operasional</font></td>
              <?php if(!empty($get_gls)){
                foreach ($get_gls as $data) {
                  ?>
                  <td class="tengah"><font size="1"><?php echo $data['namauser'] ?></font></td>
                  <?php
                }
              }else{
                ?>
                <td class="tengah"><font size="1">#</font></td>
                <?php
              } 
              ?>
              <?php if(!empty($get_gaji) && !empty($get_jml_lap) && !empty($get_bop)){
                             //load data user
                $jum=0;
                $no=1;
                $total=0;
                $tl1 = 0;
                $tl2 = 0;
                $tl3 = 0;
                $tl4 = 0;
                $tl5 = 0;
                $tl6 = 0;
                $tl7 = 0;
                $tl8 = 0;
                $tl9 = 0;
                $tl10 = 0;
                $tl11 = 0;

                foreach ($get_gaji as $data){
                  foreach ($get_jml_lap as $data_jml){
                    foreach ($get_bop as $data_bop){

                      $tgl1 = date_create($data['tanggal_awal']);
                      $tgl2 = date_create($data['tanggal_akhir']);
                      $tanggal_awal = date_format($tgl1, 'd-m-Y');
                      $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                      $bln = $data['bulan'];
                      $mg = $data['minggu'];

                      $jml_lap = $data_jml['jumlah'];
                      $bop = $data_bop['biaya_op'];
                      $pembagian = $bop / $jml_lap;
                      $hasil = 0;
                      $lap = 0;
                      ?>
                      <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                      <?php
                      for($i=1;$i<=$jml_lap;$i++){
                        $lap = $pembagian;
                        $hasil += $lap;
                        ?>
                        <td class="tengah"><font size="1"><?php echo $lap = "Rp " . number_format($lap,0,',','.'); ?></font></td>
                        <?php  
                      }
                      ?>
                      <?php if($jml_lap==11){?>
                        <input type="hidden" id="bop" value="0">
                        <input type="hidden" id="jum7" value="<?php echo $hasil; ?>">
                        <td class="tengah"><font size="1"><?php echo $hasil = "Rp " . number_format($hasil,0,',','.'); ?></font></td>
                      <?php }else{ ?>
                        <input type="hidden" id="bop" value="<?php echo $pembagian; ?>">
                        <?php 
                        $id = 12-$jml_lap;
                        for($i=1;$i<$id;$i++){
                          $value = 0;
                          ?>
                          <td class="tengah"><font size="1"><?php echo $value = "Rp " . number_format($value,0,',','.'); ?></font></td>
                          <?php
                        }
                        ?>
                        <input type="hidden" id="jum7" value="<?php echo $hasil; ?>">
                        <td class="tengah"><font size="1"><?php echo $hasil = "Rp " . number_format($hasil,0,',','.'); ?></font></td>
                        <?php 
                      } 
                    }
                  }
                }
              }else{ 
                ?>
                <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                <td colspan="12" class="tengah"><font size="2">Setting Jumlah Lapangan Belum Dilakukan atau Setting Besaran Biaya Operasional Belum Dilakukan  </font></td>
              <?php } ?>
            </tr>
            <tr>
              <td class="tengah"><font size="1">Ongkos Belanja</font></td>
              <?php if(!empty($get_gls)){
                foreach ($get_gls as $data) {
                  ?>
                  <td class="tengah"><font size="1"><?php echo $data['namauser'] ?></font></td>
                  <?php
                }
              }else{
                ?>
                <td class="tengah"><font size="1">#</font></td>
                <?php
              } 
              ?>
              <?php if(!empty($get_gaji) && !empty($get_jml_lap) && !empty($get_ob)){
                             //load data user
                $jum=0;
                $no=1;
                $total=0;
                $tl1 = 0;
                $tl2 = 0;
                $tl3 = 0;
                $tl4 = 0;
                $tl5 = 0;
                $tl6 = 0;
                $tl7 = 0;
                $tl8 = 0;
                $tl9 = 0;
                $tl10 = 0;
                $tl11 = 0;

                foreach ($get_gaji as $data){
                  foreach ($get_jml_lap as $data_jml){
                    foreach ($get_ob as $data_ob){

                      $tgl1 = date_create($data['tanggal_awal']);
                      $tgl2 = date_create($data['tanggal_akhir']);
                      $tanggal_awal = date_format($tgl1, 'd-m-Y');
                      $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                      $bln = $data['bulan'];
                      $mg = $data['minggu'];

                      $jml_lap = $data_jml['jumlah'];
                              //$ob = $data_ob['ongkos']*7;
                      $ob = $data_ob['ongkos'];
                      $pembagian = $ob / $jml_lap;
                      $hasil = 0;
                      $lap = 0;
                      ?>
                      <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                      <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                      <?php
                      for($i=1;$i<=$jml_lap;$i++){
                        $lap = $pembagian;
                        $hasil += $lap;
                        ?>
                        <td class="tengah"><font size="1"><?php echo $lap = "Rp " . number_format($lap,0,',','.'); ?></font></td>
                        <?php  
                      }
                      ?>
                      <?php if($jml_lap==11){?>
                        <input type="hidden" id="ob" value="<?php echo $pembagian; ?>">
                        <input type="hidden" id="jum8" value="<?php echo $hasil; ?>">
                        <td class="tengah"><font size="1"><?php echo $hasil = "Rp " . number_format($hasil,0,',','.'); ?></font></td>
                      <?php }else{ ?>
                        <input type="hidden" id="ob" value="0">
                        <?php 
                        $id = 12-$jml_lap;
                        for($i=1;$i<$id;$i++){
                          $value = 0;
                          ?>
                          <td class="tengah"><font size="1"><?php echo $value = "Rp " . number_format($value,0,',','.'); ?></font></td>
                          <?php
                        }
                        ?>
                        <input type="hidden" id="jum8" value="<?php echo $hasil; ?>">
                        <td class="tengah"><font size="1"><?php echo $hasil = "Rp " . number_format($hasil,0,',','.'); ?></font></td>
                        <?php 
                      } 
                    }
                  }
                }
              }else{ 
                ?>
                <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                <td colspan="12" class="tengah"><font size="2">Setting Jumlah Lapangan Belum Dilakukan atau Setting Besaran Ongkos Belanja Belum Dilakukan </font></td>
              <?php } ?>
            </tr>
            <?php 
            $v_1 = $this->input->post('v_1');
            $v_2 = $this->input->post('v_2');
            $v_3 = $this->input->post('v_3');
            $v_4 = $this->input->post('v_4');
            $v_5 = $this->input->post('v_5');
            $v_6 = $this->input->post('v_6');
            $v_7 = $this->input->post('v_7');
            $v_8 = $this->input->post('v_8');
            $v_9 = $this->input->post('v_9');
            $v_10 = $this->input->post('v_10');
            $v_11 = $this->input->post('v_11');

            $jml_Total = $v_1+$v_2+$v_3+$v_4+$v_5+$v_6+$v_7+$v_8+$v_9+$v_10+$v_11;
            $jml = "Rp " . number_format($jml_Total,0,',','.');

            ?>

            <tr>
              <td colspan="4" class="tengah"><font size="2"><b>Anggaran Belanja</font></td>
                <td class="tengah"><font size="1" id="anggaran_1"><b><?php echo $v_1 = "Rp " . number_format($v_1,0,',','.'); ?></b></font></td>
                <td class="tengah"><font size="1" id="anggaran_2"><b><?php echo $v_2 = "Rp " . number_format($v_2,0,',','.'); ?></b></font></td>
                <td class="tengah"><font size="1" id="anggaran_3"><b><?php echo $v_3 = "Rp " . number_format($v_3,0,',','.'); ?></b></font></td>
                <td class="tengah"><font size="1" id="anggaran_4"><b><?php echo $v_4 = "Rp " . number_format($v_4,0,',','.'); ?></b></font></td>
                <td class="tengah"><font size="1" id="anggaran_5"><b><?php echo $v_5 = "Rp " . number_format($v_5,0,',','.'); ?></b></font></td>
                <td class="tengah"><font size="1" id="anggaran_6"><b><?php echo $v_6 = "Rp " . number_format($v_6,0,',','.'); ?></b></font></td>
                <td class="tengah"><font size="1" id="anggaran_7"><b><?php echo $v_7 = "Rp " . number_format($v_7,0,',','.'); ?></b></font></td>
                <td class="tengah"><font size="1" id="anggaran_8"><b><?php echo $v_8 = "Rp " . number_format($v_8,0,',','.'); ?></b></font></td>
                <td class="tengah"><font size="1" id="anggaran_9"><b><?php echo $v_9 = "Rp " . number_format($v_9,0,',','.'); ?></b></font></td>
                <td class="tengah"><font size="1" id="anggaran_10"><b><?php echo $v_10 = "Rp " . number_format($v_10,0,',','.'); ?></b></font></td>
                <td class="tengah"><font size="1" id="anggaran_11"><b><?php echo $v_11 = "Rp " . number_format($v_11,0,',','.'); ?></b></font></td>
                <td class="tengah"><font size="1" id="jumlahTotal"><b><?php echo $jml; ?></b></font></td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>

</tbody>
</table>

</div>
</div>
</div>
</div>


</body></html>

<?php
$html = ob_get_clean();

$nama_dokumen='Export_Laporan_Detail_C-'.$id_cabang.'('.$tanggal_awal.'s_d'.$tanggal_akhir.')';
require_once(APPPATH . 'third_party/mpdf60/mpdf.php');
    $mpdf=new mPDF('utf-8', 'F4-L'); // Create new mPDF Document
    $mpdf->WriteHTML(utf8_encode($html));
    $mpdf->Output($nama_dokumen.".pdf" ,'D');
    exit;
  }
}

/*============================================BIAYA OP========================================*/

function e_biaya_op(){
  error_reporting(0);
  $this->session->set_userdata(array('location' => 'Proses Export Data Biaya Operasional'));
  $data['sess_location'] = $this->session->userdata('location');
  $data['session'] = $this->session->all_userdata();
  $username = $this->session->userdata('username');
  $id_user = $this->session->userdata('id_user');
  $id_cabang = $this->session->userdata('id_cabang');
  $id_set = $this->input->post('id_set');
    //get all data ON Operator
  $get_biaya = $this->m_biaya_op->get_data_pencarian($id_user,$id_set);
  $session = $this->session->all_userdata();
  $data['namalengkap'] =strtoupper($this->session->userdata('namauser'));
  $data['namadepan'] = explode(' ',$this->session->userdata('namauser'));
  $data['firstname'] = strtoupper($data['namadepan'][0]);

  if(empty($get_biaya)){
    $this->session->set_flashdata('gagal_cetak','Data yang anda inginkan belum terdapat di database, Export Data Biaya Operasional Gagal');

    redirect('biaya_op');
  }
  else{

    ?>
    <?php ob_start();?>

    <html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" >
      <style>
        .tengah{
          text-align:center;
        }
        .kiri{
          text-align:left;
        }
        .kanan{
          text-align:right;
        }
      </style>
    </head><body>
      <!--CONTOH Code START-->
      <table border='0' align='LEFT'>
        <tr>
          <th>
            <img src="<?php echo base_url('build/img/xyz_2.png');?>"  align="left" width='165' height='150px' >
          </th>
          <th width="20">
          </th>
          <th width="2339px" align="left">
            <?php $value = date('Y-m-d');
            $tgl = date_create($value);
            $hasil = date_format($tgl,'d-m-Y');?>  
            <h1> <left> EXPORT LAPORAN <br>CV. XYZ<br> </left><center> <?php echo "Tanggal Diterbitkan : $hasil"; ?> </center></h1>
          </th>
        </tr>
      </table>
      <hr style="height:4px;" />
      <br>
      <h4 class="tengah"><font face="arial"><strong><u>LAPORAN RINCIAN BIAYA OPERASIONAL</u></strong></font></h4>
      <br>
      <div class="x_content">
        <div class="table-responsive">
          <table border="1" class="table">
            <thead>
              <tr>
                <th rowspan="2" class="tengah" width="3%">No</th>
                <th rowspan="2" class="tengah" width="5%">Bulan</th>
                <th rowspan="2" class="tengah" width="5%">Minggu</th>
                <th rowspan="2" class="tengah" width="5%">ID Cabutan</th>
                <th rowspan="2" class="tengah" width="5%">Hari</th>
                <th rowspan="2" class="tengah" width="5%">Tanggal</th>
                <th colspan="5" class="tengah">Item Biaya Operasional</th>
                <th rowspan="2" class="tengah" width="6%">Jumlah</th>
              </tr>
              <tr>
                <th rowspan="1" class="tengah" width="5%">Beras</th>
                <th rowspan="1" class="tengah" width="5%">Air Galon</th>
                <th rowspan="1" class="tengah" width="5%">Gas LPG</th>
                <th rowspan="1" class="tengah" width="5%">Resiko</th>
                <th rowspan="1" class="tengah" width="5%">Lain-lain</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $v = isset($get_biaya[0]['tanggal_awal'])?$get_biaya[0]['tanggal_awal']:'';
              $tgl_a = date_create($v);
              $tahun = date_format($tgl_a,'Y');
              ?>
              <tr>
                <th colspan="12" class="tengah"><font size="2">Minggu ke - <?php echo isset($get_biaya[0]['minggu'])?$get_biaya[0]['minggu']:'';?> (<?php echo isset($get_biaya[0]['bulan'])?$get_biaya[0]['bulan']:'';?> - <?php echo $tahun;?>)</font></th>
              </tr>

              <?php
                  //jika data user tidak kosong maka jalankan perintah dibawah ini
              if(!empty($get_biaya))
              {
                    //load data user
                $jum=0;
                $no=1;
                $total=0;
                $tl1 = 0;
                $tl2 = 0;
                $tl3 = 0;
                $tl4 = 0;
                $tl5 = 0;

                foreach ($get_biaya as $data) {
                  $tgl1 = date_create($data['tanggal_awal']);
                  $tgl2 = date_create($data['tanggal_akhir']);
                  $tanggal_awal = date_format($tgl1, 'd-m-Y');
                  $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                  $bln = $data['bulan'];
                  $mg = $data['minggu'];
                  $cab = $data['id_cabutan'];
                  $tgl = date_create($data['tanggal']);
                  $tanggal = date_format($tgl, "d-m-Y");
                  $hari = $data['hari'];
                  $lap1 = $data['biaya_beras'];
                  $lap2 = $data['biaya_air_galon'];
                  $lap3 = $data['biaya_gas'];
                  $lap4 = $data['biaya_resiko'];
                  $lap5 = $data['biaya_lain'];
                  $jum = $lap1+$lap2+$lap3+$lap4+$lap5;
                  $jml = "Rp" . number_format($jum,0,',','.');
                  $total += $jum;
                  $tl1 += $lap1;
                  $tl2 += $lap2;
                  $tl3 += $lap3;
                  $tl4 += $lap4;
                  $tl5 += $lap5;

                  ?>

                  <tr>
                    <td class="tengah"><font size="2"><?php echo $no; ?></font></td>
                    <td class="tengah"><font size="2"><?php echo $bln; ?></font></td>
                    <td class="tengah"><font size="2"><?php echo $mg; ?></font></td>
                    <td class="tengah"><font size="2"><?php echo $cab; ?></font></td>
                    <td class="tengah"><font size="2"><?php echo $hari; ?></font></td>
                    <td class="tengah"><font size="2"><?php echo $tanggal; ?></font></td>                      
                    <td class="tengah"><font size="2"> <?php echo $lap1 = "Rp" . number_format($lap1,0,',','.'); ?></font></td> 
                    <td class="tengah"><font size="2"> <?php echo $lap2 = "Rp" . number_format($lap2,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="2"> <?php echo $lap3 = "Rp" . number_format($lap3,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="2"> <?php echo $lap4 = "Rp" . number_format($lap4,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="2"> <?php echo $lap5 = "Rp" . number_format($lap5,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="2"> <?php echo $jml; ?></font></td>
                  </tr>

                  <?php
                  $no++;
                }
              }else{
               ?>
               <table>
                <tr>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-close"></i> Belum terdapat data apapun pada database.
                  </div>
                </tr>
              </table>
              <?php
            }
            ?>
          </tbody>
          <?php if(!empty($get_biaya)){?>
            <tfoot>
              <tr>                

                <th colspan="6" class="tengah"><font size="2">Total Jumlah</font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl1 = "Rp" . number_format($tl1,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl2 = "Rp" . number_format($tl2,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl3 = "Rp" . number_format($tl3,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl4 = "Rp" . number_format($tl4,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl5 = "Rp" . number_format($tl5,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $total = "Rp" . number_format($total,0,',','.'); ?></strong></font></th> 

              </tr>
            </tfoot>
          <?php } ?>
        </table>

      </div>
      <?php 
      if($id_set=='reset'){
        echo "<p>Seluruh Data (All Time)</p>";
      }else{
        ?>
        <p><?php echo 'Data Pada Bulan : '.$data['bulan'].' - Minggu ke - '.$data['minggu'].' ( '.$tanggal_awal.' s/d '.$tanggal_akhir.' )';?></p>
        <?php
      }
      ?>
    </div>

  </body></html>

  <?php
  $html = ob_get_clean();

  $nama_dokumen='Export_Data_Rincian_Biaya_Operasional_C-'.$id_cabang.'('.$tanggal_awal.'s_d'.$tanggal_akhir.')';
  require_once(APPPATH . 'third_party/mpdf60/mpdf.php');
    $mpdf=new mPDF('utf-8', 'F4-L'); // Create new mPDF Document
    $mpdf->WriteHTML(utf8_encode($html));
    $mpdf->Output($nama_dokumen.".pdf" ,'D');
    exit;
  }
}

/*============================================GAJI========================================*/

function e_gaji_anggaran(){
  error_reporting(0);
  $this->session->set_userdata(array('location' => 'Proses Export Data Rekap Gaji & By Operasional'));
  $data['sess_location'] = $this->session->userdata('location');
  $data['session'] = $this->session->all_userdata();
  $username = $this->session->userdata('username');
  $id_cabang = $this->session->userdata('id_cabang');
  $id_user = $this->session->userdata('id_user');
  $id_set = $this->input->post('id_set');
    //get all data ON Operator
  if($id_set=='reset'){
    $get_id = '1';
  }else{
    $get_id = '2';
  }
  $id_cabang = $this->session->userdata('id_cabang');
  $jabatan_sales = 'Sales';
  $jabatan_tl1 = 'Team Leader 1';
  $jabatan_tl2 = 'Team Leader 2';
  $jabatan_gl = 'Gruof Leader';
  $jabatan_al = 'Asis Leader';
  $get_sales = $this->m_user->get_data_sales($id_cabang,$jabatan_sales);
  $get_tl1 = $this->m_user->get_data_tl1($id_cabang,$jabatan_tl1);
  $get_tl2 = $this->m_user->get_data_tl2($id_cabang,$jabatan_tl2);
  $get_gl = $this->m_user->get_data_gl($id_cabang,$jabatan_gl);
  $get_al = $this->m_user->get_data_al($id_cabang,$jabatan_al);

  $get_omzet = $this->m_gaji_anggaran->get_pencarian_data($id_user,$id_set);
  $get_set_input = $this->m_set_pelaporan->get_data($id_user);
  $get_persen = $this->m_set_persen->get_data($id_user);
  $get_gaji_al = $this->m_set_persen->get_data_set_al($id_user);

  $get_jml_lap = $this->m_user->get_data_set_jml_lap($id_user);
  $get_gaji_tm = $this->m_set_persen->get_data_pencarian_set_tm($id_user,$id_set);
  $get_bop = $this->m_set_persen->get_data_pencarian_set_by_op($id_user,$id_set);
  $get_ob = $this->m_set_persen->get_data_pencarian_set_ongkos_belanja($id_user,$id_set);


  $session = $this->session->all_userdata();
  $data['namalengkap'] =strtoupper($this->session->userdata('namauser'));
  $data['namadepan'] = explode(' ',$this->session->userdata('namauser'));
  $data['firstname'] = strtoupper($data['namadepan'][0]);

  if(empty($get_omzet) && empty($get_set_input) && empty($get_persen)){
    $this->session->set_flashdata('gagal_cetak','Data yang anda inginkan belum terdapat di database, Export Data Rekap Gaji Gagal');

    redirect('gaji_anggaran');
  }
  else{

    ?>
    <?php ob_start();?>

    <html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" >
      <style>
        .tengah{
          text-align:center;
        }
        .kiri{
          text-align:left;
        }
        .kanan{
          text-align:right;
        }
      </style>
    </head><body>
      <!--CONTOH Code START-->
      <table border='0' align='LEFT'>
        <tr>
          <th>
            <img src="<?php echo base_url('build/img/xyz_2.png');?>"  align="left" width='165' height='150px' >
          </th>
          <th width="20">
          </th>
          <th width="2339px" align="left">
            <?php $value = date('Y-m-d');
            $tgl = date_create($value);
            $hasil = date_format($tgl,'d-m-Y');?>  
            <h1> <left> EXPORT LAPORAN <br>CV. XYZ<br> </left><center> <?php echo "Tanggal Diterbitkan : $hasil"; ?> </center></h1>
          </th>
        </tr>
      </table>
      <hr style="height:4px;" />
      <br>
      <h4 class="tengah"><font face="arial"><strong><u>LAPORAN KONTRIBUSI GAJI DAN BY. OPERASIONAL</u></strong></font></h4>
      <br><br>
      <div class="x_content">
        <div class="table-responsive">
          <table border="1" class="table">
            <thead>
              <tr>
                <th rowspan="3" class="tengah" width="7%">Jabatan</th>
                <th rowspan="3" class="tengah" width="3%">Nama</th>
                <th rowspan="3" class="tengah" width="5%">Bln</th>
                <th rowspan="3" class="tengah" width="3%">Mg</th>
                <th colspan="11" class="tengah">Lapangan/Nama</th>
                <th rowspan="3" class="tengah" width="6%">Jumlah</th>
              </tr>
              <tr>
                <th rowspan="1" class="tengah" width="3%">1</th>
                <th rowspan="1" class="tengah" width="3%">2</th>
                <th rowspan="1" class="tengah" width="3%">3</th>
                <th rowspan="1" class="tengah" width="3%">4</th>
                <th rowspan="1" class="tengah" width="3%">5</th>
                <th rowspan="1" class="tengah" width="3%">6</th>
                <th rowspan="1" class="tengah" width="3%">7</th>
                <th rowspan="1" class="tengah" width="3%">8</th>
                <th rowspan="1" class="tengah" width="3%">9</th>
                <th rowspan="1" class="tengah" width="3%">10</th>
                <th rowspan="1" class="tengah" width="3%">11</th>
              </tr>
              <tr>
                <?php if(!empty($get_sales)){
                  foreach ($get_sales as $data) {
                    $nama = $data['namauser'];
                    ?>
                    <th rowspan="1" class="tengah"><font size="1"><?php echo ucwords($nama);?></font></th>
                    <?php 
                  }
                }else{
                  ?>
                  <th rowspan="1" class="tengah"><font size="1">#</font></th>
                  <?php
                } 
                ?>
              </tr>  
            </thead>
            <tbody>
              <?php 
              $v = isset($get_omzet[0]['tanggal_awal'])?$get_omzet[0]['tanggal_awal']:'';
              $tgl_a = date_create($v);
              $tahun = date_format($tgl_a,'Y');
              ?>
              <tr>
                <th colspan="16" class="tengah"><font size="1">Minggu ke - <?php echo isset($get_omzet[0]['minggu'])?$get_omzet[0]['minggu']:'';?> (<?php echo isset($get_omzet[0]['bulan'])?$get_omzet[0]['bulan']:'';?> - <?php echo $tahun;?>)</font></th>
              </tr>
              <tr>
                <td class="tengah"><font size="1">Gaji Sales</font></td>
                <td class="tengah"><font size="1">#</font></td>
                <?php if(!empty($get_omzet) && !empty($get_persen) && !empty($get_jml_lap)){
                             //load data user
                  $jum=0;
                  $no=1;
                  $total=0;
                  $tl1 = 0;
                  $tl2 = 0;
                  $tl3 = 0;
                  $tl4 = 0;
                  $tl5 = 0;
                  $tl6 = 0;
                  $tl7 = 0;
                  $tl8 = 0;
                  $tl9 = 0;
                  $tl10 = 0;
                  $tl11 = 0;

                  foreach ($get_omzet as $data){
                    foreach ($get_persen as $data_persen){
                      foreach ($get_jml_lap as $data_jml){
                        $id = $data_persen['id_set_penggajian'];
                        $gs = $data_persen['gaji_sales']; 
                        $tl1 = $data_persen['gaji_team_leader_1'];
                        $tl2 = $data_persen['gaji_team_leader_2']; 
                        $gl = $data_persen['gaji_grouf_leader'];

                        $tgl1 = date_create($data['tanggal_awal']);
                        $tgl2 = date_create($data['tanggal_akhir']);
                        $tanggal_awal = date_format($tgl1, 'd-m-Y');
                        $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                        $bln = $data['bulan'];
                        $mg = $data['minggu'];
                        $tgl = date_create($data['tanggal']);
                        $tanggal = date_format($tgl, "d-m-Y");
                        $hari = $data['hari'];

                        $jml_lapangan = $data_jml['jumlah'];

                        if($jml_lapangan == 1){
                          $lap1 = $data['omzet_lap_1']*$gs/100;
                          $lap2 = 0;
                          $lap3 = 0;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 2){
                          $lap1 = $data['omzet_lap_1']*$gs/100;
                          $lap2 = $data['omzet_lap_2']*$gs/100;
                          $lap3 = 0;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0; 
                        }elseif($jml_lapangan == 3){
                          $lap1 = $data['omzet_lap_1']*$gs/100;
                          $lap2 = $data['omzet_lap_2']*$gs/100;
                          $lap3 = $data['omzet_lap_3']*$gs/100;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;    

                        }elseif($jml_lapangan == 4){
                          $lap1 = $data['omzet_lap_1']*$gs/100;
                          $lap2 = $data['omzet_lap_2']*$gs/100;
                          $lap3 = $data['omzet_lap_3']*$gs/100;
                          $lap4 = $data['omzet_lap_4']*$gs/100;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 5){
                          $lap1 = $data['omzet_lap_1']*$gs/100;
                          $lap2 = $data['omzet_lap_2']*$gs/100;
                          $lap3 = $data['omzet_lap_3']*$gs/100;
                          $lap4 = $data['omzet_lap_4']*$gs/100;
                          $lap5 = $data['omzet_lap_5']*$gs/100;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 6){
                          $lap1 = $data['omzet_lap_1']*$gs/100;
                          $lap2 = $data['omzet_lap_2']*$gs/100;
                          $lap3 = $data['omzet_lap_3']*$gs/100;
                          $lap4 = $data['omzet_lap_4']*$gs/100;
                          $lap5 = $data['omzet_lap_5']*$gs/100;
                          $lap6 = $data['omzet_lap_6']*$gs/100;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 7){
                          $lap1 = $data['omzet_lap_1']*$gs/100;
                          $lap2 = $data['omzet_lap_2']*$gs/100;
                          $lap3 = $data['omzet_lap_3']*$gs/100;
                          $lap4 = $data['omzet_lap_4']*$gs/100;
                          $lap5 = $data['omzet_lap_5']*$gs/100;
                          $lap6 = $data['omzet_lap_6']*$gs/100;
                          $lap7 = $data['omzet_lap_7']*$gs/100;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 8){
                          $lap1 = $data['omzet_lap_1']*$gs/100;
                          $lap2 = $data['omzet_lap_2']*$gs/100;
                          $lap3 = $data['omzet_lap_3']*$gs/100;
                          $lap4 = $data['omzet_lap_4']*$gs/100;
                          $lap5 = $data['omzet_lap_5']*$gs/100;
                          $lap6 = $data['omzet_lap_6']*$gs/100;
                          $lap7 = $data['omzet_lap_7']*$gs/100;
                          $lap8 = $data['omzet_lap_8']*$gs/100;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 9){
                          $lap1 = $data['omzet_lap_1']*$gs/100;
                          $lap2 = $data['omzet_lap_2']*$gs/100;
                          $lap3 = $data['omzet_lap_3']*$gs/100;
                          $lap4 = $data['omzet_lap_4']*$gs/100;
                          $lap5 = $data['omzet_lap_5']*$gs/100;
                          $lap6 = $data['omzet_lap_6']*$gs/100;
                          $lap7 = $data['omzet_lap_7']*$gs/100;
                          $lap8 = $data['omzet_lap_8']*$gs/100;
                          $lap9 = $data['omzet_lap_9']*$gs/100;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 10){
                          $lap1 = $data['omzet_lap_1']*$gs/100;
                          $lap2 = $data['omzet_lap_2']*$gs/100;
                          $lap3 = $data['omzet_lap_3']*$gs/100;
                          $lap4 = $data['omzet_lap_4']*$gs/100;
                          $lap5 = $data['omzet_lap_5']*$gs/100;
                          $lap6 = $data['omzet_lap_6']*$gs/100;
                          $lap7 = $data['omzet_lap_7']*$gs/100;
                          $lap8 = $data['omzet_lap_8']*$gs/100;
                          $lap9 = $data['omzet_lap_9']*$gs/100;
                          $lap10 = $data['omzet_lap_10']*$gs/100;
                          $lap11 = 0;

                        }else{
                          $lap1 = $data['omzet_lap_1']*$gs/100;
                          $lap2 = $data['omzet_lap_2']*$gs/100;
                          $lap3 = $data['omzet_lap_3']*$gs/100;
                          $lap4 = $data['omzet_lap_4']*$gs/100;
                          $lap5 = $data['omzet_lap_5']*$gs/100;
                          $lap6 = $data['omzet_lap_6']*$gs/100;
                          $lap7 = $data['omzet_lap_7']*$gs/100;
                          $lap8 = $data['omzet_lap_8']*$gs/100;
                          $lap9 = $data['omzet_lap_9']*$gs/100;
                          $lap10 = $data['omzet_lap_10']*$gs/100;
                          $lap11 = $data['omzet_lap_11']*$gs/100;
                        }

                        $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11;
                        $jml = "Rp " . number_format($jum,0,',','.');
                        $total += $jum;
                        $tl1 += $lap1;
                        $tl2 += $lap2;
                        $tl3 += $lap3;
                        $tl4 += $lap4;
                        $tl5 += $lap5;
                        $tl6 += $lap6;
                        $tl7 += $lap7;
                        $tl8 += $lap8;
                        $tl9 += $lap9;
                        $tl10 += $lap10;
                        $tl11 += $lap11;

                        if($get_id==1){
                          $bln='ALL';
                          $mg='ALL';
                        }
                        ?>
                        <input type="hidden" id="s_1" value="<?php echo $lap1; ?>">
                        <input type="hidden" id="s_2" value="<?php echo $lap2; ?>">
                        <input type="hidden" id="s_3" value="<?php echo $lap3; ?>">
                        <input type="hidden" id="s_4" value="<?php echo $lap4; ?>">
                        <input type="hidden" id="s_5" value="<?php echo $lap5; ?>">
                        <input type="hidden" id="s_6" value="<?php echo $lap6; ?>">
                        <input type="hidden" id="s_7" value="<?php echo $lap7; ?>">
                        <input type="hidden" id="s_8" value="<?php echo $lap8; ?>">
                        <input type="hidden" id="s_9" value="<?php echo $lap9; ?>">
                        <input type="hidden" id="s_10" value="<?php echo $lap10; ?>">
                        <input type="hidden" id="s_11" value="<?php echo $lap11; ?>">
                        <input type="hidden" id="omzet_1" value="<?php echo $data['omzet_lap_1']; ?>">
                        <input type="hidden" id="omzet_2" value="<?php echo $data['omzet_lap_2']; ?>">
                        <input type="hidden" id="omzet_3" value="<?php echo $data['omzet_lap_3']; ?>">
                        <input type="hidden" id="omzet_4" value="<?php echo $data['omzet_lap_4']; ?>">
                        <input type="hidden" id="omzet_5" value="<?php echo $data['omzet_lap_5']; ?>">
                        <input type="hidden" id="omzet_6" value="<?php echo $data['omzet_lap_6']; ?>">
                        <input type="hidden" id="omzet_7" value="<?php echo $data['omzet_lap_7']; ?>">
                        <input type="hidden" id="omzet_8" value="<?php echo $data['omzet_lap_8']; ?>">
                        <input type="hidden" id="omzet_9" value="<?php echo $data['omzet_lap_9']; ?>">
                        <input type="hidden" id="omzet_10" value="<?php echo $data['omzet_lap_10']; ?>">
                        <input type="hidden" id="omzet_11" value="<?php echo $data['omzet_lap_11']; ?>">
                        <input type="hidden" id="jum1" value="<?php echo $jum; ?>">

                        <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap1 = "Rp " . number_format($lap1,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap2 = "Rp " . number_format($lap2,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap3 = "Rp " . number_format($lap3,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap4 = "Rp " . number_format($lap4,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap5 = "Rp " . number_format($lap5,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap6 = "Rp " . number_format($lap6,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap7 = "Rp " . number_format($lap7,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap8 = "Rp " . number_format($lap8,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap9 = "Rp " . number_format($lap9,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap10 = "Rp " . number_format($lap10,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap11 = "Rp " . number_format($lap11,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $jml; ?></font></td>

                        <?php 
                      }
                    }
                  } 
                }
                ?>
              </tr>
              <tr>
                <td class="tengah"><font size="1">Gaji Team Leader 1</font></td>
                <?php if(!empty($get_tl1)){
                  foreach ($get_tl1 as $data) {
                    ?>
                    <td class="tengah"><font size="1"><?php echo $data['namauser'] ?></font></td>
                    <?php
                  }
                }else{
                  ?>
                  <th rowspan="1" class="tengah" width="100"><font size="1">#</font></th>
                  <?php
                } 
                ?>
                <?php if(!empty($get_omzet) && !empty($get_persen) && !empty($get_jml_lap)){
                             //load data user
                  $jum=0;
                  $no=1;
                  $total=0;
                  $tl1 = 0;
                  $tl2 = 0;
                  $tl3 = 0;
                  $tl4 = 0;
                  $tl5 = 0;
                  $tl6 = 0;
                  $tl7 = 0;
                  $tl8 = 0;
                  $tl9 = 0;
                  $tl10 = 0;
                  $tl11 = 0;

                  foreach ($get_omzet as $data){
                    foreach ($get_persen as $data_persen){
                      foreach ($get_jml_lap as $data_jml){
                        $id = $data_persen['id_set_penggajian'];
                        $gs = $data_persen['gaji_sales']; 
                        $tl1 = $data_persen['gaji_team_leader_1'];
                        $tl2 = $data_persen['gaji_team_leader_2']; 
                        $gl = $data_persen['gaji_grouf_leader'];

                        $tgl1 = date_create($data['tanggal_awal']);
                        $tgl2 = date_create($data['tanggal_akhir']);
                        $tanggal_awal = date_format($tgl1, 'd-m-Y');
                        $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                        $bln = $data['bulan'];
                        $mg = $data['minggu'];
                        $tgl = date_create($data['tanggal']);
                        $tanggal = date_format($tgl, "d-m-Y");
                        $hari = $data['hari'];

                        $jml_lapangan = $data_jml['jumlah'];

                        if($jml_lapangan == 1){
                          $lap1 = $data['omzet_lap_1']*$tl1/100;
                          $lap2 = 0;
                          $lap3 = 0;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 2){
                          $lap1 = $data['omzet_lap_1']*$tl1/100;
                          $lap2 = $data['omzet_lap_2']*$tl1/100;
                          $lap3 = 0;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0; 
                        }elseif($jml_lapangan == 3){
                          $lap1 = $data['omzet_lap_1']*$tl1/100;
                          $lap2 = $data['omzet_lap_2']*$tl1/100;
                          $lap3 = $data['omzet_lap_3']*$tl1/100;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;    

                        }elseif($jml_lapangan == 4){
                          $lap1 = $data['omzet_lap_1']*$tl1/100;
                          $lap2 = $data['omzet_lap_2']*$tl1/100;
                          $lap3 = $data['omzet_lap_3']*$tl1/100;
                          $lap4 = $data['omzet_lap_4']*$tl1/100;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 5){
                          $lap1 = $data['omzet_lap_1']*$tl1/100;
                          $lap2 = $data['omzet_lap_2']*$tl1/100;
                          $lap3 = $data['omzet_lap_3']*$tl1/100;
                          $lap4 = $data['omzet_lap_4']*$tl1/100;
                          $lap5 = $data['omzet_lap_5']*$tl1/100;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 6){
                          $lap1 = $data['omzet_lap_1']*$tl1/100;
                          $lap2 = $data['omzet_lap_2']*$tl1/100;
                          $lap3 = $data['omzet_lap_3']*$tl1/100;
                          $lap4 = $data['omzet_lap_4']*$tl1/100;
                          $lap5 = $data['omzet_lap_5']*$tl1/100;
                          $lap6 = $data['omzet_lap_6']*$tl1/100;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 7){
                          $lap1 = $data['omzet_lap_1']*$tl1/100;
                          $lap2 = $data['omzet_lap_2']*$tl1/100;
                          $lap3 = $data['omzet_lap_3']*$tl1/100;
                          $lap4 = $data['omzet_lap_4']*$tl1/100;
                          $lap5 = $data['omzet_lap_5']*$tl1/100;
                          $lap6 = $data['omzet_lap_6']*$tl1/100;
                          $lap7 = $data['omzet_lap_7']*$tl1/100;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 8){
                          $lap1 = $data['omzet_lap_1']*$tl1/100;
                          $lap2 = $data['omzet_lap_2']*$tl1/100;
                          $lap3 = $data['omzet_lap_3']*$tl1/100;
                          $lap4 = $data['omzet_lap_4']*$tl1/100;
                          $lap5 = $data['omzet_lap_5']*$tl1/100;
                          $lap6 = $data['omzet_lap_6']*$tl1/100;
                          $lap7 = $data['omzet_lap_7']*$tl1/100;
                          $lap8 = $data['omzet_lap_8']*$tl1/100;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 9){
                          $lap1 = $data['omzet_lap_1']*$tl1/100;
                          $lap2 = $data['omzet_lap_2']*$tl1/100;
                          $lap3 = $data['omzet_lap_3']*$tl1/100;
                          $lap4 = $data['omzet_lap_4']*$tl1/100;
                          $lap5 = $data['omzet_lap_5']*$tl1/100;
                          $lap6 = $data['omzet_lap_6']*$tl1/100;
                          $lap7 = $data['omzet_lap_7']*$tl1/100;
                          $lap8 = $data['omzet_lap_8']*$tl1/100;
                          $lap9 = $data['omzet_lap_9']*$tl1/100;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 10){
                          $lap1 = $data['omzet_lap_1']*$tl1/100;
                          $lap2 = $data['omzet_lap_2']*$tl1/100;
                          $lap3 = $data['omzet_lap_3']*$tl1/100;
                          $lap4 = $data['omzet_lap_4']*$tl1/100;
                          $lap5 = $data['omzet_lap_5']*$tl1/100;
                          $lap6 = $data['omzet_lap_6']*$tl1/100;
                          $lap7 = $data['omzet_lap_7']*$tl1/100;
                          $lap8 = $data['omzet_lap_8']*$tl1/100;
                          $lap9 = $data['omzet_lap_9']*$tl1/100;
                          $lap10 = $data['omzet_lap_10']*$tl1/100;
                          $lap11 = 0;

                        }else{
                          $lap1 = $data['omzet_lap_1']*$tl1/100;
                          $lap2 = $data['omzet_lap_2']*$tl1/100;
                          $lap3 = $data['omzet_lap_3']*$tl1/100;
                          $lap4 = $data['omzet_lap_4']*$tl1/100;
                          $lap5 = $data['omzet_lap_5']*$tl1/100;
                          $lap6 = $data['omzet_lap_6']*$tl1/100;
                          $lap7 = $data['omzet_lap_7']*$tl1/100;
                          $lap8 = $data['omzet_lap_8']*$tl1/100;
                          $lap9 = $data['omzet_lap_9']*$tl1/100;
                          $lap10 = $data['omzet_lap_10']*$tl1/100;
                          $lap11 = $data['omzet_lap_11']*$tl1/100;
                        }

                        $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11;
                        $jml = "Rp " . number_format($jum,0,',','.');
                        $total += $jum;
                        $tl1 += $lap1;
                        $tl2 += $lap2;
                        $tl3 += $lap3;
                        $tl4 += $lap4;
                        $tl5 += $lap5;
                        $tl6 += $lap6;
                        $tl7 += $lap7;
                        $tl8 += $lap8;
                        $tl9 += $lap9;
                        $tl10 += $lap10;
                        $tl11 += $lap11;

                        if($get_id==1){
                          $bln='ALL';
                          $mg='ALL';
                        }
                        ?>
                        <input type="hidden" id="tm_1_1" value="<?php echo $lap1; ?>">
                        <input type="hidden" id="tm_1_2" value="<?php echo $lap2; ?>">
                        <input type="hidden" id="tm_1_3" value="<?php echo $lap3; ?>">
                        <input type="hidden" id="tm_1_4" value="<?php echo $lap4; ?>">
                        <input type="hidden" id="tm_1_5" value="<?php echo $lap5; ?>">
                        <input type="hidden" id="tm_1_6" value="<?php echo $lap6; ?>">
                        <input type="hidden" id="tm_1_7" value="<?php echo $lap7; ?>">
                        <input type="hidden" id="tm_1_8" value="<?php echo $lap8; ?>">
                        <input type="hidden" id="tm_1_9" value="<?php echo $lap9; ?>">
                        <input type="hidden" id="tm_1_10" value="<?php echo $lap10; ?>">
                        <input type="hidden" id="tm_1_11" value="<?php echo $lap11; ?>">
                        <input type="hidden" id="jum2" value="<?php echo $jum; ?>">
                        <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap1 = "Rp " . number_format($lap1,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap2 = "Rp " . number_format($lap2,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap3 = "Rp " . number_format($lap3,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap4 = "Rp " . number_format($lap4,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap5 = "Rp " . number_format($lap5,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap6 = "Rp " . number_format($lap6,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap7 = "Rp " . number_format($lap7,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap8 = "Rp " . number_format($lap8,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap9 = "Rp " . number_format($lap9,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap10 = "Rp " . number_format($lap10,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap11 = "Rp " . number_format($lap11,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $jml; ?></font></td>

                        <?php 
                      }
                    }
                  }
                } 
                ?>
              </tr>
              <tr>
                <td class="tengah"><font size="1">Gaji Team Leader 2</font></td>
                <?php if(!empty($get_tl2)){
                  foreach ($get_tl2 as $data) {
                    ?>
                    <td class="tengah"><font size="1"><?php echo $data['namauser'] ?></font></td>
                    <?php
                  }
                }else{
                  ?>
                  <th rowspan="1" class="tengah" width="100"><font size="1">#</font></th>
                  <?php
                } 
                ?>
                <?php if(!empty($get_omzet) && !empty($get_persen) && !empty($get_jml_lap)){
                             //load data user
                  $jum=0;
                  $no=1;
                  $total=0;
                  $tl1 = 0;
                  $tl2 = 0;
                  $tl3 = 0;
                  $tl4 = 0;
                  $tl5 = 0;
                  $tl6 = 0;
                  $tl7 = 0;
                  $tl8 = 0;
                  $tl9 = 0;
                  $tl10 = 0;
                  $tl11 = 0;

                  foreach ($get_omzet as $data){
                    foreach ($get_persen as $data_persen){
                      foreach ($get_jml_lap as $data_jml){
                        $id = $data_persen['id_set_penggajian'];
                        $gs = $data_persen['gaji_sales']; 
                        $tl1 = $data_persen['gaji_team_leader_1'];
                        $tl2 = $data_persen['gaji_team_leader_2']; 
                        $gl = $data_persen['gaji_grouf_leader'];

                        $tgl1 = date_create($data['tanggal_awal']);
                        $tgl2 = date_create($data['tanggal_akhir']);
                        $tanggal_awal = date_format($tgl1, 'd-m-Y');
                        $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                        $bln = $data['bulan'];
                        $mg = $data['minggu'];
                        $tgl = date_create($data['tanggal']);
                        $tanggal = date_format($tgl, "d-m-Y");
                        $hari = $data['hari'];

                        $jml_lapangan = $data_jml['jumlah'];

                        if($jml_lapangan == 1){
                          $lap1 = $data['omzet_lap_1']*$tl2/100;
                          $lap2 = 0;
                          $lap3 = 0;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 2){
                          $lap1 = $data['omzet_lap_1']*$tl2/100;
                          $lap2 = $data['omzet_lap_2']*$tl2/100;
                          $lap3 = 0;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0; 
                        }elseif($jml_lapangan == 3){
                          $lap1 = $data['omzet_lap_1']*$tl2/100;
                          $lap2 = $data['omzet_lap_2']*$tl2/100;
                          $lap3 = $data['omzet_lap_3']*$tl2/100;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;    

                        }elseif($jml_lapangan == 4){
                          $lap1 = $data['omzet_lap_1']*$tl2/100;
                          $lap2 = $data['omzet_lap_2']*$tl2/100;
                          $lap3 = $data['omzet_lap_3']*$tl2/100;
                          $lap4 = $data['omzet_lap_4']*$tl2/100;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 5){
                          $lap1 = $data['omzet_lap_1']*$tl2/100;
                          $lap2 = $data['omzet_lap_2']*$tl2/100;
                          $lap3 = $data['omzet_lap_3']*$tl2/100;
                          $lap4 = $data['omzet_lap_4']*$tl2/100;
                          $lap5 = $data['omzet_lap_5']*$tl2/100;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 6){
                          $lap1 = $data['omzet_lap_1']*$tl2/100;
                          $lap2 = $data['omzet_lap_2']*$tl2/100;
                          $lap3 = $data['omzet_lap_3']*$tl2/100;
                          $lap4 = $data['omzet_lap_4']*$tl2/100;
                          $lap5 = $data['omzet_lap_5']*$tl2/100;
                          $lap6 = $data['omzet_lap_6']*$tl2/100;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 7){
                          $lap1 = $data['omzet_lap_1']*$tl2/100;
                          $lap2 = $data['omzet_lap_2']*$tl2/100;
                          $lap3 = $data['omzet_lap_3']*$tl2/100;
                          $lap4 = $data['omzet_lap_4']*$tl2/100;
                          $lap5 = $data['omzet_lap_5']*$tl2/100;
                          $lap6 = $data['omzet_lap_6']*$tl2/100;
                          $lap7 = $data['omzet_lap_7']*$tl2/100;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 8){
                          $lap1 = $data['omzet_lap_1']*$tl2/100;
                          $lap2 = $data['omzet_lap_2']*$tl2/100;
                          $lap3 = $data['omzet_lap_3']*$tl2/100;
                          $lap4 = $data['omzet_lap_4']*$tl2/100;
                          $lap5 = $data['omzet_lap_5']*$tl2/100;
                          $lap6 = $data['omzet_lap_6']*$tl2/100;
                          $lap7 = $data['omzet_lap_7']*$tl2/100;
                          $lap8 = $data['omzet_lap_8']*$tl2/100;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 9){
                          $lap1 = $data['omzet_lap_1']*$tl2/100;
                          $lap2 = $data['omzet_lap_2']*$tl2/100;
                          $lap3 = $data['omzet_lap_3']*$tl2/100;
                          $lap4 = $data['omzet_lap_4']*$tl2/100;
                          $lap5 = $data['omzet_lap_5']*$tl2/100;
                          $lap6 = $data['omzet_lap_6']*$tl2/100;
                          $lap7 = $data['omzet_lap_7']*$tl2/100;
                          $lap8 = $data['omzet_lap_8']*$tl2/100;
                          $lap9 = $data['omzet_lap_9']*$tl2/100;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 10){
                          $lap1 = $data['omzet_lap_1']*$tl2/100;
                          $lap2 = $data['omzet_lap_2']*$tl2/100;
                          $lap3 = $data['omzet_lap_3']*$tl2/100;
                          $lap4 = $data['omzet_lap_4']*$tl2/100;
                          $lap5 = $data['omzet_lap_5']*$tl2/100;
                          $lap6 = $data['omzet_lap_6']*$tl2/100;
                          $lap7 = $data['omzet_lap_7']*$tl2/100;
                          $lap8 = $data['omzet_lap_8']*$tl2/100;
                          $lap9 = $data['omzet_lap_9']*$tl2/100;
                          $lap10 = $data['omzet_lap_10']*$tl2/100;
                          $lap11 = 0;

                        }else{
                          $lap1 = $data['omzet_lap_1']*$tl2/100;
                          $lap2 = $data['omzet_lap_2']*$tl2/100;
                          $lap3 = $data['omzet_lap_3']*$tl2/100;
                          $lap4 = $data['omzet_lap_4']*$tl2/100;
                          $lap5 = $data['omzet_lap_5']*$tl2/100;
                          $lap6 = $data['omzet_lap_6']*$tl2/100;
                          $lap7 = $data['omzet_lap_7']*$tl2/100;
                          $lap8 = $data['omzet_lap_8']*$tl2/100;
                          $lap9 = $data['omzet_lap_9']*$tl2/100;
                          $lap10 = $data['omzet_lap_10']*$tl2/100;
                          $lap11 = $data['omzet_lap_11']*$tl2/100;
                        }

                        $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11;
                        $jml = "Rp " . number_format($jum,0,',','.');
                        $total += $jum;
                        $tl1 += $lap1;
                        $tl2 += $lap2;
                        $tl3 += $lap3;
                        $tl4 += $lap4;
                        $tl5 += $lap5;
                        $tl6 += $lap6;
                        $tl7 += $lap7;
                        $tl8 += $lap8;
                        $tl9 += $lap9;
                        $tl10 += $lap10;
                        $tl11 += $lap11;

                        if($get_id==1){
                          $bln='ALL';
                          $mg='ALL';
                        }
                        ?>
                        <input type="hidden" id="tm_2_1" value="<?php echo $lap1; ?>">
                        <input type="hidden" id="tm_2_2" value="<?php echo $lap2; ?>">
                        <input type="hidden" id="tm_2_3" value="<?php echo $lap3; ?>">
                        <input type="hidden" id="tm_2_4" value="<?php echo $lap4; ?>">
                        <input type="hidden" id="tm_2_5" value="<?php echo $lap5; ?>">
                        <input type="hidden" id="tm_2_6" value="<?php echo $lap6; ?>">
                        <input type="hidden" id="tm_2_7" value="<?php echo $lap7; ?>">
                        <input type="hidden" id="tm_2_8" value="<?php echo $lap8; ?>">
                        <input type="hidden" id="tm_2_9" value="<?php echo $lap9; ?>">
                        <input type="hidden" id="tm_2_10" value="<?php echo $lap10; ?>">
                        <input type="hidden" id="tm_2_11" value="<?php echo $lap11; ?>">
                        <input type="hidden" id="jum3" value="<?php echo $jum; ?>">
                        <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap1 = "Rp " . number_format($lap1,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap2 = "Rp " . number_format($lap2,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap3 = "Rp " . number_format($lap3,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap4 = "Rp " . number_format($lap4,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap5 = "Rp " . number_format($lap5,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap6 = "Rp " . number_format($lap6,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap7 = "Rp " . number_format($lap7,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap8 = "Rp " . number_format($lap8,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap9 = "Rp " . number_format($lap9,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap10 = "Rp " . number_format($lap10,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap11 = "Rp " . number_format($lap11,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $jml; ?></font></td>

                        <?php 
                      }
                    }
                  }
                } 
                ?>
              </tr>
              <tr>
                <td class="tengah"><font size="1">Gaji Grouf Leader</font></td>
                <?php if(!empty($get_gl)){
                  foreach ($get_gl as $data) {
                    ?>
                    <td class="tengah"><font size="1"><?php echo $data['namauser'] ?></font></td>
                    <?php
                  }
                }else{
                  ?>
                  <th rowspan="1" class="tengah" width="100"><font size="1">#</font></th>
                  <?php
                } 
                ?>
                <?php if(!empty($get_omzet) && !empty($get_persen) && !empty($get_jml_lap)){
                             //load data user
                  $jum=0;
                  $no=1;
                  $total=0;
                  $tl1 = 0;
                  $tl2 = 0;
                  $tl3 = 0;
                  $tl4 = 0;
                  $tl5 = 0;
                  $tl6 = 0;
                  $tl7 = 0;
                  $tl8 = 0;
                  $tl9 = 0;
                  $tl10 = 0;
                  $tl11 = 0;

                  foreach ($get_omzet as $data){
                    foreach ($get_persen as $data_persen){
                      foreach ($get_jml_lap as $data_jml){

                        $id = $data_persen['id_set_penggajian'];
                        $gs = $data_persen['gaji_sales']; 
                        $tl1 = $data_persen['gaji_team_leader_1'];
                        $tl2 = $data_persen['gaji_team_leader_2']; 
                        $gl = $data_persen['gaji_grouf_leader'];

                        $tgl1 = date_create($data['tanggal_awal']);
                        $tgl2 = date_create($data['tanggal_akhir']);
                        $tanggal_awal = date_format($tgl1, 'd-m-Y');
                        $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                        $bln = $data['bulan'];
                        $mg = $data['minggu'];
                        $tgl = date_create($data['tanggal']);
                        $tanggal = date_format($tgl, "d-m-Y");
                        $hari = $data['hari'];

                        $jml_lapangan = $data_jml['jumlah'];

                        if($jml_lapangan == 1){
                          $lap1 = $data['omzet_lap_1']*$gl/100;
                          $lap2 = 0;
                          $lap3 = 0;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 2){
                          $lap1 = $data['omzet_lap_1']*$gl/100;
                          $lap2 = $data['omzet_lap_2']*$gl/100;
                          $lap3 = 0;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0; 
                        }elseif($jml_lapangan == 3){
                          $lap1 = $data['omzet_lap_1']*$gl/100;
                          $lap2 = $data['omzet_lap_2']*$gl/100;
                          $lap3 = $data['omzet_lap_3']*$gl/100;
                          $lap4 = 0;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;    

                        }elseif($jml_lapangan == 4){
                          $lap1 = $data['omzet_lap_1']*$gl/100;
                          $lap2 = $data['omzet_lap_2']*$gl/100;
                          $lap3 = $data['omzet_lap_3']*$gl/100;
                          $lap4 = $data['omzet_lap_4']*$gl/100;
                          $lap5 = 0;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 5){
                          $lap1 = $data['omzet_lap_1']*$gl/100;
                          $lap2 = $data['omzet_lap_2']*$gl/100;
                          $lap3 = $data['omzet_lap_3']*$gl/100;
                          $lap4 = $data['omzet_lap_4']*$gl/100;
                          $lap5 = $data['omzet_lap_5']*$gl/100;
                          $lap6 = 0;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 6){
                          $lap1 = $data['omzet_lap_1']*$gl/100;
                          $lap2 = $data['omzet_lap_2']*$gl/100;
                          $lap3 = $data['omzet_lap_3']*$gl/100;
                          $lap4 = $data['omzet_lap_4']*$gl/100;
                          $lap5 = $data['omzet_lap_5']*$gl/100;
                          $lap6 = $data['omzet_lap_6']*$gl/100;
                          $lap7 = 0;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 7){
                          $lap1 = $data['omzet_lap_1']*$gl/100;
                          $lap2 = $data['omzet_lap_2']*$gl/100;
                          $lap3 = $data['omzet_lap_3']*$gl/100;
                          $lap4 = $data['omzet_lap_4']*$gl/100;
                          $lap5 = $data['omzet_lap_5']*$gl/100;
                          $lap6 = $data['omzet_lap_6']*$gl/100;
                          $lap7 = $data['omzet_lap_7']*$gl/100;
                          $lap8 = 0;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;  

                        }elseif($jml_lapangan == 8){
                          $lap1 = $data['omzet_lap_1']*$gl/100;
                          $lap2 = $data['omzet_lap_2']*$gl/100;
                          $lap3 = $data['omzet_lap_3']*$gl/100;
                          $lap4 = $data['omzet_lap_4']*$gl/100;
                          $lap5 = $data['omzet_lap_5']*$gl/100;
                          $lap6 = $data['omzet_lap_6']*$gl/100;
                          $lap7 = $data['omzet_lap_7']*$gl/100;
                          $lap8 = $data['omzet_lap_8']*$gl/100;
                          $lap9 = 0;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 9){
                          $lap1 = $data['omzet_lap_1']*$gl/100;
                          $lap2 = $data['omzet_lap_2']*$gl/100;
                          $lap3 = $data['omzet_lap_3']*$gl/100;
                          $lap4 = $data['omzet_lap_4']*$gl/100;
                          $lap5 = $data['omzet_lap_5']*$gl/100;
                          $lap6 = $data['omzet_lap_6']*$gl/100;
                          $lap7 = $data['omzet_lap_7']*$gl/100;
                          $lap8 = $data['omzet_lap_8']*$gl/100;
                          $lap9 = $data['omzet_lap_9']*$gl/100;
                          $lap10 = 0;
                          $lap11 = 0;

                        }elseif($jml_lapangan == 10){
                          $lap1 = $data['omzet_lap_1']*$gl/100;
                          $lap2 = $data['omzet_lap_2']*$gl/100;
                          $lap3 = $data['omzet_lap_3']*$gl/100;
                          $lap4 = $data['omzet_lap_4']*$gl/100;
                          $lap5 = $data['omzet_lap_5']*$gl/100;
                          $lap6 = $data['omzet_lap_6']*$gl/100;
                          $lap7 = $data['omzet_lap_7']*$gl/100;
                          $lap8 = $data['omzet_lap_8']*$gl/100;
                          $lap9 = $data['omzet_lap_9']*$gl/100;
                          $lap10 = $data['omzet_lap_10']*$gl/100;
                          $lap11 = 0;

                        }else{
                          $lap1 = $data['omzet_lap_1']*$gl/100;
                          $lap2 = $data['omzet_lap_2']*$gl/100;
                          $lap3 = $data['omzet_lap_3']*$gl/100;
                          $lap4 = $data['omzet_lap_4']*$gl/100;
                          $lap5 = $data['omzet_lap_5']*$gl/100;
                          $lap6 = $data['omzet_lap_6']*$gl/100;
                          $lap7 = $data['omzet_lap_7']*$gl/100;
                          $lap8 = $data['omzet_lap_8']*$gl/100;
                          $lap9 = $data['omzet_lap_9']*$gl/100;
                          $lap10 = $data['omzet_lap_10']*$gl/100;
                          $lap11 = $data['omzet_lap_11']*$gl/100;
                        }

                        $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11;
                        $jml = "Rp " . number_format($jum,0,',','.');
                        $total += $jum;
                        $tl1 += $lap1;
                        $tl2 += $lap2;
                        $tl3 += $lap3;
                        $tl4 += $lap4;
                        $tl5 += $lap5;
                        $tl6 += $lap6;
                        $tl7 += $lap7;
                        $tl8 += $lap8;
                        $tl9 += $lap9;
                        $tl10 += $lap10;
                        $tl11 += $lap11;

                        ?>
                        <input type="hidden" id="gl_1" value="<?php echo $lap1; ?>">
                        <input type="hidden" id="gl_2" value="<?php echo $lap2; ?>">
                        <input type="hidden" id="gl_3" value="<?php echo $lap3; ?>">
                        <input type="hidden" id="gl_4" value="<?php echo $lap4; ?>">
                        <input type="hidden" id="gl_5" value="<?php echo $lap5; ?>">
                        <input type="hidden" id="gl_6" value="<?php echo $lap6; ?>">
                        <input type="hidden" id="gl_7" value="<?php echo $lap7; ?>">
                        <input type="hidden" id="gl_8" value="<?php echo $lap8; ?>">
                        <input type="hidden" id="gl_9" value="<?php echo $lap9; ?>">
                        <input type="hidden" id="gl_10" value="<?php echo $lap10; ?>">
                        <input type="hidden" id="gl_11" value="<?php echo $lap11; ?>">
                        <input type="hidden" id="jum4" value="<?php echo $jum; ?>">
                        <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap1 = "Rp " . number_format($lap1,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap2 = "Rp " . number_format($lap2,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap3 = "Rp " . number_format($lap3,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap4 = "Rp " . number_format($lap4,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap5 = "Rp " . number_format($lap5,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap6 = "Rp " . number_format($lap6,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap7 = "Rp " . number_format($lap7,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap8 = "Rp " . number_format($lap8,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap9 = "Rp " . number_format($lap9,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap10 = "Rp " . number_format($lap10,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $lap11 = "Rp " . number_format($lap11,0,',','.'); ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $jml; ?></font></td>

                        <?php 
                      }
                    }
                  } 
                }
                ?>
              </tr>
              <tr>
                <td class="tengah"><font size="1">Gaji Asis Leader</font></td>
                <?php if(!empty($get_al)){
                  foreach ($get_al as $data) {
                    ?>
                    <td class="tengah"><font size="1"><?php echo $data['namauser'] ?></font></td>
                    <?php
                  }
                }else{
                  ?>
                  <td class="tengah"><font size="1">#</font></td>
                  <?php 
                } 
                ?>
                <?php if(!empty($get_omzet) && !empty($get_gaji_al) && !empty($get_jml_lap)){
                             //load data user
                  $jum=0;
                  $no=1;
                  $total=0;
                  $tl1 = 0;
                  $tl2 = 0;
                  $tl3 = 0;
                  $tl4 = 0;
                  $tl5 = 0;
                  $tl6 = 0;
                  $tl7 = 0;
                  $tl8 = 0;
                  $tl9 = 0;
                  $tl10 = 0;
                  $tl11 = 0;

                  foreach ($get_omzet as $data){
                    foreach ($get_gaji_al as $data_gaji_al){
                      foreach ($get_jml_lap as $data_jml){
                        $id = $data_gaji_al['id_set_gaji_al'];
                        $status = $data_gaji_al['status'];
                        $jml_lapangan = $data_jml['jumlah'];

                        $tgl1 = date_create($data['tanggal_awal']);
                        $tgl2 = date_create($data['tanggal_akhir']);
                        $tanggal_awal = date_format($tgl1, 'd-m-Y');
                        $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                        if($status == 'Training'){
                          $v=0;
                          $gaji = 1000000;
                                //$hasil = "Rp " . number_format($gaji,0,',','.');
                          if($jml_lapangan == 1){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = 0;
                            $lap3 = 0;
                            $lap4 = 0;
                            $lap5 = 0;
                            $lap6 = 0;
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;

                          }elseif($jml_lapangan == 2){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan; 
                            $lap3 = 0;
                            $lap4 = 0;
                            $lap5 = 0;
                            $lap6 = 0;
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0; 
                          }elseif($jml_lapangan == 3){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = 0;
                            $lap5 = 0;
                            $lap6 = 0;
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;    

                          }elseif($jml_lapangan == 4){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = $gaji/$jml_lapangan;
                            $lap5 = 0;
                            $lap6 = 0;
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;  

                          }elseif($jml_lapangan == 5){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = $gaji/$jml_lapangan;
                            $lap5 = $gaji/$jml_lapangan;
                            $lap6 = 0;
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;  

                          }elseif($jml_lapangan == 6){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = $gaji/$jml_lapangan;
                            $lap5 = $gaji/$jml_lapangan;
                            $lap6 = $gaji/$jml_lapangan;
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;  

                          }elseif($jml_lapangan == 7){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = $gaji/$jml_lapangan;
                            $lap5 = $gaji/$jml_lapangan;
                            $lap6 = $gaji/$jml_lapangan;
                            $lap7 = $gaji/$jml_lapangan;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;  

                          }elseif($jml_lapangan == 8){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = $gaji/$jml_lapangan;
                            $lap5 = $gaji/$jml_lapangan;
                            $lap6 = $gaji/$jml_lapangan;
                            $lap7 = $gaji/$jml_lapangan;
                            $lap8 = $gaji/$jml_lapangan;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;

                          }elseif($jml_lapangan == 9){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = $gaji/$jml_lapangan;
                            $lap5 = $gaji/$jml_lapangan;
                            $lap6 = $gaji/$jml_lapangan;
                            $lap7 = $gaji/$jml_lapangan;
                            $lap8 = $gaji/$jml_lapangan;
                            $lap9 = $gaji/$jml_lapangan;
                            $lap10 = 0;
                            $lap11 = 0;

                          }elseif($jml_lapangan == 10){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = $gaji/$jml_lapangan;
                            $lap5 = $gaji/$jml_lapangan;
                            $lap6 = $gaji/$jml_lapangan;
                            $lap7 = $gaji/$jml_lapangan;
                            $lap8 = $gaji/$jml_lapangan;
                            $lap9 = $gaji/$jml_lapangan;
                            $lap10 = $gaji/$jml_lapangan;
                            $lap11 = 0;

                          }else{
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = $gaji/$jml_lapangan;
                            $lap5 = $gaji/$jml_lapangan;
                            $lap6 = $gaji/$jml_lapangan;
                            $lap7 = $gaji/$jml_lapangan;
                            $lap8 = $gaji/$jml_lapangan;
                            $lap9 = $gaji/$jml_lapangan;
                            $lap10 = $gaji/$jml_lapangan;
                            $lap11 = $gaji/$jml_lapangan;
                          }
                          $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11;
                          $jml = "Rp " . number_format($jum,0,',','.');
                          $total += $jum;
                        }elseif ($status == 'Pasca Training') {
                          $v=0;
                          $gaji = 1250000;
                                //$hasil = "Rp " . number_format($gaji,0,',','.');
                          if($jml_lapangan == 1){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = 0;
                            $lap3 = 0;
                            $lap4 = 0;
                            $lap5 = 0;
                            $lap6 = 0;
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;

                          }elseif($jml_lapangan == 2){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan; 
                            $lap3 = 0;
                            $lap4 = 0;
                            $lap5 = 0;
                            $lap6 = 0;
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0; 
                          }elseif($jml_lapangan == 3){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = 0;
                            $lap5 = 0;
                            $lap6 = 0;
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;    

                          }elseif($jml_lapangan == 4){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = $gaji/$jml_lapangan;
                            $lap5 = 0;
                            $lap6 = 0;
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;  

                          }elseif($jml_lapangan == 5){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = $gaji/$jml_lapangan;
                            $lap5 = $gaji/$jml_lapangan;
                            $lap6 = 0;
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;  

                          }elseif($jml_lapangan == 6){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = $gaji/$jml_lapangan;
                            $lap5 = $gaji/$jml_lapangan;
                            $lap6 = $gaji/$jml_lapangan;
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;  

                          }elseif($jml_lapangan == 7){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = $gaji/$jml_lapangan;
                            $lap5 = $gaji/$jml_lapangan;
                            $lap6 = $gaji/$jml_lapangan;
                            $lap7 = $gaji/$jml_lapangan;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;  

                          }elseif($jml_lapangan == 8){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = $gaji/$jml_lapangan;
                            $lap5 = $gaji/$jml_lapangan;
                            $lap6 = $gaji/$jml_lapangan;
                            $lap7 = $gaji/$jml_lapangan;
                            $lap8 = $gaji/$jml_lapangan;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;

                          }elseif($jml_lapangan == 9){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = $gaji/$jml_lapangan;
                            $lap5 = $gaji/$jml_lapangan;
                            $lap6 = $gaji/$jml_lapangan;
                            $lap7 = $gaji/$jml_lapangan;
                            $lap8 = $gaji/$jml_lapangan;
                            $lap9 = $gaji/$jml_lapangan;
                            $lap10 = 0;
                            $lap11 = 0;

                          }elseif($jml_lapangan == 10){
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = $gaji/$jml_lapangan;
                            $lap5 = $gaji/$jml_lapangan;
                            $lap6 = $gaji/$jml_lapangan;
                            $lap7 = $gaji/$jml_lapangan;
                            $lap8 = $gaji/$jml_lapangan;
                            $lap9 = $gaji/$jml_lapangan;
                            $lap10 = $gaji/$jml_lapangan;
                            $lap11 = 0;

                          }else{
                            $lap1 = $gaji/$jml_lapangan;
                            $lap2 = $gaji/$jml_lapangan;
                            $lap3 = $gaji/$jml_lapangan;
                            $lap4 = $gaji/$jml_lapangan;
                            $lap5 = $gaji/$jml_lapangan;
                            $lap6 = $gaji/$jml_lapangan;
                            $lap7 = $gaji/$jml_lapangan;
                            $lap8 = $gaji/$jml_lapangan;
                            $lap9 = $gaji/$jml_lapangan;
                            $lap10 = $gaji/$jml_lapangan;
                            $lap11 = $gaji/$jml_lapangan;
                          }
                          $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11;
                          $jml = "Rp " . number_format($jum,0,',','.');
                          $total += $jum;
                        }else{
                          $v=1;
                          $gaji = 5/100;
                          if($jml_lapangan == '1'){
                            $lap1 = $data['omzet_lap_1']*$gaji;
                            $lap2 = 0;
                            $lap3 = 0;
                            $lap4 = 0;
                            $lap5 = 0;
                            $lap6 = 0;
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;  
                          }elseif($jml_lapangan == '2'){
                            $lap1 = $data['omzet_lap_1']*$gaji;
                            $lap2 = $data['omzet_lap_2']*$gaji;  
                            $lap3 = 0;
                            $lap4 = 0;
                            $lap5 = 0;
                            $lap6 = 0;
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;
                          }elseif($jml_lapangan == '3'){
                            $lap1 = $data['omzet_lap_1']*$gaji;
                            $lap2 = $data['omzet_lap_2']*$gaji;
                            $lap3 = $data['omzet_lap_3']*$gaji;
                            $lap4 = 0;
                            $lap5 = 0;
                            $lap6 = 0;
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;
                          }elseif($jml_lapangan == '4'){
                            $lap1 = $data['omzet_lap_1']*$gaji;
                            $lap2 = $data['omzet_lap_2']*$gaji;
                            $lap3 = $data['omzet_lap_3']*$gaji;
                            $lap4 = $data['omzet_lap_4']*$gaji;
                            $lap5 = 0;
                            $lap6 = 0;
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;
                          }elseif($jml_lapangan == '5'){
                            $lap1 = $data['omzet_lap_1']*$gaji;
                            $lap2 = $data['omzet_lap_2']*$gaji;
                            $lap3 = $data['omzet_lap_3']*$gaji;
                            $lap4 = $data['omzet_lap_4']*$gaji;
                            $lap5 = $data['omzet_lap_5']*$gaji;
                            $lap6 = 0;
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;
                          }elseif($jml_lapangan == '6'){
                            $lap1 = $data['omzet_lap_1']*$gaji;
                            $lap2 = $data['omzet_lap_2']*$gaji;
                            $lap3 = $data['omzet_lap_3']*$gaji;
                            $lap4 = $data['omzet_lap_4']*$gaji;
                            $lap5 = $data['omzet_lap_5']*$gaji;
                            $lap6 = $data['omzet_lap_6']*$gaji;    
                            $lap7 = 0;
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;                          
                          }elseif($jml_lapangan == '7'){
                            $lap1 = $data['omzet_lap_1']*$gaji;
                            $lap2 = $data['omzet_lap_2']*$gaji;
                            $lap3 = $data['omzet_lap_3']*$gaji;
                            $lap4 = $data['omzet_lap_4']*$gaji;
                            $lap5 = $data['omzet_lap_5']*$gaji;
                            $lap6 = $data['omzet_lap_6']*$gaji;
                            $lap7 = $data['omzet_lap_7']*$gaji;   
                            $lap8 = 0;
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;                               
                          }elseif($jml_lapangan == '8'){
                            $lap1 = $data['omzet_lap_1']*$gaji;
                            $lap2 = $data['omzet_lap_2']*$gaji;
                            $lap3 = $data['omzet_lap_3']*$gaji;
                            $lap4 = $data['omzet_lap_4']*$gaji;
                            $lap5 = $data['omzet_lap_5']*$gaji;
                            $lap6 = $data['omzet_lap_6']*$gaji;
                            $lap7 = $data['omzet_lap_7']*$gaji;
                            $lap8 = $data['omzet_lap_8']*$gaji;  
                            $lap9 = 0;
                            $lap10 = 0;
                            $lap11 = 0;                                
                          }elseif($jml_lapangan == '9'){
                            $lap1 = $data['omzet_lap_1']*$gaji;
                            $lap2 = $data['omzet_lap_2']*$gaji;
                            $lap3 = $data['omzet_lap_3']*$gaji;
                            $lap4 = $data['omzet_lap_4']*$gaji;
                            $lap5 = $data['omzet_lap_5']*$gaji;
                            $lap6 = $data['omzet_lap_6']*$gaji;
                            $lap7 = $data['omzet_lap_7']*$gaji;
                            $lap8 = $data['omzet_lap_8']*$gaji;
                            $lap9 = $data['omzet_lap_9']*$gaji; 
                            $lap10 = 0;
                            $lap11 = 0;                                
                          }elseif($jml_lapangan == '10'){
                            $lap1 = $data['omzet_lap_1']*$gaji;
                            $lap2 = $data['omzet_lap_2']*$gaji;
                            $lap3 = $data['omzet_lap_3']*$gaji;
                            $lap4 = $data['omzet_lap_4']*$gaji;
                            $lap5 = $data['omzet_lap_5']*$gaji;
                            $lap6 = $data['omzet_lap_6']*$gaji;
                            $lap7 = $data['omzet_lap_7']*$gaji;
                            $lap8 = $data['omzet_lap_8']*$gaji;
                            $lap9 = $data['omzet_lap_9']*$gaji;
                            $lap10 = $data['omzet_lap_10']*$gaji;
                            $lap11 = 0;
                          }else{
                            $lap1 = $data['omzet_lap_1']*$gaji;
                            $lap2 = $data['omzet_lap_2']*$gaji;
                            $lap3 = $data['omzet_lap_3']*$gaji;
                            $lap4 = $data['omzet_lap_4']*$gaji;
                            $lap5 = $data['omzet_lap_5']*$gaji;
                            $lap6 = $data['omzet_lap_6']*$gaji;
                            $lap7 = $data['omzet_lap_7']*$gaji;
                            $lap8 = $data['omzet_lap_8']*$gaji;
                            $lap9 = $data['omzet_lap_9']*$gaji;
                            $lap10 = $data['omzet_lap_10']*$gaji;
                            $lap11 = $data['omzet_lap_11']*$gaji;
                          }
                          $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11;
                          $jml = "Rp " . number_format($jum,0,',','.');
                          $total += $jum;
                        }

                        $bln = $data['bulan'];
                        $mg = $data['minggu'];

                        if($mg != $data_gaji_al['minggu']){
                          ?>
                          <input type="hidden" id="al_1" value="0">
                          <input type="hidden" id="al_2" value="0">
                          <input type="hidden" id="al_3" value="0">
                          <input type="hidden" id="al_4" value="0">
                          <input type="hidden" id="al_5" value="0">
                          <input type="hidden" id="al_6" value="0">
                          <input type="hidden" id="al_7" value="0">
                          <input type="hidden" id="al_8" value="0">
                          <input type="hidden" id="al_9" value="0">
                          <input type="hidden" id="al_10" value="0">
                          <input type="hidden" id="al_11" value="0">
                          <input type="hidden" id="jum5" value="0">
                          <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                          <td colspan="12" class="tengah"><font size="2">Gaji Asis Leader Belum Keluar</font></td>
                          <?php
                        }else{
                          if($v == 1){
                            ?>
                            <input type="hidden" id="al_1" value="<?php echo $lap1; ?>">
                            <input type="hidden" id="al_2" value="<?php echo $lap2; ?>">
                            <input type="hidden" id="al_3" value="<?php echo $lap3; ?>">
                            <input type="hidden" id="al_4" value="<?php echo $lap4; ?>">
                            <input type="hidden" id="al_5" value="<?php echo $lap5; ?>">
                            <input type="hidden" id="al_6" value="<?php echo $lap6; ?>">
                            <input type="hidden" id="al_7" value="<?php echo $lap7; ?>">
                            <input type="hidden" id="al_8" value="<?php echo $lap8; ?>">
                            <input type="hidden" id="al_9" value="<?php echo $lap9; ?>">
                            <input type="hidden" id="al_10" value="<?php echo $lap10; ?>">
                            <input type="hidden" id="al_11" value="<?php echo $lap11; ?>">
                            <input type="hidden" id="jum5" value="<?php echo $jum; ?>">
                            <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap1 = "Rp " . number_format($lap1,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap2 = "Rp " . number_format($lap2,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap3 = "Rp " . number_format($lap3,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap4 = "Rp " . number_format($lap4,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap5 = "Rp " . number_format($lap5,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap6 = "Rp " . number_format($lap6,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap7 = "Rp " . number_format($lap7,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap8 = "Rp " . number_format($lap8,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap9 = "Rp " . number_format($lap9,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap10 = "Rp " . number_format($lap10,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap11 = "Rp " . number_format($lap11,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $jml; ?></font></td>
                            <?php 
                          }else{ 
                            ?>
                            <input type="hidden" id="al_1" value="<?php echo $lap1; ?>">
                            <input type="hidden" id="al_2" value="<?php echo $lap2; ?>">
                            <input type="hidden" id="al_3" value="<?php echo $lap3; ?>">
                            <input type="hidden" id="al_4" value="<?php echo $lap4; ?>">
                            <input type="hidden" id="al_5" value="<?php echo $lap5; ?>">
                            <input type="hidden" id="al_6" value="<?php echo $lap6; ?>">
                            <input type="hidden" id="al_7" value="<?php echo $lap7; ?>">
                            <input type="hidden" id="al_8" value="<?php echo $lap8; ?>">
                            <input type="hidden" id="al_9" value="<?php echo $lap9; ?>">
                            <input type="hidden" id="al_10" value="<?php echo $lap10; ?>">
                            <input type="hidden" id="al_11" value="<?php echo $lap11; ?>">
                            <input type="hidden" id="jum5" value="<?php echo $jum; ?>">
                            <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap1 = "Rp " . number_format($lap1,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap2 = "Rp " . number_format($lap2,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap3 = "Rp " . number_format($lap3,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap4 = "Rp " . number_format($lap4,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap5 = "Rp " . number_format($lap5,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap6 = "Rp " . number_format($lap6,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap7 = "Rp " . number_format($lap7,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap8 = "Rp " . number_format($lap8,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap9 = "Rp " . number_format($lap9,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap10 = "Rp " . number_format($lap10,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $lap11 = "Rp " . number_format($lap11,0,',','.'); ?></font></td>
                            <td class="tengah"><font size="1"><?php echo $jml; ?></font></td>
                            <?php
                          }
                        } 
                      }
                    }
                  }
                } 
                ?>
              </tr>
              <tr>
                <td class="tengah"><font size="1">Gaji Tukang Masak</font></td>
                <?php if(!empty($get_gls)){
                  foreach ($get_gls as $data) {
                    ?>
                    <td class="tengah"><font size="1"><?php echo $data['namauser'] ?></font></td>
                    <?php
                  }
                }else{
                  ?>
                  <td class="tengah"><font size="1">#</font></td>
                  <?php
                } 
                ?>
                <?php if(!empty($get_omzet) && !empty($get_jml_lap) && !empty($get_gaji_tm)){
                             //load data user
                  $jum=0;
                  $no=1;
                  $total=0;
                  $tl1 = 0;
                  $tl2 = 0;
                  $tl3 = 0;
                  $tl4 = 0;
                  $tl5 = 0;
                  $tl6 = 0;
                  $tl7 = 0;
                  $tl8 = 0;
                  $tl9 = 0;
                  $tl10 = 0;
                  $tl11 = 0;

                  foreach ($get_omzet as $data){
                    foreach ($get_jml_lap as $data_jml){
                      foreach ($get_gaji_tm as $data_gaji_tm){

                        $tgl1 = date_create($data['tanggal_awal']);
                        $tgl2 = date_create($data['tanggal_akhir']);
                        $tanggal_awal = date_format($tgl1, 'd-m-Y');
                        $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                        $bln = $data['bulan'];
                        $mg = $data['minggu'];

                        $jml_lap = $data_jml['jumlah'];
                              //$gaji_tm = $data_gaji_tm['gaji']*7;
                        $gaji_tm = $data_gaji_tm['gaji'];
                        $pembagian = $gaji_tm / $jml_lap;
                        $hasil = 0;
                        $lap = 0;
                        ?>
                        <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                        <?php
                        for($i=1;$i<=$jml_lap;$i++){
                          $lap = $pembagian;
                          $hasil += $lap;
                          ?>
                          <td class="tengah"><font size="1"><?php echo $lap = "Rp " . number_format($lap,0,',','.'); ?></font></td>
                          <?php  
                        }
                        ?>
                        <?php if($jml_lap==11){?>
                          <input type="hidden" id="tm" value="<?php echo $pembagian; ?>">
                          <input type="hidden" id="jum6" value="<?php echo $hasil; ?>">
                          <td class="tengah"><font size="1"><?php echo $hasil = "Rp " . number_format($hasil,0,',','.'); ?></font></td>
                        <?php }else{ ?>
                          <input type="hidden" id="tm" value="0">
                          <?php 
                          $id = 12-$jml_lap;
                          for($i=1;$i<$id;$i++){
                            $value = 0;
                            ?>
                            <td class="tengah"><font size="1"><?php echo $value = "Rp " . number_format($value,0,',','.'); ?></font></td>
                            <?php
                          }
                          ?>
                          <input type="hidden" id="jum6" value="<?php echo $hasil; ?>">
                          <td class="tengah"><font size="1"><?php echo $hasil = "Rp " . number_format($hasil,0,',','.'); ?></font></td>
                          <?php 
                        } 
                      }
                    }
                  }
                }else{ 
                  ?>
                  <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                  <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                  <td colspan="12" class="tengah"><font size="2">Setting Jumlah Lapangan Belum Dilakukan atau Setting Gaji Tukang Masak Belum Dilakukan </font></td>
                <?php } ?>
              </tr>
              <tr>
                <td class="tengah"><font size="1">By Operasional</font></td>
                <?php if(!empty($get_gls)){
                  foreach ($get_gls as $data) {
                    ?>
                    <td class="tengah"><font size="1"><?php echo $data['namauser'] ?></font></td>
                    <?php
                  }
                }else{
                  ?>
                  <td class="tengah"><font size="1">#</font></td>
                  <?php
                } 
                ?>
                <?php if(!empty($get_omzet) && !empty($get_jml_lap) && !empty($get_bop)){
                             //load data user
                  $jum=0;
                  $no=1;
                  $total=0;
                  $tl1 = 0;
                  $tl2 = 0;
                  $tl3 = 0;
                  $tl4 = 0;
                  $tl5 = 0;
                  $tl6 = 0;
                  $tl7 = 0;
                  $tl8 = 0;
                  $tl9 = 0;
                  $tl10 = 0;
                  $tl11 = 0;

                  foreach ($get_omzet as $data){
                    foreach ($get_jml_lap as $data_jml){
                      foreach ($get_bop as $data_bop){

                        $tgl1 = date_create($data['tanggal_awal']);
                        $tgl2 = date_create($data['tanggal_akhir']);
                        $tanggal_awal = date_format($tgl1, 'd-m-Y');
                        $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                        $bln = $data['bulan'];
                        $mg = $data['minggu'];

                        $jml_lap = $data_jml['jumlah'];
                        $bop = $data_bop['biaya_op'];
                        $pembagian = $bop / $jml_lap;
                        $hasil = 0;
                        $lap = 0;
                        ?>
                        <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                        <?php
                        for($i=1;$i<=$jml_lap;$i++){
                          $lap = $pembagian;
                          $hasil += $lap;
                          ?>
                          <td class="tengah"><font size="1"><?php echo $lap = "Rp " . number_format($lap,0,',','.'); ?></font></td>
                          <?php  
                        }
                        ?>
                        <?php if($jml_lap==11){?>
                          <input type="hidden" id="bop" value="<?php echo $pembagian; ?>">
                          <input type="hidden" id="jum7" value="<?php echo $hasil; ?>">
                          <td class="tengah"><font size="1"><?php echo $hasil = "Rp " . number_format($hasil,0,',','.'); ?></font></td>
                        <?php }else{ ?>
                          <input type="hidden" id="bop" value="0">
                          <?php 
                          $id = 12-$jml_lap;
                          for($i=1;$i<$id;$i++){
                            $value = 0;
                            ?>
                            <td class="tengah"><font size="1"><?php echo $value = "Rp " . number_format($value,0,',','.'); ?></font></td>
                            <?php
                          }
                          ?>
                          <input type="hidden" id="jum7" value="<?php echo $hasil; ?>">
                          <td class="tengah"><font size="1"><?php echo $hasil = "Rp " . number_format($hasil,0,',','.'); ?></font></td>
                          <?php 
                        } 
                      }
                    }
                  }
                }else{ 
                  ?>
                  <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                  <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                  <td colspan="12" class="tengah"><font size="2">Setting Jumlah Lapangan Belum Dilakukan atau Setting Besaran Biaya Operasional Belum Dilakukan  </font></td>
                <?php } ?>
              </tr>
              <tr>
                <td class="tengah"><font size="1">Ongkos Belanja</font></td>
                <?php if(!empty($get_gls)){
                  foreach ($get_gls as $data) {
                    ?>
                    <td class="tengah"><font size="1"><?php echo $data['namauser'] ?></font></td>
                    <?php
                  }
                }else{
                  ?>
                  <td class="tengah"><font size="1">#</font></td>
                  <?php
                } 
                ?>
                <?php if(!empty($get_omzet) && !empty($get_jml_lap) && !empty($get_ob)){
                             //load data user
                  $jum=0;
                  $no=1;
                  $total=0;
                  $tl1 = 0;
                  $tl2 = 0;
                  $tl3 = 0;
                  $tl4 = 0;
                  $tl5 = 0;
                  $tl6 = 0;
                  $tl7 = 0;
                  $tl8 = 0;
                  $tl9 = 0;
                  $tl10 = 0;
                  $tl11 = 0;

                  foreach ($get_omzet as $data){
                    foreach ($get_jml_lap as $data_jml){
                      foreach ($get_ob as $data_ob){

                        $tgl1 = date_create($data['tanggal_awal']);
                        $tgl2 = date_create($data['tanggal_akhir']);
                        $tanggal_awal = date_format($tgl1, 'd-m-Y');
                        $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                        $bln = $data['bulan'];
                        $mg = $data['minggu'];

                        $jml_lap = $data_jml['jumlah'];
                              //$ob = $data_ob['ongkos']*7;
                        $ob = $data_ob['ongkos'];
                        $pembagian = $ob / $jml_lap;
                        $hasil = 0;
                        $lap = 0;
                        ?>
                        <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                        <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                        <?php
                        for($i=1;$i<=$jml_lap;$i++){
                          $lap = $pembagian;
                          $hasil += $lap;
                          ?>
                          <td class="tengah"><font size="1"><?php echo $lap = "Rp " . number_format($lap,0,',','.'); ?></font></td>
                          <?php  
                        }
                        ?>
                        <?php if($jml_lap==11){?>
                          <input type="hidden" id="ob" value="<?php echo $pembagian; ?>">
                          <input type="hidden" id="jum8" value="<?php echo $hasil; ?>">
                          <td class="tengah"><font size="1"><?php echo $hasil = "Rp " . number_format($hasil,0,',','.'); ?></font></td>
                        <?php }else{ ?>
                          <input type="hidden" id="ob" value="0">
                          <?php 
                          $id = 12-$jml_lap;
                          for($i=1;$i<$id;$i++){
                            $value = 0;
                            ?>
                            <td class="tengah"><font size="1"><?php echo $value = "Rp " . number_format($value,0,',','.'); ?></font></td>
                            <?php
                          }
                          ?>
                          <input type="hidden" id="jum8" value="<?php echo $hasil; ?>">
                          <td class="tengah"><font size="1"><?php echo $hasil = "Rp " . number_format($hasil,0,',','.'); ?></font></td>
                          <?php 
                        } 
                      }
                    }
                  }
                }else{ 
                  ?>
                  <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                  <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                  <td colspan="12" class="tengah"><font size="2">Setting Jumlah Lapangan Belum Dilakukan atau Setting Besaran Ongkos Belanja Belum Dilakukan </font></td>
                <?php } ?>
              </tr>
              <input type="hidden" id="a_1">
              <input type="hidden" id="a_2">
              <input type="hidden" id="a_3">
              <input type="hidden" id="a_4">
              <input type="hidden" id="a_5">
              <input type="hidden" id="a_6">
              <input type="hidden" id="a_7">
              <input type="hidden" id="a_8">
              <input type="hidden" id="a_9">
              <input type="hidden" id="a_10">
              <input type="hidden" id="a_11">

              <?php 
              $v_1 = $this->input->post('v_1');
              $v_2 = $this->input->post('v_2');
              $v_3 = $this->input->post('v_3');
              $v_4 = $this->input->post('v_4');
              $v_5 = $this->input->post('v_5');
              $v_6 = $this->input->post('v_6');
              $v_7 = $this->input->post('v_7');
              $v_8 = $this->input->post('v_8');
              $v_9 = $this->input->post('v_9');
              $v_10 = $this->input->post('v_10');
              $v_11 = $this->input->post('v_11');

              $jml_Total = $v_1+$v_2+$v_3+$v_4+$v_5+$v_6+$v_7+$v_8+$v_9+$v_10+$v_11;
              $jml = "Rp " . number_format($jml_Total,0,',','.');

              ?>

              <tr>
                <td colspan="4" class="tengah"><font size="2"><b>Anggaran Belanja</font></td>
                  <td class="tengah"><font size="1" id="anggaran_1"><b><?php echo $v_1 = "Rp " . number_format($v_1,0,',','.'); ?></b></font></td>
                  <td class="tengah"><font size="1" id="anggaran_2"><b><?php echo $v_2 = "Rp " . number_format($v_2,0,',','.'); ?></b></font></td>
                  <td class="tengah"><font size="1" id="anggaran_3"><b><?php echo $v_3 = "Rp " . number_format($v_3,0,',','.'); ?></b></font></td>
                  <td class="tengah"><font size="1" id="anggaran_4"><b><?php echo $v_4 = "Rp " . number_format($v_4,0,',','.'); ?></b></font></td>
                  <td class="tengah"><font size="1" id="anggaran_5"><b><?php echo $v_5 = "Rp " . number_format($v_5,0,',','.'); ?></b></font></td>
                  <td class="tengah"><font size="1" id="anggaran_6"><b><?php echo $v_6 = "Rp " . number_format($v_6,0,',','.'); ?></b></font></td>
                  <td class="tengah"><font size="1" id="anggaran_7"><b><?php echo $v_7 = "Rp " . number_format($v_7,0,',','.'); ?></b></font></td>
                  <td class="tengah"><font size="1" id="anggaran_8"><b><?php echo $v_8 = "Rp " . number_format($v_8,0,',','.'); ?></b></font></td>
                  <td class="tengah"><font size="1" id="anggaran_9"><b><?php echo $v_9 = "Rp " . number_format($v_9,0,',','.'); ?></b></font></td>
                  <td class="tengah"><font size="1" id="anggaran_10"><b><?php echo $v_10 = "Rp " . number_format($v_10,0,',','.'); ?></b></font></td>
                  <td class="tengah"><font size="1" id="anggaran_11"><b><?php echo $v_11 = "Rp " . number_format($v_11,0,',','.'); ?></b></font></td>
                  <td class="tengah"><font size="1" id="jumlahTotal"><b><?php echo $jml; ?></b></font></td>
                </tr>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</tbody>
</table>
</div>
<?php 
if($id_set=='reset'){
  echo "<p>Seluruh Data (All Time)</p>";
}else{
  ?>
  <p><?php echo 'Data Pada Bulan : '.$data['bulan'].' - Minggu ke - '.$data['minggu'].' ( '.$tanggal_awal.' s/d '.$tanggal_akhir.' )';?></p>
  <?php
}
?>
</div>
</body></html>

<?php
$html = ob_get_clean();

$nama_dokumen='Export_Data_Kontribusi_Gaji_&_By_Operasional_C-'.$id_cabang.'('.$tanggal_awal.'s_d'.$tanggal_akhir.')'; 
require_once(APPPATH . 'third_party/mpdf60/mpdf.php');
    $mpdf=new mPDF('utf-8', 'F4-L'); // Create new mPDF Document
    $mpdf->WriteHTML(utf8_encode($html));
    $mpdf->Output($nama_dokumen.".pdf" ,'I');
  }
}

/*============================================CASHBON========================================*/
function e_cashbon(){
  error_reporting(0);
  $this->session->set_userdata(array('location' => 'Proses Export Data Kasbon'));
  $data['sess_location'] = $this->session->userdata('location');
  $data['session'] = $this->session->all_userdata();
  $username = $this->session->userdata('username');
  $id_cabang = $this->session->userdata('id_cabang');
  $id_user = $this->session->userdata('id_user');
  $id_set = $this->input->post('id_set');
    //get all data ON Operator
  $get_kasbon = $this->m_cashbon->get_data_pencarian($id_user,$id_set);
  $session = $this->session->all_userdata();
  $data['namalengkap'] =strtoupper($this->session->userdata('namauser'));
  $data['namadepan'] = explode(' ',$this->session->userdata('namauser'));
  $data['firstname'] = strtoupper($data['namadepan'][0]);

  if(empty($get_kasbon)){
    $this->session->set_flashdata('gagal_cetak','Data yang anda inginkan belum terdapat di database. Export Tidak Berhasil');
    redirect('cashbon');
  }
  else{

    ?>
    <?php ob_start();?>

    <html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" >
      <style>
        .tengah{
          text-align:center;
        }
        .kiri{
          text-align:left;
        }
        .kanan{
          text-align:right;
        }
      </style>
    </head><body>
      <!--CONTOH Code START-->
      <table border='0' align='LEFT'>
        <tr>
          <th>
            <img src="<?php echo base_url('build/img/xyz_2.png');?>"  align="left" width='165' height='150px' >
          </th>
          <th width="20">
          </th>
          <th width="2339px" align="left">
            <?php $value = date('Y-m-d');
            $tgl = date_create($value);
            $hasil = date_format($tgl,'d-m-Y');?>  
            <h1> <left> EXPORT LAPORAN <br>CV. XYZ<br> </left><center> <?php echo "Tanggal Diterbitkan : $hasil"; ?> </center></h1>
          </th>
        </tr>
      </table>
      <hr style="height:4px;" />
      <br>
      <h4 class="tengah"><font face="arial"><strong><u>LAPORAN CASHBON SALES & LEADER</u></strong></font></h4>
      <br>
      <div class="x_content">
        <div class="table-responsive">
          <table border="1" class="table">
            <thead>
              <tr>
                <th rowspan="2" class="tengah" width="3%"><font size="3">No</font></th>
                <th rowspan="2" class="tengah" width="5%"><font size="3">Bln</font></th>
                <th rowspan="2" class="tengah" width="3%"><font size="3">Mg</font></th>
                <th rowspan="2" class="tengah" width="3%"><font size="3">Cab</font></th>
                <th rowspan="2" class="tengah" width="3%"><font size="3">Hari</font></th>
                <th rowspan="2" class="tengah" width="3%"><font size="3">Tgl</font></th>
                <th colspan="17" class="tengah"><font size="3">Jabatan/Lapangan</font></th>
                <th rowspan="2" class="tengah" width="6%"><font size="3">Jml</font></th>
              </tr>
              <tr>
                <th rowspan="1" class="tengah" width="5%"><font size="3">1</font></th>
                <th rowspan="1" class="tengah" width="5%"><font size="3">2</font></th>
                <th rowspan="1" class="tengah" width="5%"><font size="3">3</font></th>
                <th rowspan="1" class="tengah" width="5%"><font size="3">4</font></th>
                <th rowspan="1" class="tengah" width="5%"><font size="3">5</font></th>
                <th rowspan="1" class="tengah" width="5%"><font size="3">6</font></th>
                <th rowspan="1" class="tengah" width="5%"><font size="3">7</font></th>
                <th rowspan="1" class="tengah" width="5%"><font size="3">8</font></th>
                <th rowspan="1" class="tengah" width="5%"><font size="3">9</font></th>
                <th rowspan="1" class="tengah" width="5%"><font size="3">10</font></th>
                <th rowspan="1" class="tengah" width="5%"><font size="3">11</font></th>
                <th rowspan="1" class="tengah" width="5%"><font size="3">L1</font></th>
                <th rowspan="1" class="tengah" width="5%"><font size="3">L2</font></th>
                <th rowspan="1" class="tengah" width="5%"><font size="3">ATL</font></th>
                <th rowspan="1" class="tengah" width="5%"><font size="3">GL</font></th>
                <th rowspan="1" class="tengah" width="5%"><font size="3">TM</font></th>
                <th rowspan="1" class="tengah" width="5%"><font size="3">TR</font></th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $v = isset($get_kasbon[0]['tanggal_awal'])?$get_kasbon[0]['tanggal_awal']:'';
              $tgl_a = date_create($v);
              $tahun = date_format($tgl_a,'Y');
              ?>
              <tr>
                <th colspan="24" class="tengah"></font>Minggu ke - <?php echo isset($get_kasbon[0]['minggu'])?$get_kasbon[0]['minggu']:'';?> (<?php echo isset($get_kasbon[0]['bulan'])?$get_kasbon[0]['bulan']:'';?> - <?php echo $tahun;?>)</th></th>
              </tr>

              <?php
                  //jika data user tidak kosong maka jalankan perintah dibawah ini
              if(!empty($get_kasbon))
              {
                    //load data user

                $jum=0;
                $no=1;
                $total=0;
                $tl1 = 0;
                $tl2 = 0;
                $tl3 = 0;
                $tl4 = 0;
                $tl5 = 0;
                $tl6 = 0;
                $tl7 = 0;
                $tl8 = 0;
                $tl9 = 0;
                $tl10 = 0;
                $tl11 = 0;
                $tl12 = 0;
                $tl13 = 0;
                $tl14 = 0;
                $tl15 = 0;
                $tl16 = 0;
                $tl17 = 0;

                foreach ($get_kasbon as $data) {
                  $tgl1 = date_create($data['tanggal_awal']);
                  $tgl2 = date_create($data['tanggal_akhir']);
                  $tanggal_awal = date_format($tgl1, 'd-m-Y');
                  $tanggal_akhir = date_format($tgl2, 'd-m-Y');

                  $bln = $data['bulan'];
                  $mg = $data['minggu'];
                  $cab = $data['id_cabutan'];
                  $tgl = date_create($data['tanggal']);
                  $tanggal = date_format($tgl, "d-m-Y");
                  $hari = $data['hari'];
                  $lap1 = $data['kasbon_lap_1'];
                  $lap2 = $data['kasbon_lap_2'];
                  $lap3 = $data['kasbon_lap_3'];
                  $lap4 = $data['kasbon_lap_4'];
                  $lap5 = $data['kasbon_lap_5'];
                  $lap6 = $data['kasbon_lap_6'];
                  $lap7 = $data['kasbon_lap_7'];
                  $lap8 = $data['kasbon_lap_8'];
                  $lap9 = $data['kasbon_lap_9'];
                  $lap10 = $data['kasbon_lap_10'];
                  $lap11 = $data['kasbon_lap_11'];
                  $L1 = $data['kasbon_leader_1'];
                  $L2 = $data['kasbon_leader_2'];
                  $ATL = $data['kasbon_asis_tl'];
                  $GL = $data['kasbon_gl'];
                  $TM = $data['kasbon_t_masak'];
                  $TR = $data['kasbon_training'];
                  $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11+$L1+$L2+$ATL+$GL+$TM+$TR;
                  $jml = "Rp " . number_format($jum,0,',','.');
                  $total += $jum;
                  $tl1 += $lap1;
                  $tl2 += $lap2;
                  $tl3 += $lap3;
                  $tl4 += $lap4;
                  $tl5 += $lap5;
                  $tl6 += $lap6;
                  $tl7 += $lap7;
                  $tl8 += $lap8;
                  $tl9 += $lap9;
                  $tl10 += $lap10;
                  $tl11 += $lap11;

                  $tl12 += $L1;
                  $tl13 += $L2;
                  $tl14 += $ATL;
                  $tl15 += $GL;
                  $tl16 += $TM;
                  $tl17 += $TR;

                  ?>

                  <tr>
                    <td class="tengah"><font size="3"><?php echo $no; ?></font></td>
                    <td class="tengah"><font size="3"><?php echo $bln; ?></font></td>
                    <td class="tengah"><font size="3"><?php echo $mg; ?></font></td>
                    <td class="tengah"><font size="3"><?php echo $cab; ?></font></td>
                    <td class="tengah"><font size="3"><?php echo $hari; ?></font></td>
                    <td class="tengah"><font size="3"><?php echo $tanggal; ?></font></td>                      
                    <td class="tengah"><font size="3"> <?php echo $lap1 = "Rp " . number_format($lap1,0,',','.'); ?></font></td> 
                    <td class="tengah"><font size="3"> <?php echo $lap2 = "Rp " . number_format($lap2,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="3"> <?php echo $lap3 = "Rp " . number_format($lap3,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="3"> <?php echo $lap4 = "Rp " . number_format($lap4,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="3"> <?php echo $lap5 = "Rp " . number_format($lap5,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="3"> <?php echo $lap6 = "Rp " . number_format($lap6,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="3"> <?php echo $lap7 = "Rp " . number_format($lap7,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="3"> <?php echo $lap8 = "Rp " . number_format($lap8,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="3"> <?php echo $lap9 = "Rp " . number_format($lap9,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="3"> <?php echo $lap10 = "Rp " . number_format($lap10,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="3"> <?php echo $lap11 = "Rp " . number_format($lap11,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="3"> <?php echo $L1 = "Rp " . number_format($L1,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="3"> <?php echo $L2 = "Rp " . number_format($L2,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="3"> <?php echo $ATL = "Rp " . number_format($ATL,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="3"> <?php echo $GL = "Rp " . number_format($GL,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="3"> <?php echo $TM = "Rp " . number_format($TM,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="3"> <?php echo $TR = "Rp " . number_format($TR,0,',','.'); ?></font></td>
                    <td class="tengah"><font size="3"> <?php echo $jml; ?></font></td>
                  </tr>
                  <?php
                  $no++;
                }
              }else{
               ?>
               <table>
                <tr>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-close"></i> Belum terdapat data apapun pada database.
                  </div>
                </tr>
              </table>
              <?php
            }
            ?>
          </tbody>
          <?php if(!empty($get_kasbon)){?>
            <tfoot>
              <tr>                

                <th colspan="6" class="tengah">Total Jumlah</th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl1 = "Rp " . number_format($tl1,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl2 = "Rp " . number_format($tl2,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl3 = "Rp " . number_format($tl3,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl4 = "Rp " . number_format($tl4,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl5 = "Rp " . number_format($tl5,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl6 = "Rp " . number_format($tl6,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl7 = "Rp " . number_format($tl7,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl8 = "Rp " . number_format($tl8,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl9 = "Rp " . number_format($tl9,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl10 = "Rp " . number_format($tl10,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl11 = "Rp " . number_format($tl11,0,',','.'); ?></strong></font></th>

                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl12 = "Rp " . number_format($tl12,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl13 = "Rp " . number_format($tl13,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl14 = "Rp " . number_format($tl14,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl15 = "Rp " . number_format($tl15,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl16 = "Rp " . number_format($tl16,0,',','.'); ?></strong></font></th>
                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $tl17 = "Rp " . number_format($tl17,0,',','.'); ?></strong></font></th>

                <th colspan="1" class="tengah"><font size="2"><strong><?php echo $total = "Rp " . number_format($total,0,',','.'); ?></strong></font></th> 

              </tr>
            </tfoot>
          <?php } ?>
        </table>
      </div>
      <?php 
      if($id_set=='reset'){
        echo "<p>Seluruh Data (All Time)</p><br><br>";
        echo "<p>Keterangan : </p><br>";
        echo "<p>L1 (Leader 1)<br>L2 (Leader 2)<br>ATL (Asis Team Leader)<br>GL (Grouf Leader)<br>TM (Tukang Masak)<br>TR (Training)</p><br>";

      }else{
        ?>
        <p><?php echo 'Data Pada Bulan : '.$data['bulan'].' - Minggu ke - '.$data['minggu'].' ( '.$tanggal_awal.' s/d '.$tanggal_akhir.' )';?></p><br><br>
        <?php
        echo "<p>Keterangan : </p>";
        echo "<p>L1 (Leader 1)<br>L2 (Leader 2)<br>ATL (Asis Team Leader)<br>GL (Grouf Leader)<br>TM (Tukang Masak)<br>TR (Training)</p><br>";
      }
      ?>
    </div>

  </body></html>

  <?php
  $html = ob_get_clean();
  $nama_dokumen='Export_Data_Cashbon_C-'.$id_cabang.'('.$tanggal_awal.'s_d'.$tanggal_akhir.')'; 
  require_once(APPPATH . 'third_party/mpdf60/mpdf.php');
    $mpdf=new mPDF('utf-8', 'F4-L'); // Create new mPDF Document
    $mpdf->WriteHTML(utf8_encode($html));
    $mpdf->Output($nama_dokumen.".pdf" ,'D');
    exit;
  }
}

#ujung class
}
?>

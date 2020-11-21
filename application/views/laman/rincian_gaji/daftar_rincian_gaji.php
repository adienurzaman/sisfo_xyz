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

<?php
if($this->session->flashdata('simpan_berhasil') == TRUE){
?>
<body onload="new PNotify({
                                  title:'Data Berhasil ditambahkan',
                                  type: 'success',
                                  text: '<?php echo $this->session->flashdata('simpan_berhasil');?>',
                                  nonblock: {
                                      nonblock: true
                                  },
                                  styling: 'bootstrap3',
                                  addclass: 'dark'
                              });">
</body>
<?php
}elseif($this->session->flashdata('simpan_gagal') == TRUE){
?>
<body onload="new PNotify({
                                  title:'Data Gagal ditambahkan',
                                  type: 'error',
                                  text: '<?php echo $this->session->flashdata('simpan_gagal');?>',
                                  nonblock: {
                                      nonblock: true
                                  },
                                  styling: 'bootstrap3',
                                  addclass: 'dark'
                              });">
</body>
<?php
}elseif($this->session->flashdata('edit_berhasil') == TRUE){
?>
<body onload="new PNotify({
                                  title:'Data Berhasil diperbaharui',
                                  type: 'success',
                                  text: '<?php echo $this->session->flashdata('edit_berhasil');?>',
                                  nonblock: {
                                      nonblock: true
                                  },
                                  styling: 'bootstrap3',
                                  addclass: 'dark'
                              });">
</body>
<?php
}elseif($this->session->flashdata('edit_gagal') == TRUE){
?>
<body onload="new PNotify({
                                  title:'Data Gagal diperbaharui',
                                  type: 'error',
                                  text: '<?php echo $this->session->flashdata('edit_gagal');?>',
                                  nonblock: {
                                      nonblock: true
                                  },
                                  styling: 'bootstrap3',
                                  addclass: 'dark'
                              });">
</body>
<?php
}elseif($this->session->flashdata('hapus_berhasil') == TRUE){
?>
<body onload="new PNotify({
                                  title:'Delete Berhasil',
                                  type: 'success',
                                  text: '<?php echo $this->session->flashdata('hapus_berhasil');?>',
                                  nonblock: {
                                      nonblock: true
                                  },
                                  styling: 'bootstrap3',
                                  addclass: 'dark'
                              });">
</body>
<?php
}elseif($this->session->flashdata('hapus_gagal') == TRUE){
?>
<body onload="new PNotify({
                                  title:'Delete Gagal',
                                  type: 'error',
                                  text: '<?php echo $this->session->flashdata('hapus_gagal');?>',
                                  nonblock: {
                                      nonblock: true
                                  },
                                  styling: 'bootstrap3',
                                  addclass: 'dark'
                              });">
</body>
<?php
}elseif($this->session->flashdata('gagal_cetak') == TRUE){
?>
<body onload="new PNotify({
                                  title:'Export Data Gagal',
                                  type: 'error',
                                  text: '<?php echo $this->session->flashdata('gagal_cetak');?>',
                                  nonblock: {
                                      nonblock: true
                                  },
                                  styling: 'bootstrap3',
                                  addclass: 'dark'
                              });">
</body>
<?php
}
?>

<div class="right_col" role="main">
<!--Content-->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
                  <div class="x_title">
                      <h2><small><span class="fa fa-cog"></span> Halaman <?php echo @$sess_location; ?></small></h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"></i></a></li>
                        <li><a class="collapse-link"></i></a></li>
                        <li><a class="collapse-link"></i></a></li>
                        <li></li>
                     
                        <?php if($session['level_user']=='Admin' OR $session['level_user']=='Operator'){?>
                        <li>
                          <button data-toggle="tooltip" data-placement="left" title="Kembali Ke Welcome Page"  class="btn btn-sm btn-warning" onclick="window.location.href='<?php echo base_url()?>backend/welcome'"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali ke Halaman Utama</button>
                        </li>
                      <?php }?>
                       
                      </ul>
                      <div class="clearfix"></div>
                  </div>
</div>
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small><span class="fa fa-database"></span> Data <?php echo @$sess_location; ?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      
                      <li><a class="collapse-link"></i></a></li>
                      <li><a class="collapse-link"></i></a></li>
                      <li><a class="collapse-link"></i></a></li>
                      <li><a class="collapse-link"></i></a></li>
                      <li>
                      </li>
                      <li>
                        <?php if(($get_omzet[0]['omzet_lap_1']==0)){?>
                          <a>
                            <button type="button" onclick="window.location.href='<?php echo base_url()?>gaji_anggaran'" class="btn btn-sm btn-warning" title="Reset Data"><i class="glyphicon glyphicon-refresh"></i> Reset Data</button>
                          </a>
                        <?php }else{ ?>
                        <a>
                          <button type="button" data-toggle="modal" data-placement="top" data-target="#modal_cari_data" class="btn btn-sm btn-success" title="Cari Data"><i class="glyphicon glyphicon-search"></i> Cari Data</button>
                        </a>
                        <?php } ?>
                      </li>
                      <li>
                        <?php 
                          if(($get_omzet[0]['omzet_lap_1']==0)){
                        ?>
                         <a href="<?php echo site_url('export/e_omzet'); ?>">
                            <button type="button" class="btn btn-sm btn-default" title="Export PDF" target="_blank" disabled=""><i class="glyphicon glyphicon-export"></i> Export PDF</button>
                        </a>
                        <?php }else{ ?>
                        <a>
                            <button type="button" data-toggle="modal" data-placement="top" data-target="#modal_export_data" class="btn btn-sm btn-default" title="Export Data"><i class="glyphicon glyphicon-export"></i> Export PDF</button>
                        </a>
                        <?php } ?>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
<?php 
  if(($get_omzet[0]['omzet_lap_1']==0)){
?>
                  <div class="x_content">
                    <div class="table-responsive">

                    <table class="table table-striped table-hover table-bordered">
                      <thead>
                        <tr>
                          <th rowspan="3" class="tengah" width="100">Jabatan</th>
                          <th rowspan="3" class="tengah" width="100">Nama</th>
                          <th rowspan="3" class="tengah" width="85">Bln</th>
                          <th rowspan="3" class="tengah" width="35">Mg</th>
                          <th colspan="11" class="tengah">Lapangan/Nama</th>
                          <th rowspan="3" class="tengah" width="100">Jumlah</th>
                        </tr>
                        <tr>
                          <th rowspan="1" class="tengah" width="100">1</th>
                          <th rowspan="1" class="tengah" width="100">2</th>
                          <th rowspan="1" class="tengah" width="100">3</th>
                          <th rowspan="1" class="tengah" width="100">4</th>
                          <th rowspan="1" class="tengah" width="100">5</th>
                          <th rowspan="1" class="tengah" width="100">6</th>
                          <th rowspan="1" class="tengah" width="100">7</th>
                          <th rowspan="1" class="tengah" width="100">8</th>
                          <th rowspan="1" class="tengah" width="100">9</th>
                          <th rowspan="1" class="tengah" width="100">10</th>
                          <th rowspan="1" class="tengah" width="100">11</th>
                        </tr>
                        <tr>
                          <?php if(!empty($get_sales)){
                            foreach ($get_sales as $data) {
                              $nama = $data['namauser'];
                          ?>
                          <th rowspan="1" class="tengah" width="100"><font size="1"><?php echo $nama;?></font></th>
                        <?php 
                            }
                          } 
                        ?>
                        </tr>
                        <table>
                          <tr>
                            <div class="alert alert-danger alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <i class="icon fa fa-close"></i> Belum terdapat data apapun pada database.
                            </div>
                          </tr>
                        </table>
<?php }else{ ?>
                  <div class="x_content">
                    <div class="table-responsive">

                    <table class="table table-striped table-hover table-bordered">
                      <thead>
                        <tr>
                          <th rowspan="3" class="tengah" width="100">Jabatan</th>
                          <th rowspan="3" class="tengah" width="100">Nama</th>
                          <th rowspan="3" class="tengah" width="85">Bln</th>
                          <th rowspan="3" class="tengah" width="35">Mg</th>
                          <th colspan="11" class="tengah">Lapangan/Nama</th>
                          <th rowspan="3" class="tengah" width="100">Jumlah</th>
                        </tr>
                        <tr>
                          <th rowspan="1" class="tengah" width="100">1</th>
                          <th rowspan="1" class="tengah" width="100">2</th>
                          <th rowspan="1" class="tengah" width="100">3</th>
                          <th rowspan="1" class="tengah" width="100">4</th>
                          <th rowspan="1" class="tengah" width="100">5</th>
                          <th rowspan="1" class="tengah" width="100">6</th>
                          <th rowspan="1" class="tengah" width="100">7</th>
                          <th rowspan="1" class="tengah" width="100">8</th>
                          <th rowspan="1" class="tengah" width="100">9</th>
                          <th rowspan="1" class="tengah" width="100">10</th>
                          <th rowspan="1" class="tengah" width="100">11</th>
                        </tr>
                        <tr>
                          <?php if(!empty($get_sales)){
                            foreach ($get_sales as $data) {
                              $nama = $data['namauser'];
                          ?>
                          <th rowspan="1" class="tengah" width="100"><font size="1"><?php echo $nama;?></font></th>
                        <?php 
                            }
                          }else{
                        ?>
                        <th rowspan="1" class="tengah" width="100"><font size="1">#</font></th>
                        <?php
                          } 
                        ?>
                        </tr>
                    <?php
                      if($get_id==1){
                    ?>
                        <tr>
                          <th colspan="16" class="tengah">Silahkan klik <a data-toggle="modal" data-placement="top" data-target="#modal_cari_data"><u>DISINI</u></a> atau klik button Cari Data di atas untuk menampilkan Data <?php echo @$sess_location; ?> </th>
                        </tr>
                    <?php 
                      }else{
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
                          <?php if(!empty($get_omzet) && !empty($get_persen)){
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
                              $id = $data_persen['id_set_penggajian'];
                              $gs = $data_persen['gaji_sales']; 
                              $tl1 = $data_persen['gaji_team_leader_1'];
                              $tl2 = $data_persen['gaji_team_leader_2']; 
                              $gl = $data_persen['gaji_grouf_leader'];

                              $bln = $data['bulan'];
                              $mg = $data['minggu'];
                              $tgl = date_create($data['tanggal']);
                              $tanggal = date_format($tgl, "d-m-Y");
                              $hari = $data['hari'];
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
                         <?php if(!empty($get_omzet) && !empty($get_persen)){
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
                              $id = $data_persen['id_set_penggajian'];
                              $gs = $data_persen['gaji_sales']; 
                              $tl1 = $data_persen['gaji_team_leader_1'];
                              $tl2 = $data_persen['gaji_team_leader_2']; 
                              $gl = $data_persen['gaji_grouf_leader'];

                              $bln = $data['bulan'];
                              $mg = $data['minggu'];
                              $tgl = date_create($data['tanggal']);
                              $tanggal = date_format($tgl, "d-m-Y");
                              $hari = $data['hari'];
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
                          <?php if(!empty($get_omzet) && !empty($get_persen)){
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
                              $id = $data_persen['id_set_penggajian'];
                              $gs = $data_persen['gaji_sales']; 
                              $tl1 = $data_persen['gaji_team_leader_1'];
                              $tl2 = $data_persen['gaji_team_leader_2']; 
                              $gl = $data_persen['gaji_grouf_leader'];

                              $bln = $data['bulan'];
                              $mg = $data['minggu'];
                              $tgl = date_create($data['tanggal']);
                              $tanggal = date_format($tgl, "d-m-Y");
                              $hari = $data['hari'];
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
                          <?php if(!empty($get_omzet) && !empty($get_persen)){
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
                              $id = $data_persen['id_set_penggajian'];
                              $gs = $data_persen['gaji_sales']; 
                              $tl1 = $data_persen['gaji_team_leader_1'];
                              $tl2 = $data_persen['gaji_team_leader_2']; 
                              $gl = $data_persen['gaji_grouf_leader'];

                              $bln = $data['bulan'];
                              $mg = $data['minggu'];
                              $tgl = date_create($data['tanggal']);
                              $tanggal = date_format($tgl, "d-m-Y");
                              $hari = $data['hari'];
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
                          <?php if(!empty($get_omzet) && !empty($get_gaji_al)){
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
                              $id = $data_gaji_al['id_set_gaji_al'];
                              $status = $data_gaji_al['status']; 

                              if($status == 'Training'){
                                $v=0;
                                $gaji = 1000000;
                                $hasil = "Rp " . number_format($gaji,0,',','.');
                              }elseif ($status == 'Pasca Training') {
                                $v=0;
                                $gaji = 1250000;
                                $hasil = "Rp " . number_format($gaji,0,',','.');
                              }else{
                                $v=1;
                                $gaji = 5/100;
                              }
                              $bln = $data['bulan'];
                              $mg = $data['minggu'];
                              
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
                              $jum = $lap1+$lap2+$lap3+$lap4+$lap5+$lap6+$lap7+$lap8+$lap9+$lap10+$lap11;
                              $jml = "Rp " . number_format($jum,0,',','.');
                              $total += $jum;
        
                              if($mg != $data_gaji_al['minggu']){
                              ?>
                              <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                              <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                              <td colspan="12" class="tengah"><font size="2">Gaji Asis Leader Belum Keluar</font></td>
                              <?php
                              }else{
                                if($v == 1){
                              ?>
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
                              <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                              <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                              <td colspan="12" class="tengah"><font size="2"><?php echo $hasil;?></font></td>
                              <?php
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
                          <?php if(!empty($get_omzet) && !empty($get_persen)){
                             //load data user
                              $jum=0;
                              $no=1;
                   
                            foreach ($get_omzet as $data){
                              foreach ($get_persen as $data_persen){
                              $id = $data_persen['id_set_penggajian'];
                              $gs = $data_persen['gaji_sales']; 
                              $tl1 = $data_persen['gaji_team_leader_1'];
                              $tl2 = $data_persen['gaji_team_leader_2']; 
                              $gl = $data_persen['gaji_grouf_leader'];

                              $bln = $data['bulan'];
                              $mg = $data['minggu'];
                              $tgl = date_create($data['tanggal']);
                              $tanggal = date_format($tgl, "d-m-Y");
                              $hari = $data['hari'];
                              $gaji = 32000*7;
                              
                              $jml = "Rp " . number_format($gaji,0,',','.');
                          ?>
                          <td class="tengah"><font size="1"><?php echo $bln; ?></font></td>
                          <td class="tengah"><font size="1"><?php echo $mg; ?></font></td>
                          <td colspan="12" class="tengah"><font size="2"><?php echo $jml;?> (1 Minggu)</font></td>

                        <?php 
                            }
                          }
                        } 
                        ?>
                        </tr>
                        <tr>
                          <td class="tengah"><font size="1">By Operasional</font></td>
                          <?php if(!empty($get_glop)){
                            foreach ($get_glop as $data) {
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
                          <?php if(!empty($get_omzet) && !empty($get_persen)){
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
                              $id = $data_persen['id_set_penggajian'];
                              $gs = $data_persen['gaji_sales']; 
                              $tl1 = $data_persen['gaji_team_leader_1'];
                              $tl2 = $data_persen['gaji_team_leader_2']; 
                              $gl = $data_persen['gaji_grouf_leader'];

                              $bln = $data['bulan'];
                              $mg = $data['minggu'];
                           
                              $lap1 = 20000;
                              $lap2 = 20000;
                              $lap3 = 20000;
                              $lap4 = 20000;
                              $lap5 = 20000;
                              $lap6 = 20000;
                              $lap7 = 20000;
                              $lap8 = 20000;
                              $lap9 = 20000;
                              $lap10 = 20000;
                              $lap11 = 20000;
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
                        ?>
                        </tr>
                      <?php } ?>
                  </tbody>
                </table>

                  </div>
                </div>
              </div>
            </div>
          </div>
              <div class="clearfix"></div>

<?php } ?>

              <!-- Modal Cari Data Omzet -->
            <div class="modal fade" id="modal_cari_data" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">

                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Cari Data Gaji</h4>
                  </div>
                  <div class="modal-body">
                    <p>

                      <form id="form-search-omzet" method="post" action="<?php echo site_url('gaji_anggaran');?>">

                      <label for="id_set">ID Pencarian :</label>
                      <select id="id_set" class="form-control" name="id_set" required oninvalid="this.setCustomValidity('Kolom ID Input harus diisi')" oninput="setCustomValidity('')">
                        <?php 
                        if(!empty($get_set_input)){

                        ?>
                            <!-- <option value="reset">Seluruh Data (ALL TIME)</option> -->
                        <?php
                            foreach ($get_set_input as $data_tambah) {
                            $tgl1 = date_create($data_tambah['tanggal_awal']);
                            $tgl2 = date_create($data_tambah['tanggal_akhir']);
                            $tanggal_awal = date_format($tgl1, 'd-m-Y');
                            $tanggal_akhir = date_format($tgl2, 'd-m-Y');
                            $tahun = date_format($tgl2, 'Y');
                            

                        ?>  
                            <option value="<?php echo $data_tambah['id_set'];?>"><?php echo 'Bulan : '.$data_tambah['bulan'].' ('.$tahun.') - Minggu : '.$data_tambah['minggu'].' ( '.$tanggal_awal.' s/d '.$tanggal_akhir.' )';?></option>

                        <?php
                            }
                          }else{
                        ?>
                             <option value="">Data Belum Ada, Segera Lakukan Setting Input</option>
                        <?php
                          }
                        ?>
                        ?>
                      </select>
                      </p>
                  </div>

                  <div class="modal-footer">
                          <button type="button" class="btn btn-md btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>
                          <button type="submit" class="btn btn-md btn-success"><i class="glyphicon glyphicon-search"></i> Submit</button>
                  </div>
                    
                  
                      </form>
                  </div>
                </div>
              </div>
              <!-- ENDModal Cari Data Omzet -->

              <!--Script Cari Data-->
              <script>
              $(document).ready(function() {
                      // Untuk sunting
                      $('#modal_cari_data').on('hidden.bs.modal', function (event) {
                         $('#form-search-omzet').trigger('reset');
                      });
                  });
              </script>
              <!--End Cari Data-->


            <!-- Modal Export Data Omzet -->
            <div class="modal fade" id="modal_export_data" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">

                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Export Data Gaji to PDF</h4>
                  </div>
                  <div class="modal-body">
                    <p>

                      <form id="form-export-omzet" method="post" action="<?php echo site_url('export/e_gaji_anggaran');?>">

                      <label for="id_set">ID Export :</label>
                      <select id="id_set" class="form-control" name="id_set" required oninvalid="this.setCustomValidity('Kolom ID Input harus diisi')" oninput="setCustomValidity('')">
                        <?php 
                        if(!empty($get_set_input)){
                        ?>
                            <!-- <option value="reset">Seluruh Data (ALL TIME)</option> -->
                        <?php
                            foreach ($get_set_input as $data_tambah) {
                            $tgl1 = date_create($data_tambah['tanggal_awal']);
                            $tgl2 = date_create($data_tambah['tanggal_akhir']);
                            $tanggal_awal = date_format($tgl1, 'd-m-Y');
                            $tanggal_akhir = date_format($tgl2, 'd-m-Y');
                            $tahun = date_format($tgl2, 'Y');
                        ?>
                            <option value="<?php echo $data_tambah['id_set'];?>"><?php echo 'Bulan : '.$data_tambah['bulan'].' ('.$tahun.') - Minggu : '.$data_tambah['minggu'].' ( '.$tanggal_awal.' s/d '.$tanggal_akhir.' )';?></option>

                        <?php
                            }
                          }else{
                        ?>
                             <option value="">Data Belum Ada, Segera Lakukan Setting Input</option>
                        <?php
                          }
                        ?>
                      </select>
                      </p>
                  </div>

                  <div class="modal-footer">
                          <button type="button" class="btn btn-md btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>
                          <button type="submit" class="btn btn-md btn-success"><i class="glyphicon glyphicon-export"></i> Submit</button>
                  </div>
                    
                  
                      </form>
                  </div>
                </div>
              </div>
              <!-- ENDModal Cari Data Omzet -->

              <!--Script Cari Data-->
              <script>
              $(document).ready(function() {
                      // Untuk sunting
                      $('#modal_export_data').on('hidden.bs.modal', function (event) {
                         $('#form-export-omzet').trigger('reset');
                      });
                  });
              </script>
              <!--End Cari Data-->

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
error_reporting(0);
?>
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
          <h2><middle><span class="fa fa-cog"></span> Halaman <?php echo @$sess_location; ?></middle></h2>
          <ul class="nav navbar-right panel_toolbox">
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
              <h2><middle><span class="fa fa-database"></span> Data <?php echo @$sess_location; ?></middle></h2>
              <ul class="nav navbar-right panel_toolbox">
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
                          //if($get_id=='1'){
                  if($get_omzet[0]['omzet_lap_1']==0 && $get_id!=1){
                    ?>
                    <a>
                      <button type="button" class="btn btn-sm btn-default" title="Export PDF" target="_blank" disabled="disabled"><i class="glyphicon glyphicon-export"></i> Export PDF</button>
                    </a>
                  <?php }elseif($get_id==1){
                    ?>
                    <a>
                      <button type="button" class="btn btn-sm btn-default" title="Export PDF" target="_blank" disabled="disabled"><i class="glyphicon glyphicon-export"></i> Export PDF</button>
                    </a>
                    <?php
                  }else{ ?>
                    <a>
                      <button type="button" data-toggle="modal" data-placement="top" data-target="#modal_export_data_opsi2" class="btn btn-sm btn-default" title="Export Data"><i class="glyphicon glyphicon-export"></i> Export PDF</button>
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
                            <th rowspan="1" class="tengah" width="100"><font size="1"><?php echo ucwords($nama);?></font></th>
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
                                    <th rowspan="1" class="tengah" width="100"><font size="1"><?php echo ucwords($nama);?></font></th>
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

                                <!-- ================================================ GAJI SALES ============================================= -->
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
                                <!-- ================================================ GAJI TM 1 ============================================= -->
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
                                <!-- ================================================ GAJI TM 2 ============================================= -->
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

                                <!-- ================================================ GAJI GL ============================================= -->
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

                                <!-- ================================================ GAJI AL ============================================= -->
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

                                <!-- ================================================ GAJI T. Masak ============================================= -->
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
                                            <input type="hidden" id="tm" value="<?php echo $pembagian; ?>">
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
                                    <td colspan="12" class="tengah"><font size="2">Setting Jumlah Lapangan Belum Dilakukan <a href="<?php echo site_url('staff');?>"><strong><u>(KLIK DISINI)</u></strong></a> atau Setting Gaji Tukang Masak Belum Dilakukan <a href="<?php echo site_url('set_persen');?>"><strong><u>(KLIK DISINI)</u></strong></a>  </font></td>
                                  <?php } ?>
                                </tr>

                                <!-- ================================================ BY OPERASIONAL ============================================= -->
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
                                    <td colspan="12" class="tengah"><font size="2">Setting Jumlah Lapangan Belum Dilakukan <a href="<?php echo site_url('staff');?>"><strong><u>(KLIK DISINI)</u></strong></a> atau Setting Besaran Biaya Operasional Belum Dilakukan <a href="<?php echo site_url('set_persen');?>"><strong><u>(KLIK DISINI)</u></strong></a>  </font></td>
                                  <?php } ?>
                                </tr>

                                <!-- ================================================ ONGKOS BELANJA ============================================= -->
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
                                            <td class="tengah"><font size="1" id="tdob"><?php echo $hasil = "Rp " . number_format($hasil,0,',','.'); ?></font></td>
                                          <?php }else{ ?>
                                            <input type="hidden" id="ob" value="<?php echo $pembagian; ?>">
                                            <?php 
                                            $id = 12-$jml_lap;
                                            for($i=1;$i<$id;$i++){
                                              $value = 0;
                                              ?>
                                              <td class="tengah"><font size="1" id="tdob"><?php echo $value = "Rp " . number_format($value,0,',','.'); ?></font></td>
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
                                    <td colspan="12" class="tengah"><font size="2">Setting Jumlah Lapangan Belum Dilakukan <a href="<?php echo site_url('staff');?>"><strong><u>(KLIK DISINI)</u></strong></a> atau Setting Besaran Ongkos Belanja Belum Dilakukan <a href="<?php echo site_url('set_persen');?>"><strong><u>(KLIK DISINI)</u></strong></a>  </font></td>
                                  <?php } ?>
                                </tr>

                                <!-- ================================================ ANGGARAN BELANJA ============================================= -->
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

                                <tr>
                                  <td colspan="4" class="tengah"><font size="2"><b>Anggaran Belanja</font></td>
                                    <td class="tengah"><font size="1" id="anggaran_1"></font></td>
                                    <td class="tengah"><font size="1" id="anggaran_2"></font></td>
                                    <td class="tengah"><font size="1" id="anggaran_3"></font></td>
                                    <td class="tengah"><font size="1" id="anggaran_4"></font></td>
                                    <td class="tengah"><font size="1" id="anggaran_5"></font></td>
                                    <td class="tengah"><font size="1" id="anggaran_6"></font></td>
                                    <td class="tengah"><font size="1" id="anggaran_7"></font></td>
                                    <td class="tengah"><font size="1" id="anggaran_8"></font></td>
                                    <td class="tengah"><font size="1" id="anggaran_9"></font></td>
                                    <td class="tengah"><font size="1" id="anggaran_10"></font></td>
                                    <td class="tengah"><font size="1" id="anggaran_11"></font></td>
                                    <td class="tengah"><font size="1" id="jumlahTotal"></font></td>
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

                  <!-- ========================== FOR LAPANGAN 1 ======================== -->
                  <script type="text/javascript">
                    $(document).ready(function() {
                      function rupiah(angka){
                       var reverse = angka.toString().split('').reverse().join(''),
                       ribuan = reverse.match(/\d{1,3}/g);
                       ribuan = ribuan.join('.').split('').reverse().join('');
                       return ribuan;
                     } 

                     var omzet_1 = $('#omzet_1').val();
                     var s_1 = $('#s_1').val();
                     var tm_1_1 = $('#tm_1_1').val();
                     var tm_2_1 = $('#tm_2_1').val();
                     var gl_1 = $('#gl_1').val();
                     var al_1 = $('#al_1').val();
                     var tm = $('#tm').val();
                     var bop = $('#bop').val();
                     var ob = $('#ob').val();
                     var tdob = $('#tdob').html();

                     var jumlah_1 = parseFloat(s_1) + parseFloat(tm_1_1) + parseFloat(tm_2_1) + parseFloat(gl_1) + parseFloat(al_1) + parseFloat(tm) + parseFloat(bop) + parseFloat(ob);
                     var v_omzet_1 = parseFloat(omzet_1);
                     var anggaran_1 = v_omzet_1 - jumlah_1;
                  //alert(tdob);
                  
                  if(jumlah_1='NaN'){
                    $('#anggaran_1').html('Error');
                  }

                  var jml_lap = "<?php echo isset($get_jml_lap[0]['jumlah'])?$get_jml_lap[0]['jumlah']:'';?>";
                  if(jml_lap == 1 && s_1 != 0){
                    $('#a_1').val(anggaran_1.toFixed(0));$('#v_1').val(anggaran_1.toFixed(0));
                    $('#anggaran_1').html('Rp '+rupiah(anggaran_1.toFixed(0)));
                  }else if(jml_lap>=1 && jml_lap<11 && s_1 != 0){
                    $('#a_1').val(anggaran_1.toFixed(0));$('#v_1').val(anggaran_1.toFixed(0));
                    $('#anggaran_1').html('Rp '+rupiah(anggaran_1.toFixed(0)));
                  }else if(jml_lap>=1 && jml_lap<=11 && s_1 != 0){
                    $('#a_1').val(anggaran_1.toFixed(0));$('#v_1').val(anggaran_1.toFixed(0));
                    $('#anggaran_1').html('Rp '+rupiah(anggaran_1.toFixed(0)));
                  }else{
                    anggaran_1 = 0;
                    $('#a_1').val(0);
                    $('#v_1').val(0);
                    $('#anggaran_1').html('Rp '+rupiah(anggaran_1.toFixed(0)));
                  }

                  if(anggaran_1<0){
                    $('#a_1').val('-'+anggaran_1.toFixed(0));$('#v_1').val('-'+anggaran_1.toFixed(0));
                    $('#anggaran_1').html('Rp -'+rupiah(anggaran_1.toFixed(0)));  
                  }else{
                    $('#a_1').val(anggaran_1.toFixed(0));$('#v_1').val(anggaran_1.toFixed(0));
                    $('#anggaran_1').html('Rp '+rupiah(anggaran_1.toFixed(0)));
                  }

                });
              </script>

              <!-- ========================== FOR LAPANGAN 2 ======================== -->
              <script type="text/javascript">
                $(document).ready(function() {
                  function rupiah(angka){
                   var reverse = angka.toString().split('').reverse().join(''),
                   ribuan = reverse.match(/\d{1,3}/g);
                   ribuan = ribuan.join('.').split('').reverse().join('');
                   return ribuan;
                 } 

                 var omzet_2 = $('#omzet_2').val();
                 var s_2 = $('#s_2').val();
                 var tm_1_2 = $('#tm_1_2').val();
                 var tm_2_2 = $('#tm_2_2').val();
                 var gl_2 = $('#gl_2').val();
                 var al_2 = $('#al_2').val();
                 var tm = $('#tm').val();
                 var bop = $('#bop').val();
                 var ob = $('#ob').val();
                 var tdob = $('#tdob').html();

                 var jumlah_2 = parseFloat(s_2) + parseFloat(tm_1_2) + parseFloat(tm_2_2) + parseFloat(gl_2) + parseFloat(al_2) + parseFloat(tm) + parseFloat(bop) + parseFloat(ob);
                 var v_omzet_2 = parseFloat(omzet_2);
                 var anggaran_2 = v_omzet_2 - jumlah_2;
                 
                 
                 if(jumlah_2='NaN'){
                  $('#anggaran_2').html('Error');
                }

                var jml_lap = "<?php echo isset($get_jml_lap[0]['jumlah'])?$get_jml_lap[0]['jumlah']:'';?>";
                if(jml_lap == 2 && s_2!= 0){
                  $('#a_2').val(anggaran_2.toFixed(0));$('#v_2').val(anggaran_2.toFixed(0));
                  $('#anggaran_2').html('Rp '+rupiah(anggaran_2.toFixed(0)));
                }else if(jml_lap>=2 && jml_lap<11 && s_2!= 0){
                  $('#a_2').val(anggaran_2.toFixed(0));$('#v_2').val(anggaran_2.toFixed(0));
                  $('#anggaran_2').html('Rp '+rupiah(anggaran_2.toFixed(0)));
                }else if(jml_lap>=2 && jml_lap<=11 && s_2!= 0){
                  $('#a_2').val(anggaran_2.toFixed(0));$('#v_2').val(anggaran_2.toFixed(0));
                  $('#anggaran_2').html('Rp '+rupiah(anggaran_2.toFixed(0)));
                }else{
                  anggaran_2 = 0;
                  $('#a_2').val(0);
                  $('#v_2').val(0);
                  $('#anggaran_2').html('Rp '+rupiah(anggaran_2.toFixed(0)));
                }

                if(anggaran_2<0){
                  $('#a_2').val('-'+anggaran_2.toFixed(0));$('#v_2').val('-'+anggaran_2.toFixed(0));
                  $('#anggaran_2').html('Rp -'+rupiah(anggaran_2.toFixed(0)));  
                }else{
                  $('#a_2').val(anggaran_2.toFixed(0));$('#v_2').val(anggaran_2.toFixed(0));
                  $('#anggaran_2').html('Rp '+rupiah(anggaran_2.toFixed(0)));
                }

              });
            </script>

            <!-- ========================== FOR LAPANGAN 3 ======================== -->
            <script type="text/javascript">
              $(document).ready(function() {
                function rupiah(angka){
                 var reverse = angka.toString().split('').reverse().join(''),
                 ribuan = reverse.match(/\d{1,3}/g);
                 ribuan = ribuan.join('.').split('').reverse().join('');
                 return ribuan;
               } 

               var omzet_3 = $('#omzet_3').val();
               var s_3 = $('#s_3').val();
               var tm_1_3 = $('#tm_1_3').val();
               var tm_2_3 = $('#tm_2_3').val();
               var gl_3 = $('#gl_3').val();
               var al_3 = $('#al_3').val();
               var tm = $('#tm').val();
               var bop = $('#bop').val();
               var ob = $('#ob').val();
               var tdob = $('#tdob').html();

               var jumlah_3 = parseFloat(s_3) + parseFloat(tm_1_3) + parseFloat(tm_2_3) + parseFloat(gl_3) + parseFloat(al_3) + parseFloat(tm) + parseFloat(bop) + parseFloat(ob);
               var v_omzet_3 = parseFloat(omzet_3);
               var anggaran_3 = v_omzet_3 - jumlah_3;
               

               if(jumlah_3='NaN'){
                $('#anggaran_3').html('Error');
              }

              var jml_lap = "<?php echo isset($get_jml_lap[0]['jumlah'])?$get_jml_lap[0]['jumlah']:'';?>";
              if(jml_lap == 3 && s_3!= 0){
                $('#a_3').val(anggaran_3.toFixed(0));$('#v_3').val(anggaran_3.toFixed(0));
                $('#anggaran_3').html('Rp '+rupiah(anggaran_3.toFixed(0)));
              }else if(jml_lap>=3 && jml_lap<11 && s_3!= 0){
                $('#a_3').val(anggaran_3.toFixed(0));$('#v_3').val(anggaran_3.toFixed(0));
                $('#anggaran_3').html('Rp '+rupiah(anggaran_3.toFixed(0)));
              }else if(jml_lap>=3 && jml_lap<=11 && s_3!= 0){
                $('#a_3').val(anggaran_3.toFixed(0));$('#v_3').val(anggaran_3.toFixed(0));
                $('#anggaran_3').html('Rp '+rupiah(anggaran_3.toFixed(0)));
              }else{
                anggaran_3 = 0;
                $('#a_3').val(0);
                $('#v_3').val(0);
                $('#anggaran_3').html('Rp '+rupiah(anggaran_3.toFixed(0)));
              }

              if(anggaran_3<0){
                $('#a_3').val('-'+anggaran_3.toFixed(0));$('#v_3').val('-'+anggaran_3.toFixed(0));
                $('#anggaran_3').html('Rp -'+rupiah(anggaran_3.toFixed(0)));  
              }else{
                $('#a_3').val(anggaran_3.toFixed(0));$('#v_3').val(anggaran_3.toFixed(0));
                $('#anggaran_3').html('Rp '+rupiah(anggaran_3.toFixed(0)));
              }

            });
          </script>

          <!-- ========================== FOR LAPANGAN 4 ======================== -->
          <script type="text/javascript">
            $(document).ready(function() {
              function rupiah(angka){
               var reverse = angka.toString().split('').reverse().join(''),
               ribuan = reverse.match(/\d{1,3}/g);
               ribuan = ribuan.join('.').split('').reverse().join('');
               return ribuan;
             } 

             var omzet_4 = $('#omzet_4').val();
             var s_4 = $('#s_4').val();
             var tm_1_4 = $('#tm_1_4').val();
             var tm_2_4 = $('#tm_2_4').val();
             var gl_4 = $('#gl_4').val();
             var al_4 = $('#al_4').val();
             var tm = $('#tm').val();
             var bop = $('#bop').val();
             var ob = $('#ob').val();
             var tdob = $('#tdob').html();

             var jumlah_4 = parseFloat(s_4) + parseFloat(tm_1_4) + parseFloat(tm_2_4) + parseFloat(gl_4) + parseFloat(al_4) + parseFloat(tm) + parseFloat(bop) + parseFloat(ob);
             var v_omzet_4 = parseFloat(omzet_4);
             var anggaran_4 = v_omzet_4 - jumlah_4;
             

             if(jumlah_4='NaN'){
              $('#anggaran_4').html('Error');
            }

            var jml_lap = "<?php echo isset($get_jml_lap[0]['jumlah'])?$get_jml_lap[0]['jumlah']:'';?>";
            if(jml_lap == 4 && s_4!= 0){
              $('#a_4').val(anggaran_4.toFixed(0));
              $('#v_4').val(anggaran_4.toFixed(0));
              $('#anggaran_4').html('Rp '+rupiah(anggaran_4.toFixed(0)));
            }else if(jml_lap >= 4 && jml_lap<11 && s_4!= 0){
              $('#a_4').val(anggaran_4.toFixed(0));
              $('#v_4').val(anggaran_4.toFixed(0));
              $('#anggaran_4').html('Rp '+rupiah(anggaran_4.toFixed(0)));
            }else if(jml_lap >= 4 && jml_lap<=11 && s_4!= 0){
              $('#a_4').val(anggaran_4.toFixed(0));
              $('#v_4').val(anggaran_4.toFixed(0));
              $('#anggaran_4').html('Rp '+rupiah(anggaran_4.toFixed(0)));
            }else{
              anggaran_4 = 0;
              $('#a_4').val(0);
              $('#v_4').val(0);
              $('#anggaran_4').html('Rp '+rupiah(anggaran_4.toFixed(0)));
            }

            if(anggaran_4<0){
              $('#a_4').val('-'+anggaran_4.toFixed(0));$('#v_4').val('-'+anggaran_4.toFixed(0));
              $('#anggaran_4').html('Rp -'+rupiah(anggaran_4.toFixed(0)));  
            }else{
              $('#a_4').val(anggaran_4.toFixed(0));$('#v_4').val(anggaran_4.toFixed(0));
              $('#anggaran_4').html('Rp '+rupiah(anggaran_4.toFixed(0)));
            }

          });
        </script>

        <!-- ========================== FOR LAPANGAN 5 ======================== -->
        <script type="text/javascript">
          $(document).ready(function() {
            function rupiah(angka){
             var reverse = angka.toString().split('').reverse().join(''),
             ribuan = reverse.match(/\d{1,3}/g);
             ribuan = ribuan.join('.').split('').reverse().join('');
             return ribuan;
           } 

           var omzet_5 = $('#omzet_5').val();
           var s_5 = $('#s_5').val();
           var tm_1_5 = $('#tm_1_5').val();
           var tm_2_5 = $('#tm_2_5').val();
           var gl_5 = $('#gl_5').val();
           var al_5 = $('#al_5').val();
           var tm = $('#tm').val();
           var bop = $('#bop').val();
           var ob = $('#ob').val();
           var tdob = $('#tdob').html();

           var jumlah_5 = parseFloat(s_5) + parseFloat(tm_1_5) + parseFloat(tm_2_5) + parseFloat(gl_5) + parseFloat(al_5) + parseFloat(tm) + parseFloat(bop) + parseFloat(ob);
           var v_omzet_5 = parseFloat(omzet_5);
           var anggaran_5 = v_omzet_5 - jumlah_5;
           

           if(jumlah_5='NaN'){
            $('#anggaran_5').html('Error');
          }

          var jml_lap = "<?php echo isset($get_jml_lap[0]['jumlah'])?$get_jml_lap[0]['jumlah']:'';?>";
          if(jml_lap == 5 && s_5!= 0 && tm_1_5 != 0){
            $('#a_5').val(anggaran_5.toFixed(0));$('#v_5').val(anggaran_5.toFixed(0));
            $('#anggaran_5').html('Rp '+rupiah(anggaran_5.toFixed(0)));
          }else if(jml_lap>=5 && jml_lap<11 && s_5!= 0){
            $('#a_5').val(anggaran_5.toFixed(0));$('#v_5').val(anggaran_5.toFixed(0));
            $('#anggaran_5').html('Rp '+rupiah(anggaran_5.toFixed(0)));
          }else if(jml_lap>=5 && jml_lap<=11 && s_5!= 0){
            $('#a_5').val(anggaran_5.toFixed(0));$('#v_5').val(anggaran_5.toFixed(0));
            $('#anggaran_5').html('Rp '+rupiah(anggaran_5.toFixed(0)));
          }else{
            anggaran_5 = 0;
            $('#a_5').val(0);
            $('#v_5').val(0);
            $('#anggaran_5').html('Rp '+rupiah(anggaran_5.toFixed(0)));  
          }

          if(anggaran_5<0){
            $('#a_5').val('-'+anggaran_5.toFixed(0));$('#v_5').val('-'+anggaran_5.toFixed(0));
            $('#anggaran_5').html('Rp -'+rupiah(anggaran_5.toFixed(0)));  
          }else{
            $('#a_5').val(anggaran_5.toFixed(0));$('#v_5').val(anggaran_5.toFixed(0));
            $('#anggaran_5').html('Rp '+rupiah(anggaran_5.toFixed(0)));
          }

        });
      </script>

      <!-- ========================== FOR LAPANGAN 6 ======================== -->
      <script type="text/javascript">
        $(document).ready(function() {
          function rupiah(angka){
           var reverse = angka.toString().split('').reverse().join(''),
           ribuan = reverse.match(/\d{1,3}/g);
           ribuan = ribuan.join('.').split('').reverse().join('');
           return ribuan;
         } 

         var omzet_6 = $('#omzet_6').val();
         var s_6 = $('#s_6').val();
         var tm_1_6 = $('#tm_1_6').val();
         var tm_2_6 = $('#tm_2_6').val();
         var gl_6 = $('#gl_6').val();
         var al_6 = $('#al_6').val();
         var tm = $('#tm').val();
         var bop = $('#bop').val();
         var ob = $('#ob').val();
         var tdob = $('#tdob').html();

         var jumlah_6 = parseFloat(s_6) + parseFloat(tm_1_6) + parseFloat(tm_2_6) + parseFloat(gl_6) + parseFloat(al_6) + parseFloat(tm) + parseFloat(bop) + parseFloat(ob);
         var v_omzet_6 = parseFloat(omzet_6);
         var anggaran_6 = v_omzet_6 - jumlah_6;
         

         if(jumlah_6='NaN'){
          $('#anggaran_6').html('Error');
        }else{
          $('#a_6').val(anggaran_6.toFixed(0));$('#v_6').val(anggaran_6.toFixed(0));
          $('#anggaran_6').html('Rp '+rupiah(anggaran_6.toFixed(0)));
        }

        var jml_lap = "<?php echo isset($get_jml_lap[0]['jumlah'])?$get_jml_lap[0]['jumlah']:'';?>";
        if(jml_lap == 6 && s_6!= 0){
          $('#a_6').val(anggaran_6.toFixed(0));$('#v_6').val(anggaran_6.toFixed(0));
          $('#anggaran_6').html('Rp '+rupiah(anggaran_6.toFixed(0)));
        }else if(jml_lap>=6 && jml_lap<11 && s_6!= 0){
          $('#a_6').val(anggaran_6.toFixed(0));$('#v_6').val(anggaran_6.toFixed(0));
          $('#anggaran_6').html('Rp '+rupiah(anggaran_6.toFixed(0)));  
        }else if(jml_lap>=6 && jml_lap<=11 && s_6!= 0){
          $('#a_6').val(anggaran_6.toFixed(0));$('#v_6').val(anggaran_6.toFixed(0));
          $('#anggaran_6').html('Rp '+rupiah(anggaran_6.toFixed(0)));  
        }else{
          anggaran_6 = 0;
          $('#a_6').val(0);
          $('#v_6').val(0);
          $('#anggaran_6').html('Rp '+rupiah(anggaran_6.toFixed(0)));
        }

        if(anggaran_6<0){
          $('#a_6').val('-'+anggaran_6.toFixed(0));$('#v_6').val('-'+anggaran_6.toFixed(0));
          $('#anggaran_6').html('Rp -'+rupiah(anggaran_6.toFixed(0)));  
        }else{
          $('#a_6').val(anggaran_6.toFixed(0));$('#v_6').val(anggaran_6.toFixed(0));
          $('#anggaran_6').html('Rp '+rupiah(anggaran_6.toFixed(0)));
        }

      });
    </script>

    <!-- ========================== FOR LAPANGAN 7 ======================== -->
    <script type="text/javascript">
      $(document).ready(function() {
        function rupiah(angka){
         var reverse = angka.toString().split('').reverse().join(''),
         ribuan = reverse.match(/\d{1,3}/g);
         ribuan = ribuan.join('.').split('').reverse().join('');
         return ribuan;
       } 

       var omzet_7 = $('#omzet_7').val();
       var s_7 = $('#s_7').val();
       var tm_1_7 = $('#tm_1_7').val();
       var tm_2_7 = $('#tm_2_7').val();
       var gl_7 = $('#gl_7').val();
       var al_7 = $('#al_7').val();
       var tm = $('#tm').val();
       var bop = $('#bop').val();
       var ob = $('#ob').val();
       var tdob = $('#tdob').html();

       var jumlah_7 = parseFloat(s_7) + parseFloat(tm_1_7) + parseFloat(tm_2_7) + parseFloat(gl_7) + parseFloat(al_7) + parseFloat(tm) + parseFloat(bop) + parseFloat(ob);
       var v_omzet_7 = parseFloat(omzet_7);
       var anggaran_7 = v_omzet_7 - jumlah_7;
       

       if(jumlah_7='NaN'){
        $('#anggaran_7').html('Error');
      }

      var jml_lap = "<?php echo isset($get_jml_lap[0]['jumlah'])?$get_jml_lap[0]['jumlah']:'';?>";
      if(jml_lap == 7 && s_7!= 0){
        $('#a_7').val(anggaran_7.toFixed(0));$('#v_7').val(anggaran_7.toFixed(0));
        $('#anggaran_7').html('Rp '+rupiah(anggaran_7.toFixed(0)));
      }else if(jml_lap>=7 && jml_lap<11 && s_7!= 0){
        $('#a_7').val(anggaran_7.toFixed(0));$('#v_7').val(anggaran_7.toFixed(0));
        $('#anggaran_7').html('Rp '+rupiah(anggaran_7.toFixed(0)));  
      }else if(jml_lap>=7 && jml_lap<=11 && s_7!= 0){
        $('#a_7').val(anggaran_7.toFixed(0));$('#v_7').val(anggaran_7.toFixed(0));
        $('#anggaran_7').html('Rp '+rupiah(anggaran_7.toFixed(0)));  
      }else{
        anggaran_7 = 0;
        $('#a_7').val(0);
        $('#v_7').val(0);
        $('#anggaran_7').html('Rp '+rupiah(anggaran_7.toFixed(0)));  
      }
      

      if(anggaran_7<0){
        $('#a_7').val('-'+anggaran_7.toFixed(0));$('#v_7').val('-'+anggaran_7.toFixed(0));
        $('#anggaran_7').html('Rp -'+rupiah(anggaran_7.toFixed(0)));  
      }else{
        $('#a_7').val(anggaran_7.toFixed(0));$('#v_7').val(anggaran_7.toFixed(0));
        $('#anggaran_7').html('Rp '+rupiah(anggaran_7.toFixed(0)));
      }

    });
  </script>

  <!-- ========================== FOR LAPANGAN 8 ======================== -->
  <script type="text/javascript">
    $(document).ready(function() {
      function rupiah(angka){
       var reverse = angka.toString().split('').reverse().join(''),
       ribuan = reverse.match(/\d{1,3}/g);
       ribuan = ribuan.join('.').split('').reverse().join('');
       return ribuan;
     } 

     var omzet_8 = $('#omzet_8').val();
     var s_8 = $('#s_8').val();
     var tm_1_8 = $('#tm_1_8').val();
     var tm_2_8 = $('#tm_2_8').val();
     var gl_8 = $('#gl_8').val();
     var al_8 = $('#al_8').val();
     var tm = $('#tm').val();
     var bop = $('#bop').val();
     var ob = $('#ob').val();
     var tdob = $('#tdob').html();

     var jumlah_8 = parseFloat(s_8) + parseFloat(tm_1_8) + parseFloat(tm_2_8) + parseFloat(gl_8) + parseFloat(al_8) + parseFloat(tm) + parseFloat(bop) + parseFloat(ob);
     var v_omzet_8 = parseFloat(omzet_8);
     var anggaran_8 = v_omzet_8 - jumlah_8;
     

     if(jumlah_8='NaN'){
      $('#anggaran_8').html('Error');
    }

    var jml_lap = "<?php echo isset($get_jml_lap[0]['jumlah'])?$get_jml_lap[0]['jumlah']:'';?>";
    if(jml_lap == 8 && s_8!= 0){
      $('#a_8').val(anggaran_8.toFixed(0));
      $('#v_8').val(anggaran_8.toFixed(0));
      $('#anggaran_8').html('Rp '+rupiah(anggaran_8.toFixed(0)));
      
    }else if(jml_lap>=8 && jml_lap<11 && s_8!= 0){
      $('#a_8').val(anggaran_8.toFixed(0));
      $('#v_8').val(anggaran_8.toFixed(0));
      $('#anggaran_8').html('Rp '+rupiah(anggaran_8.toFixed(0)));  
    }else if(jml_lap>=8 && jml_lap<=11 && s_8!= 0){
      $('#a_8').val(anggaran_8.toFixed(0));
      $('#v_8').val(anggaran_8.toFixed(0));
      $('#anggaran_8').html('Rp '+rupiah(anggaran_8.toFixed(0)));  
    }else{
      anggaran_8 = 0;
      $('#a_8').val(0);
      $('#v_8').val(0);
      $('#anggaran_8').html('Rp '+rupiah(anggaran_8.toFixed(0)));  
    }
    

    if(anggaran_8<0){
      $('#a_8').val('-'+anggaran_8.toFixed(0));
      $('#v_8').val('-'+anggaran_8.toFixed(0));
      $('#anggaran_8').html('Rp -'+rupiah(anggaran_8.toFixed(0)));  
    }else{
      $('#a_8').val(anggaran_8.toFixed(0));
      $('#v_8').val(anggaran_8.toFixed(0));
      $('#anggaran_8').html('Rp '+rupiah(anggaran_8.toFixed(0)));
    }

  });
</script>

<!-- ========================== FOR LAPANGAN 9 ======================== -->
<script type="text/javascript">
  $(document).ready(function() {
    function rupiah(angka){
     var reverse = angka.toString().split('').reverse().join(''),
     ribuan = reverse.match(/\d{1,3}/g);
     ribuan = ribuan.join('.').split('').reverse().join('');
     return ribuan;
   } 

   var omzet_9 = $('#omzet_9').val();
   var s_9 = $('#s_9').val();
   var tm_1_9 = $('#tm_1_9').val();
   var tm_2_9 = $('#tm_2_9').val();
   var gl_9 = $('#gl_9').val();
   var al_9 = $('#al_9').val();
   var tm = $('#tm').val();
   var bop = $('#bop').val();
   var ob = $('#ob').val();
   var tdob = $('#tdob').html();

   var jumlah_9 = parseFloat(s_9) + parseFloat(tm_1_9) + parseFloat(tm_2_9) + parseFloat(gl_9) + parseFloat(al_9) + parseFloat(tm) + parseFloat(bop) + parseFloat(ob);
   var v_omzet_9 = parseFloat(omzet_9);
   var anggaran_9 = v_omzet_9 - jumlah_9;
   

   if(jumlah_9='NaN'){
    $('#anggaran_9').html('Error');
  }

  var jml_lap = "<?php echo isset($get_jml_lap[0]['jumlah'])?$get_jml_lap[0]['jumlah']:'';?>";
  if(jml_lap == 9 && s_9!= 0){
    $('#a_9').val(anggaran_9.toFixed(0));
    $('#v_9').val(anggaran_9.toFixed(0));
    $('#anggaran_9').html('Rp '+rupiah(anggaran_9.toFixed(0)));
  }else if(jml_lap>=9 && jml_lap<11 && s_9!= 0){
    $('#a_9').val(anggaran_9.toFixed(0));
    $('#v_9').val(anggaran_9.toFixed(0));
    $('#anggaran_9').html('Rp '+rupiah(anggaran_9.toFixed(0)));  
  }else if(jml_lap>=9 && jml_lap<=11 && s_9!= 0){
    $('#a_9').val(anggaran_9.toFixed(0));
    $('#v_9').val(anggaran_9.toFixed(0));
    $('#anggaran_9').html('Rp '+rupiah(anggaran_9.toFixed(0)));  
  }else{
    anggaran_9 = 0;
    $('#a_9').val(0);
    $('#v_9').val(0);
    $('#anggaran_9').html('Rp '+rupiah(anggaran_9.toFixed(0)));  
  }

  if(anggaran_9<0){
    $('#a_9').val('-'+anggaran_9.toFixed(0));
    $('#v_9').val('-'+anggaran_9.toFixed(0));
    $('#anggaran_9').html('Rp -'+rupiah(anggaran_9.toFixed(0)));  
  }else{
    $('#a_9').val(anggaran_9.toFixed(0));
    $('#v_9').val(anggaran_9.toFixed(0));
    $('#anggaran_9').html('Rp '+rupiah(anggaran_9.toFixed(0)));
  }

});
</script>

<!-- ========================== FOR LAPANGAN 10 ======================== -->
<script type="text/javascript">
  $(document).ready(function() {
    function rupiah(angka){
     var reverse = angka.toString().split('').reverse().join(''),
     ribuan = reverse.match(/\d{1,3}/g);
     ribuan = ribuan.join('.').split('').reverse().join('');
     return ribuan;
   } 

   var omzet_10 = $('#omzet_10').val();
   var s_10 = $('#s_10').val();
   var tm_1_10 = $('#tm_1_10').val();
   var tm_2_10 = $('#tm_2_10').val();
   var gl_10 = $('#gl_10').val();
   var al_10 = $('#al_10').val();
   var tm = $('#tm').val();
   var bop = $('#bop').val();
   var ob = $('#ob').val();
   var tdob = $('#tdob').html();

   var jumlah_10 = parseFloat(s_10) + parseFloat(tm_1_10) + parseFloat(tm_2_10) + parseFloat(gl_10) + parseFloat(al_10) + parseFloat(tm) + parseFloat(bop) + parseFloat(ob);
   var v_omzet_10 = parseFloat(omzet_10);
   var anggaran_10 = v_omzet_10 - jumlah_10;
   

   if(jumlah_10='NaN'){
    $('#anggaran_10').html('Error');
  }

  var jml_lap = "<?php echo isset($get_jml_lap[0]['jumlah'])?$get_jml_lap[0]['jumlah']:'';?>";
  if(jml_lap == 10 && s_10!= 0){
    $('#a_10').val(anggaran_10.toFixed(0));
    $('#v_10').val(anggaran_10.toFixed(0));
    $('#anggaran_10').html('Rp '+rupiah(anggaran_10.toFixed(0)));
  }else if(jml_lap>=10 && jml_lap<11 && s_10!= 0){
    $('#a_10').val(anggaran_10.toFixed(0));
    $('#v_10').val(anggaran_10.toFixed(0));
    $('#anggaran_10').html('Rp '+rupiah(anggaran_10.toFixed(0)));  
  }else if(jml_lap>=10 && jml_lap<=11 && s_10!= 0){
    $('#a_10').val(anggaran_10.toFixed(0));
    $('#v_10').val(anggaran_10.toFixed(0));
    $('#anggaran_10').html('Rp '+rupiah(anggaran_10.toFixed(0)));  
  }else{
    anggaran_10 = 0;
    $('#a_10').val(0);
    $('#v_10').val(0);
    $('#anggaran_10').html('Rp '+rupiah(anggaran_10.toFixed(0)));  
  }
  

  if(anggaran_10<0){
    $('#a_10').val('-'+anggaran_10.toFixed(0));
    $('#v_10').val('-'+anggaran_10.toFixed(0));
    $('#anggaran_10').html('Rp -'+rupiah(anggaran_10.toFixed(0)));  
  }else{
    $('#a_10').val(anggaran_10.toFixed(0));
    $('#v_10').val(anggaran_10.toFixed(0));
    $('#anggaran_10').html('Rp '+rupiah(anggaran_10.toFixed(0)));
  }

});
</script>

<!-- ========================== FOR LAPANGAN 11 ======================== -->
<script type="text/javascript">
  $(document).ready(function() {
    function rupiah(angka){
     var reverse = angka.toString().split('').reverse().join(''),
     ribuan = reverse.match(/\d{1,3}/g);
     ribuan = ribuan.join('.').split('').reverse().join('');
     return ribuan;
   } 

   var omzet_11 = $('#omzet_11').val();
   var s_11 = $('#s_11').val();
   var tm_1_11 = $('#tm_1_11').val();
   var tm_2_11 = $('#tm_2_11').val();
   var gl_11 = $('#gl_11').val();
   var al_11 = $('#al_11').val();
   var tm = $('#tm').val();
   var bop = $('#bop').val();
   var ob = $('#ob').val();
   var tdob = $('#tdob').html();

   var jumlah_11 = parseFloat(s_11) + parseFloat(tm_1_11) + parseFloat(tm_2_11) + parseFloat(gl_11) + parseFloat(al_11) + parseFloat(tm) + parseFloat(bop) + parseFloat(ob);
   var v_omzet_11 = parseFloat(omzet_11);
   var anggaran_11 = v_omzet_11 - jumlah_11;
   

   if(jumlah_11='NaN'){
    $('#anggaran_11').html('Error');
  }

  var jml_lap = "<?php echo isset($get_jml_lap[0]['jumlah'])?$get_jml_lap[0]['jumlah']:'';?>";
  if(jml_lap == 11 && s_11!= 0){
    $('#a_11').val(anggaran_11.toFixed(0));
    $('#v_11').val(anggaran_11.toFixed(0));
    $('#anggaran_11').html('Rp -'+rupiah(anggaran_11.toFixed(0)));
  }else if(jml_lap != 11 && s_11!= 0){
   $('#a_11').val(anggaran_11.toFixed(0));
   $('#v_11').val(anggaran_11.toFixed(0));
   $('#anggaran_11').html('Rp -'+rupiah(anggaran_11.toFixed(0)));  
 }else{
  anggaran_11 = 0;
  $('#a_11').val(0);
  $('#v_11').val(0);
  $('#anggaran_11').html('Rp '+rupiah(anggaran_11.toFixed(0)));
}

if(anggaran_11<0){
  $('#a_11').val(anggaran_11.toFixed(0));
  $('#v_11').val(anggaran_11.toFixed(0));
  $('#anggaran_11').html('Rp -'+rupiah(anggaran_11.toFixed(0)));  
}else{
  $('#a_11').val(anggaran_11.toFixed(0));
  $('#v_11').val(anggaran_11.toFixed(0));
  $('#anggaran_11').html('Rp '+rupiah(anggaran_11.toFixed(0)));
}

});
</script>

<!-- ========================== FOR JUMLAH TOTAL ======================== -->
<script type="text/javascript">
  $(document).ready(function() {
    function rupiah(angka){
     var reverse = angka.toString().split('').reverse().join(''),
     ribuan = reverse.match(/\d{1,3}/g);
     ribuan = ribuan.join('.').split('').reverse().join('');
     return ribuan;
   } 

   var a_1 = $('#a_1').val();
   var a_2 = $('#a_2').val();
   var a_3 = $('#a_3').val();
   var a_4 = $('#a_4').val();
   var a_5 = $('#a_5').val();
   var a_6 = $('#a_6').val();
   var a_7 = $('#a_7').val();
   var a_8 = $('#a_8').val();
   var a_9 = $('#a_9').val();
   var a_10 = $('#a_10').val();
   var a_11 = $('#a_11').val();

   var jmlTotal = (parseFloat(a_11) + parseFloat(a_10) + parseFloat(a_9) + parseFloat(a_8) + parseFloat(a_7) + parseFloat(a_6) + parseFloat(a_5) + parseFloat(a_4) + parseFloat(a_3) + parseFloat(a_2) + parseFloat(a_1));           

   if(jmlTotal=='NaN'){
    $('#jumlahTotal').html('Error');
  }

  if(jmlTotal<0){
    $('#jumlahTotal').html('Rp -'+rupiah(jmlTotal));  
  }else{
    $('#jumlahTotal').html('Rp '+rupiah(jmlTotal));
  }

});
</script>

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
                  <div class="modal fade" id="modal_export_data_opsi2" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Export Data Gaji to PDF</h4>
                        </div>
                        <div class="modal-body">
                          <p>

                            <form id="form-export-gaji" method="post" action="<?php echo site_url('export/e_gaji_anggaran');?>">
                              <input type="hidden" id="v_1" name="v_1">
                              <input type="hidden" id="v_2" name="v_2">
                              <input type="hidden" id="v_3" name="v_3">
                              <input type="hidden" id="v_4" name="v_4">
                              <input type="hidden" id="v_5" name="v_5">
                              <input type="hidden" id="v_6" name="v_6">
                              <input type="hidden" id="v_7" name="v_7">
                              <input type="hidden" id="v_8" name="v_8">
                              <input type="hidden" id="v_9" name="v_9">
                              <input type="hidden" id="v_10" name="v_10">
                              <input type="hidden" id="v_11" name="v_11">
                              
                              <select class='form-control' name='id_set' id='id_set'>
                                <option value="<?php echo $id_set_tmp;?>">Silahkan Klik Submit untuk Export/Cetak Data</option>
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
                      $('#modal_export_data_opsi2').on('hidden.bs.modal', function (event) {
                       $('#form-export-gaji').trigger('reset');
                     });
                    });
                  </script>
                  <!--End Cari Data-->

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
                  <a>
                    <button type="button" data-toggle="modal" data-placement="top" data-target="#modal_tambah_kasbon" class="btn btn-sm btn-info" title="Tambah Data"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                  </a>
                </li>
                <li>
                  <?php if(empty($get_kasbon)){?>
                    <a>
                      <button type="button" onclick="window.location.href='<?php echo base_url()?>cashbon'" class="btn btn-sm btn-warning" title="Reset Data"><i class="glyphicon glyphicon-refresh"></i> Reset Data</button>
                    </a>
                  <?php }else{?>
                    <a>
                      <button type="button" data-toggle="modal" data-placement="top" data-target="#modal_cari_data" class="btn btn-sm btn-success" title="Cari Data"><i class="glyphicon glyphicon-search"></i> Cari Data</button>
                    </a>
                  <?php } ?>
                </li>
                <li>
                  <!-- <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> -->
                  <?php if(empty($get_kasbon)){?>
                    <a href="">
                      <button type="button" class="btn btn-sm btn-default" title="Export PDF" target="_blank" disabled=""><i class="glyphicon glyphicon-export"></i> Export PDF</button>
                    </a>
                  <?php }elseif($get_id=='1') {
                    ?>
                    <a href="">
                      <button type="button" class="btn btn-sm btn-default" title="Export PDF" target="_blank" disabled=""><i class="glyphicon glyphicon-export"></i> Export PDF</button>
                    </a>
                    <?php
                  }else{?>
                    <a>
                      <button type="button" data-toggle="modal" data-placement="top" data-target="#modal_export_data" class="btn btn-sm btn-default" title="Export Data"><i class="glyphicon glyphicon-export"></i> Export PDF</button>
                    </a>
                  <?php } ?>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>

            <div class="x_content">
              <div class="table-responsive">

                <table class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr>
                      <th rowspan="2" class="tengah" width="50">No</th>
                      <th rowspan="2" class="tengah" width="85">Bln</th>
                      <th rowspan="2" class="tengah" width="35">Mg</th>
                      <th rowspan="2" class="tengah" width="35">Cab</th>
                      <th rowspan="2" class="tengah" width="60">Hari</th>
                      <th rowspan="2" class="tengah" width="100">Tgl</th>
                      <th colspan="17" class="tengah">Jabatan/Lapangan</th>
                      <th rowspan="2" class="tengah" width="100">Jml</th>
                      <th rowspan="2" class="tengah" width="150">Aksi</th>
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
                      <th rowspan="1" class="tengah" width="100">L1</th>
                      <th rowspan="1" class="tengah" width="100">L2</th>
                      <th rowspan="1" class="tengah" width="100">ATL</th>
                      <th rowspan="1" class="tengah" width="100">GL</th>
                      <th rowspan="1" class="tengah" width="100">TM</th>
                      <th rowspan="1" class="tengah" width="100">TR</th>
                    </tr>
                  </thead>
                  <?php if($get_id=='1'){ ?>
                    <tr>
                      <th colspan="25" class="tengah">Silahkan klik <a data-toggle="modal" data-placement="top" data-target="#modal_cari_data"><u>DISINI</u></a> atau klik button Cari Data di atas untuk menampilkan Data <?php echo @$sess_location; ?> </th>
                    </tr>

                  <?php }else{ ?>
                    <tbody>
                      <?php 
                      $v = isset($get_kasbon[0]['tanggal_awal'])?$get_kasbon[0]['tanggal_awal']:'';
                      $tgl_a = date_create($v);
                      $tahun = date_format($tgl_a,'Y');
                      ?>
                      <tr>
                        <th colspan="25" class="tengah">Minggu ke - <?php echo isset($get_kasbon[0]['minggu'])?$get_kasbon[0]['minggu']:'';?> (<?php echo isset($get_kasbon[0]['bulan'])?$get_kasbon[0]['bulan']:'';?> - <?php echo $tahun;?>)</th>
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
                            <td class="tengah"><font size="1"><?php echo $no; ?></font></td>
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
                            <td class='tengah' width="95">
                              <?php 
                              if($session['level_user']=='Operator'){
                                ?>
                                <!-- Button Edit-->
                                <div class="btn-group">
                                  <a ref="javascript:;"
                                  data-id="<?php echo $data['id_kasbon'];?>"
                                  data-id_user="<?php echo $data['id_user'];?>"
                                  data-id_set="<?php echo $data['id_set'];?>"
                                  data-id_cabutan="<?php echo $data['id_cabutan'];?>"
                                  data-hari="<?php echo $data['hari'];?>"
                                  data-tanggal="<?php echo $tanggal;?>"
                                  data-kasbon_lap_1="<?php echo $data['kasbon_lap_1'];?>"
                                  data-kasbon_lap_2="<?php echo $data['kasbon_lap_2'];?>"
                                  data-kasbon_lap_3="<?php echo $data['kasbon_lap_3'];?>"
                                  data-kasbon_lap_4="<?php echo $data['kasbon_lap_4'];?>"
                                  data-kasbon_lap_5="<?php echo $data['kasbon_lap_5'];?>"
                                  data-kasbon_lap_6="<?php echo $data['kasbon_lap_6'];?>"
                                  data-kasbon_lap_7="<?php echo $data['kasbon_lap_7'];?>"
                                  data-kasbon_lap_8="<?php echo $data['kasbon_lap_8'];?>"
                                  data-kasbon_lap_9="<?php echo $data['kasbon_lap_9'];?>"
                                  data-kasbon_lap_10="<?php echo $data['kasbon_lap_10'];?>"
                                  data-kasbon_lap_11="<?php echo $data['kasbon_lap_11'];?>"
                                  data-kasbon_l1="<?php echo $data['kasbon_leader_1']; ?>"
                                  data-kasbon_l2="<?php echo $data['kasbon_leader_2']; ?>"
                                  data-kasbon_atl="<?php echo $data['kasbon_asis_tl']; ?>"
                                  data-kasbon_gl="<?php echo $data['kasbon_gl']; ?>"
                                  data-kasbon_tm="<?php echo $data['kasbon_t_masak']; ?>"
                                  data-kasbon_tr="<?php echo $data['kasbon_training']; ?>"

                                  data-bulan="<?php echo $data['bulan'];?>"
                                  data-minggu="<?php echo $data['minggu'];?>"
                                  data-tanggal_awal="<?php echo $data['tanggal_awal'];?>"
                                  data-tanggal_akhir="<?php echo $data['tanggal_akhir'];?>"

                                  data-toggle="modal" data-target="#ubah-data">
                                  <button data-placement="top" class="btn btn-sm btn-warning" title="Edit Data kasbon Harian"><i class="glyphicon glyphicon-edit"></i></button>
                                </a>
                                <!-- Button Hapus-->
                                <a> 
                                  <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_delete<?php echo $data['id_kasbon']; ?>" data-placement="top" title="Hapus Data kasbon"><i class="glyphicon glyphicon-trash"></i></button>
                                </a>
                                <!-- End Button Hapus-->
                              </div>
                              <?php
                            }    
                            ?>
                          </td>  

                        </tr>


                        <!-- Modal Detele Data -->
                        <div class="modal fade" id="modal_delete<?php echo $data['id_kasbon']; ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel2">Konfirmasi Hapus Data</h4>
                              </div>
                              <div class="modal-body">
                                <p>Silahkan klik tombol <strong> Hapus </strong> untuk menghapus data</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal"><i class="glyphicon glyphicon-backward"></i> Kembali</button>
                                <a href="<?php echo site_url()."cashbon/hapus/".$data['id_kasbon'];?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
                              </div>

                            </div>
                          </div>
                        </div>
                        <!-- Modal Detele Data -->

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

                      <th colspan="2" class="kiri"><font size="1"><strong><?php echo $total = "Rp " . number_format($total,0,',','.'); ?></strong></font></th> 
                      
                    </tr>
                  </tfoot>
                <?php } ?>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  <?php } ?>

  <!-- Modal Edit Data -->
  <div class="modal fade" id="ubah-data" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Form Edit Data Cashbon</h4>
        </div>
        <div class="modal-body">
          <p>
            <form id="form-edit-kasbon" method="post" action="<?php echo site_url('cashbon/prosesubah');?>"> 
              <div class="form-group">
                <input type="hidden" id="id" name="id">
                <input type="hidden" id="id_user" name="id_user">
              </div>

              <label for="id_set">ID Input :</label>
              <select id="id_set" class="form-control" name="id_set" required oninvalid="this.setCustomValidity('Kolom ID Input harus diisi')" oninput="setCustomValidity('')" readonly>

              </select>

              <label for="hari">Hari :</label>
              <select id="hari" class="form-control" name="hari" required oninvalid="this.setCustomValidity('Kolom Hari ke harus diisi')" oninput="setCustomValidity('')">
                <option value="">-- Pilih Hari --</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
                <option value="Minggu">Minggu</option>
              </select>

              <label for="id_cabutan">Cabutan Ke :</label>
              <input type="number" id="id_cabutan" class="form-control" name="id_cabutan" placeholder="Cabutan ke ?" />

              <label for="tanggal">Tanggal :</label>
              <div class="form-group">
                <div class='input-group date' id="myDatepicker_edit">
                  <input type='text' id="tanggal" class="form-control" name="tanggal" placeholder="HH-BB-TTTT" />
                  <span class="input-group-addon" id="click">
                   <span class="glyphicon glyphicon-calendar"></span>
                 </span>
               </div>
             </div>

             <?php for($i=1;$i<=$get_jml_lap->jumlah;$i++){?>
              <label for="lap<?= $i; ?>">Kasbon Lap <?= $i; ?> :</label>
              <input type="number" id="kasbon_lap_<?= $i; ?>" class="form-control" name="kasbon_lap_<?= $i; ?>" required oninvalid="this.setCustomValidity('Kolom kasbon Lap <?= $i; ?> harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />
            <?php } ?>

             <label for="l1">Kasbon Leader 1 :</label>
             <input type="number" id="l1" class="form-control" name="l1" required oninvalid="this.setCustomValidity('Kolom kasbon Lap 11 harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

             <label for="l2">Kasbon Leader 2 :</label>
             <input type="number" id="l2" class="form-control" name="l2" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

             <label for="atl">Kasbon Asis TL :</label>
             <input type="number" id="atl" class="form-control" name="atl" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

             <label for="gl">Kasbon Group Leader :</label>
             <input type="number" id="gl" class="form-control" name="gl" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

             <label for="tm">Kasbon Tukang Masak :</label>
             <input type="number" id="tm" class="form-control" name="tm" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

             <label for="tr">Kasbon Training :</label>
             <input type="number" id="tr" class="form-control" name="tr" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />
           </p>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-md btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>
          <button type="submit" class="btn btn-md btn-success"><i class="glyphicon glyphicon-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    // Untuk sunting
    $('#ubah-data').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
        var modal = $(this)
        var id_set = document.getElementById("id_set");
        var hari = div.data("hari");
        var bulan = div.data("bulan");
        var minggu = div.data("minggu");
        var tanggal_awal = div.data("tanggal_awal");
        var tanggal_akhir = div.data("tanggal_akhir");
        var value = div.data("id_set");
        var desc = "Bulan : "+bulan+" - Minggu ke : "+minggu+" ( "+tanggal_awal+" s/d "+tanggal_akhir+" )";


        var optionArray = [""+value+"|"+desc];
        
        for(var option in optionArray){
         var pair = optionArray[option].split("|");
         var newOption = document.createElement("option");
         newOption.value = pair[0];
         newOption.innerHTML = pair[1];
         id_set.options.add(newOption);  
       }
        $('#form-edit-kasbon').trigger('reset');
        // Isi nilai pada field
        modal.find('#id').val(div.data('id'));
        modal.find('#id_set').val(div.data('id_set'));
        modal.find('#id_user').val(div.data('id_user'));
        modal.find('#id_cabutan').val(div.data('id_cabutan'));
        modal.find('#hari').val(hari);
        modal.find('#tanggal').val(div.data('tanggal'));
        modal.find('#kasbon_lap_1').val(div.data('kasbon_lap_1'));
        modal.find('#kasbon_lap_2').val(div.data('kasbon_lap_2'));
        modal.find('#kasbon_lap_3').val(div.data('kasbon_lap_3'));
        modal.find('#kasbon_lap_4').val(div.data('kasbon_lap_4'));
        modal.find('#kasbon_lap_5').val(div.data('kasbon_lap_5'));
        modal.find('#kasbon_lap_6').val(div.data('kasbon_lap_6'));
        modal.find('#kasbon_lap_7').val(div.data('kasbon_lap_7'));
        modal.find('#kasbon_lap_8').val(div.data('kasbon_lap_8'));
        modal.find('#kasbon_lap_9').val(div.data('kasbon_lap_9'));
        modal.find('#kasbon_lap_10').val(div.data('kasbon_lap_10'));
        modal.find('#kasbon_lap_11').val(div.data('kasbon_lap_11'));
        modal.find('#l1').val(div.data('kasbon_l1'));
        modal.find('#l2').val(div.data('kasbon_l2'));
        modal.find('#atl').val(div.data('kasbon_atl'));
        modal.find('#gl').val(div.data('kasbon_gl'));
        modal.find('#tm').val(div.data('kasbon_tm'));
        modal.find('#tr').val(div.data('kasbon_tr'));
        $("#click").click(function() {
          $('#myDatepicker_edit').datetimepicker({
            format: 'DD-MM-YYYY',
            minDate: tanggal_awal,
            maxDate: tanggal_akhir
          });
        });
      });

  $('#ubah-data').on('hidden.bs.modal', function (event) {
    var id_set = document.getElementById("id_set");
    id_set.options.length = 0;
    $('#form-edit-kasbon').trigger('reset');
  });
});
</script>

<!-- Modal Tambah Data kasbon -->
<div class="modal fade" id="modal_tambah_kasbon" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Tambah Data Kasbon</h4>
      </div>
      <div class="modal-body">
        <p>

          <form id="form-add-kasbon" method="post" action="<?php echo site_url('cashbon/simpan');?>">

            <label for="id_set">ID Input :</label>
            <select class="form-control add_id_set" name="id_set" required oninvalid="this.setCustomValidity('Kolom ID Input harus diisi')" oninput="setCustomValidity('')">
              <option value="">-- Pilih ID Input --</option>
              <?php 
              if(!empty($get_set_input)){
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

            <label for="hari">Hari :</label>
            <select id="hari" class="form-control" name="hari" required oninvalid="this.setCustomValidity('Kolom Hari ke harus diisi')" oninput="setCustomValidity('')">
              <option value="">-- Pilih Hari --</option>
              <option value="Senin">Senin</option>
              <option value="Selasa">Selasa</option>
              <option value="Rabu">Rabu</option>
              <option value="Kamis">Kamis</option>
              <option value="Jumat">Jumat</option>
              <option value="Sabtu">Sabtu</option>
              <option value="Minggu">Minggu</option>
            </select>

            <label for="id_cabutan">Cabutan Ke :</label>
            <input type="number" id="id_cabutan" class="form-control" name="id_cabutan" placeholder="Cabutan ke ?" />

            <label for="tanggal">Tanggal :</label>
            <div class="form-group">
              <input type='text' id="myDatepicker_tambah" data-date-format="DD-MM-YYYY" class="form-control" name="tanggal" placeholder="Pilih ID Input" required="required" disabled="" />
            </div>

            <?php for($i=1;$i<=$get_jml_lap->jumlah;$i++){?>
              <label for="lap<?= $i; ?>">Kasbon Lap <?= $i; ?> :</label>
              <input type="number" id="kasbon_lap_<?= $i; ?>" class="form-control" name="kasbon_lap_<?= $i; ?>" required oninvalid="this.setCustomValidity('Kolom kasbon Lap <?= $i; ?> harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />
            <?php } ?>

            <label for="l1">Kasbon Leader 1 :</label>
            <input type="number" id="l1" class="form-control" name="l1" required oninvalid="this.setCustomValidity('Kolom kasbon Lap 11 harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

            <label for="l2">Kasbon Leader 2 :</label>
            <input type="number" id="l2" class="form-control" name="l2" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

            <label for="atl">Kasbon Asis TL :</label>
            <input type="number" id="atl" class="form-control" name="atl" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

            <label for="gl">Kasbon Group Leader :</label>
            <input type="number" id="gl" class="form-control" name="gl" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

            <label for="tm">Kasbon Tukang Masak :</label>
            <input type="number" id="tm" class="form-control" name="tm" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

            <label for="tr">Kasbon Training :</label>
            <input type="number" id="tr" class="form-control" name="tr" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />
          </p>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-md btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>
          <button type="submit" class="btn btn-md btn-success"><i class="glyphicon glyphicon-save"></i> Simpan</button>
        </div>

      </form>
    </div>
  </div>
</div>
<!-- ENDModal Tambah Data kasbon -->

<!--Script Tambah Data-->
<script>
  $(document).ready(function() {
    // Untuk sunting
    $('#modal_tambah_kasbon').on('show.bs.modal', function (event) {
     $('.add_id_set').on('change', function() {
          var id_set = $(".add_id_set").val();
          if(id_set==""){
            $('#myDatepicker_tambah').val("");
            $('#myDatepicker_tambah').attr("disabled","disabled");
          }
          $.ajax({
            url:"<?php echo base_url('cashbon/get_tgl/');?>"+id_set,
            dataType:"JSON",
            cache:false,
            success:function(data){
              var tanggal_awal = data.tanggal_awal;
              var tanggal_akhir = data.tanggal_akhir;

              $('#myDatepicker_tambah').val(tanggal_awal);

              $('#myDatepicker_tambah').removeAttr("disabled","disabled");

              $('#myDatepicker_tambah').daterangepicker({
                locale: {
                  format: 'YYYY/MM/DD'
                },
                singleDatePicker: true,
                showDropdowns: true,
                minDate: tanggal_awal,
                maxDate: tanggal_akhir
              });
            }
          });
      });
   });

    $('#modal_tambah_kasbon').on('hidden.bs.modal', function (event) {
     $('#form-add-kasbon').trigger('reset');
   });
  });
</script>
<!--End Tambah Data-->


<!-- Modal Cari Data kasbon -->
<div class="modal fade" id="modal_cari_data" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Cari Data Kasbon</h4>
      </div>
      <div class="modal-body">
        <p>

          <form id="form-search-kasbon" method="post" action="<?php echo site_url('cashbon');?>">

            <label for="id_set">ID Pencarian :</label>
            <select id="id_set" class="form-control" name="id_set" required oninvalid="this.setCustomValidity('Kolom ID Input harus diisi')" oninput="setCustomValidity('')">
              <?php 
              if(!empty($get_set_input)){
                ?>
                <!--  <option value="reset">Seluruh Data (ALL TIME)</option> -->
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
<!-- ENDModal Cari Data kasbon -->

<!--Script Cari Data-->
<script>
  $(document).ready(function() {
    // Untuk sunting
    $('#modal_cari_data').on('hidden.bs.modal', function (event) {
     $('#form-search-kasbon').trigger('reset');
   });
  });
</script>
<!--End Cari Data-->


<!-- Modal Export Data kasbon -->
<div class="modal fade" id="modal_export_data" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Export Data Kasbon to PDF</h4>
      </div>
      <div class="modal-body">
        <p>

          <form id="form-export-kasbon" method="post" action="<?php echo site_url('export/e_cashbon');?>">

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
                  ?>
                  <option value="<?php echo $data_tambah['id_set'];?>"><?php echo 'Bulan : '.$data_tambah['bulan'].' - Minggu ke : '.$data_tambah['minggu'].' ( '.$tanggal_awal.' s/d '.$tanggal_akhir.' )';?></option>

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
<!-- ENDModal Cari Data kasbon -->

<!--Script Cari Data-->
<script>
  $(document).ready(function() {
    // Untuk sunting
    $('#modal_export_data').on('hidden.bs.modal', function (event) {
     $('#form-export-kasbon').trigger('reset');
   });
  });
</script>
<!--End Cari Data-->


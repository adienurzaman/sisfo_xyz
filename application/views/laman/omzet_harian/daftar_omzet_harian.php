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
                    <button type="button" data-toggle="modal" data-placement="top" data-target="#modal_tambah_omzet" class="btn btn-sm btn-info" title="Tambah Data"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                  </a>
                </li>
                <li>
                  <?php if(empty($get_omzet)){?>
                    <a>
                      <button type="button" onclick="window.location.href='<?php echo base_url()?>omzet'" class="btn btn-sm btn-warning" title="Reset Data"><i class="glyphicon glyphicon-refresh"></i> Reset Data</button>
                    </a>
                  <?php }else{?>
                    <a>
                      <button type="button" data-toggle="modal" data-placement="top" data-target="#modal_cari_data" class="btn btn-sm btn-success" title="Cari Data"><i class="glyphicon glyphicon-search"></i> Cari Data</button>
                    </a>
                  <?php } ?>
                </li>
                <li>
                  <!-- <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> -->
                  <?php if(empty($get_omzet)){?>
                   <a href="">
                    <button type="button" class="btn btn-sm btn-default" title="Export PDF" target="_blank" disabled=""><i class="glyphicon glyphicon-export"></i> Export PDF</button>
                  </a>
                <?php }elseif($id=='0'){
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
          <?php if(empty($get_omzet)){ ?>
            <div class="x_content">
              <div class="table-responsive">

                <table class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr>
                      <th rowspan="3" class="tengah" width="50">No</th>
                      <th rowspan="3" class="tengah" width="85">Bln</th>
                      <th rowspan="3" class="tengah" width="35">Mg</th>
                      <th rowspan="3" class="tengah" width="35">Cab</th>
                      <th rowspan="3" class="tengah" width="60">Hari</th>
                      <th rowspan="3" class="tengah" width="100">Tggl</th>
                      <th colspan="11" class="tengah">Lapangan/Nama</th>
                      <th rowspan="3" class="tengah" width="100">Jml</th>
                      <th rowspan="3" class="tengah" width="150">Aksi</th>
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
                              <th rowspan="3" class="tengah" width="50">No</th>
                              <th rowspan="3" class="tengah" width="85">Bln</th>
                              <th rowspan="3" class="tengah" width="35">Mg</th>
                              <th rowspan="3" class="tengah" width="35">Cab</th>
                              <th rowspan="3" class="tengah" width="60">Hari</th>
                              <th rowspan="3" class="tengah" width="100">Tggl</th>
                              <th colspan="11" class="tengah">Lapangan/Nama</th>
                              <th rowspan="3" class="tengah" width="100">Jml</th>
                              <th rowspan="3" class="tengah" width="150">Aksi</th>
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
                            <?php if($id=='0'){?>
                              <tr>
                                <th colspan="19" class="tengah">Silahkan klik <a data-toggle="modal" data-placement="top" data-target="#modal_cari_data"><u>DISINI</u></a> atau klik button Cari Data di atas untuk menampilkan Data <?php echo @$sess_location; ?></th>
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
                                <th colspan="19" class="tengah">Minggu ke - <?php echo isset($get_omzet[0]['minggu'])?$get_omzet[0]['minggu']:'';?> (<?php echo isset($get_omzet[0]['bulan'])?$get_omzet[0]['bulan']:'';?> - <?php echo $tahun;?>)</th>
                              </tr>
                              <?php
                  //jika data user tidak kosong maka jalankan perintah dibawah ini
                              if(!empty($get_omzet))
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
                                $tmp_bln;
                                $tmp_mg;
                                foreach ($get_omzet as $data) {
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
                                  $jml = "Rp" . number_format($jum,0,',','.');
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
                                    <td><font size="1"> <?php echo $jml; ?></font></td>
                                    <td class='tengah' width="190">
                                      <?php 
                                      if($session['level_user']=='Operator'){
                                        ?>
                                        <!-- Button Edit-->
                                        <div class="btn-group">
                                          <a ref="javascript:;"
                                          data-id="<?php echo $data['id_omzet'];?>"
                                          data-cabutan="<?php echo $data['id_cabutan'];?>"
                                          data-id_user="<?php echo $data['id_user'];?>"
                                          data-id_set="<?php echo $data['id_set'];?>"
                                          data-hari="<?php echo $data['hari'];?>"
                                          data-tanggal="<?php echo $tanggal;?>"
                                          data-omzet_lap_1="<?php echo $data['omzet_lap_1'];?>"
                                          data-omzet_lap_2="<?php echo $data['omzet_lap_2'];?>"
                                          data-omzet_lap_3="<?php echo $data['omzet_lap_3'];?>"
                                          data-omzet_lap_4="<?php echo $data['omzet_lap_4'];?>"
                                          data-omzet_lap_5="<?php echo $data['omzet_lap_5'];?>"
                                          data-omzet_lap_6="<?php echo $data['omzet_lap_6'];?>"
                                          data-omzet_lap_7="<?php echo $data['omzet_lap_7'];?>"
                                          data-omzet_lap_8="<?php echo $data['omzet_lap_8'];?>"
                                          data-omzet_lap_9="<?php echo $data['omzet_lap_9'];?>"
                                          data-omzet_lap_10="<?php echo $data['omzet_lap_10'];?>"
                                          data-omzet_lap_11="<?php echo $data['omzet_lap_11'];?>"

                                          data-bulan="<?php echo $data['bulan'];?>"
                                          data-minggu="<?php echo $data['minggu'];?>"
                                          data-tanggal_awal="<?php echo $data['tanggal_awal'];?>"
                                          data-tanggal_akhir="<?php echo $data['tanggal_akhir'];?>"

                                          data-toggle="modal" data-target="#ubah-data">
                                          <button data-placement="top" class="btn btn-sm btn-warning" title="Edit Data Omzet Harian"><i class="glyphicon glyphicon-edit"></i></button>
                                        </a>
                                        <!-- Button Hapus-->
                                        <a> 
                                          <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_delete<?php echo $data['id_omzet']; ?>" data-placement="top" title="Hapus Data Omzet"><i class="glyphicon glyphicon-trash"></i></button>
                                        </a>
                                        <!-- End Button Hapus-->
                                      </div>
                                      <?php
                                    }    
                                    ?>
                                  </td>  
                                </tr>

                                <!-- Modal Detele Data -->
                                <div class="modal fade" id="modal_delete<?php echo $data['id_omzet']; ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">
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
                                        <a href="<?php echo site_url()."omzet/hapus/".$data['id_omzet'];?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
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
                              <th colspan="2" class="kiri"><font size="1"><strong><?php echo $total = "Rp " . number_format($total,0,',','.'); ?></strong></font></th> 

                            </tr>
                          </tfoot>
                          <?php 
                        } 
                        ?>
                      </table>
                    </div>
                  </div>
                  <?php
                }
                ?>
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
                <h4 class="modal-title" id="myModalLabel">Form Edit Data Omzet</h4>
              </div>
              <div class="modal-body">
                <p>
                  <form id="form-edit-omzet" method="post" action="<?php echo site_url('omzet/prosesubah');?>"> 
                    <div class="form-group">
                      <input type="hidden" id="id" name="id">
                      <input type="hidden" id="id_user" name="id_user">
                    </div>

                    <label for="id_set">ID Input :</label>
                    <select id="id_set" class="form-control" name="id_set" required oninvalid="this.setCustomValidity('Kolom ID Input harus diisi')" oninput="setCustomValidity('')" readonly>

                    </select>

                    <label for="cabutan">ID Cabutan : </label>
                    <input type="number" id="cabutan" class="form-control" name="cabutan" required oninvalid="this.setCustomValidity('Kolom ID Cabutan harus diisi')" oninput="setCustomValidity('')"  placeholder="ID cabutan" />

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
                  <label for="lap<?= $i; ?>">Omzet Lap <?= $i; ?> :</label>
                  <input type="number" id="omzet_lap_<?= $i; ?>" class="form-control" name="omzet_lap_<?= $i; ?>" required oninvalid="this.setCustomValidity('Kolom Omzet Lap <?= $i; ?> harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />
                  <?php } ?>
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

     $('#form-edit-omzet').trigger('reset');
      // Isi nilai pada field
      modal.find('#id').val(div.data('id'));
      modal.find('#cabutan').val(div.data('cabutan'));
      modal.find('#id_set').val(div.data('id_set'));
      modal.find('#id_user').val(div.data('id_user'));
      modal.find('#hari').val(hari);
      modal.find('#tanggal').val(div.data('tanggal'));
      modal.find('#omzet_lap_1').val(div.data('omzet_lap_1'));
      modal.find('#omzet_lap_2').val(div.data('omzet_lap_2'));
      modal.find('#omzet_lap_3').val(div.data('omzet_lap_3'));
      modal.find('#omzet_lap_4').val(div.data('omzet_lap_4'));
      modal.find('#omzet_lap_5').val(div.data('omzet_lap_5'));
      modal.find('#omzet_lap_6').val(div.data('omzet_lap_6'));
      modal.find('#omzet_lap_7').val(div.data('omzet_lap_7'));
      modal.find('#omzet_lap_8').val(div.data('omzet_lap_8'));
      modal.find('#omzet_lap_9').val(div.data('omzet_lap_9'));
      modal.find('#omzet_lap_10').val(div.data('omzet_lap_10'));
      modal.find('#omzet_lap_11').val(div.data('omzet_lap_11'));
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
      $('#form-edit-omzet').trigger('reset');
    });
  });
</script>

<!-- Modal Tambah Data Omzet -->
<div class="modal fade" id="modal_tambah_omzet" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Tambah Data Omzet Harian</h4>
      </div>
      <div class="modal-body">
        <p>

          <form id="form-add-omzet" method="post" action="<?php echo site_url('omzet/simpan');?>">

            <?php
            if(!empty($get_set_persen)){
              foreach ($get_set_persen as $data_persen) {
                ?>

                <input type="hidden" id="gs" name="gs" value="<?php echo $data_persen['gaji_sales'] ?>">
                <input type="hidden" id="tl1" name="tl1" value="<?php echo $data_persen['gaji_team_leader_1'] ?>">
                <input type="hidden" id="tl2" name="tl2" value="<?php echo $data_persen['gaji_team_leader_2'] ?>">
                <input type="hidden" id="gl" name="gl" value="<?php echo $data_persen['gaji_grouf_leader'] ?>">

                <?php
              }
            }
            ?>

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
                  <option value="<?php echo $data_tambah['id_set'];?>"><?php echo 'Bulan : '.$data_tambah['bulan'].' - Minggu : '.$data_tambah['minggu'].' ( '.$tanggal_awal.' s/d '.$tanggal_akhir.' )';?>
                  </option>

                  <?php
                }
              }else{
                ?>
                <option value="">Data Belum Ada, Segera Lakukan Setting Input</option>
                <?php
              }
              ?>
            </select>

            <label for="cabutan">ID Cabutan : </label>
            <input type="number" id="cabutan" class="form-control" name="cabutan" required oninvalid="this.setCustomValidity('Kolom ID Cabutan harus diisi')" oninput="setCustomValidity('')"  placeholder="ID cabutan" />

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

            <label for="tanggal">Tanggal :</label>
            <div class="form-group">
              <input type='text' id="myDatepicker_tambah" class="form-control" data-date-format="DD-MM-YYYY" name="tanggal" placeholder="Pilih ID Input" required="required" disabled="" />
            </div>

            <?php for($i=1;$i<=$get_jml_lap->jumlah;$i++){?>
              <label for="lap<?= $i; ?>">Omzet Lap <?= $i; ?> :</label>
              <input type="number" id="omzet_lap_<?= $i; ?>" class="form-control" name="omzet_lap_<?= $i; ?>" required oninvalid="this.setCustomValidity('Kolom Omzet Lap <?= $i; ?> harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />
            <?php } ?>
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
<!-- ENDModal Tambah Data Omzet -->

<!--Script Tambah Data-->
<script>
  $(document).ready(function() {
    // Untuk sunting
    $('#modal_tambah_omzet').on('show.bs.modal', function (event) {
      $('.add_id_set').on('change', function() {
          var id_set = $(".add_id_set").val();
          if(id_set==""){
            $('#myDatepicker_tambah').val("");
            $('#myDatepicker_tambah').attr("disabled","disabled");
          }
          $.ajax({
            url:"<?php echo base_url('omzet/get_tgl/');?>"+id_set,
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

    $('#modal_tambah_omzet').on('hidden.bs.modal', function (event) {
     $('#form-add-omzet').trigger('reset');
    });
  });
</script>
<!--End Tambah Data-->

<!-- Modal Cari Data Omzet -->
<div class="modal fade" id="modal_cari_data" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Cari Data Omzet</h4>
      </div>
      <div class="modal-body">
        <p>

          <form id="form-search-omzet" method="post" action="<?php echo site_url('omzet');?>">

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
        <h4 class="modal-title" id="myModalLabel">Export Data Omzet to PDF</h4>
      </div>
      <div class="modal-body">
        <p>

          <form id="form-export-omzet" method="post" action="<?php echo site_url('export/e_omzet');?>">

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


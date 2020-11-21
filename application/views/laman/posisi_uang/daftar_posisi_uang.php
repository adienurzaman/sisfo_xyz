<?php error_reporting(0); ?>
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
              <h2><middle><span class="fa fa-database"></span> Data  <?php echo @$sess_location; ?> </middle></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li>
                  <?php if(empty($get_all)){?>
                    <a>
                      <button type="button" onclick="window.location.href='<?php echo base_url()?>posisi_uang'" class="btn btn-sm btn-warning" title="Reset Data"><i class="glyphicon glyphicon-refresh"></i> Reset Data</button>
                    </a>
                  <?php }else{?>
                    <a>
                      <button type="button" data-toggle="modal" data-placement="top" data-target="#modal_cari_data" class="btn btn-sm btn-success" title="Cari Data"><i class="glyphicon glyphicon-search"></i> Cari Data</button>
                    </a>
                  <?php } ?>
                </li>
                <li>
                  <!-- <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> -->
                  <?php if(empty($get_all)){?>
                   <a href="">
                    <button type="button" class="btn btn-sm btn-default" title="Export PDF" target="_blank" disabled=""><i class="glyphicon glyphicon-export"></i> Export PDF</button>
                  </a>
                <?php }elseif($get_id=='1'){
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
                    <th rowspan="2" class="tengah" width="85">Bulan</th>
                    <th rowspan="2" class="tengah" width="35">Minggu</th>
                    <th rowspan="2" class="tengah" width="60">Hari</th>
                    <th rowspan="2" class="tengah" width="100">Tanggal</th>
                    <th colspan="3" class="tengah">Item Perhitungan</th>
                    <th rowspan="2" class="tengah" width="150">Posisi Uang</th>
                  </tr>
                  <tr>
                    <th rowspan="1" class="tengah" width="200">Total Omzet</th>
                    <th rowspan="1" class="tengah" width="200">Total Casbon</th>
                    <th rowspan="1" class="tengah" width="200">Total Biaya Operasional</th>
                  </tr>
                </thead>
                <?php if($get_id=='1'){?>
                  <tr>
                    <th colspan="9" class="tengah">Silahkan klik <a data-toggle="modal" data-placement="top" data-target="#modal_cari_data"><u>DISINI</u></a> atau klik button Cari Data di atas untuk menampilkan Data <?php echo @$sess_location; ?> </th>
                  </tr>
                <?php }else{ ?>
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
                          $total_o = 0;
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
                          <td class="tengah"><font size="2"><?php echo $no; ?></font></td>
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
          <h4 class="modal-title" id="myModalLabel">Cari Data Posisi Uang</h4>
        </div>
        <div class="modal-body">
          <p>

            <form id="form-search" method="post" action="<?php echo site_url('posisi_uang');?>">

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
  <!-- ENDModal Cari Data Omzet -->

  <!--Script Cari Data-->
  <script>
    $(document).ready(function() {
                      // Untuk sunting
                      $('#modal_cari_data').on('hidden.bs.modal', function (event) {
                       $('#form-search').trigger('reset');
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
                          <h4 class="modal-title" id="myModalLabel">Export Data Posisi Uang to PDF</h4>
                        </div>
                        <div class="modal-body">
                          <p>

                            <form id="form-export" method="post" action="<?php echo site_url('export/e_posisi_uang');?>">

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
                  <!-- ENDModal Cari Data Omzet -->

                  <!--Script Cari Data-->
                  <script>
                    $(document).ready(function() {
                      // Untuk sunting
                      $('#modal_export_data').on('hidden.bs.modal', function (event) {
                       $('#form-export').trigger('reset');
                     });
                    });
                  </script>
                  <!--End Cari Data-->


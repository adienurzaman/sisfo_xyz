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
                    <button type="button" data-toggle="modal" data-placement="top" data-target="#modal_tambah_biaya_op" class="btn btn-sm btn-info" title="Tambah Data"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                  </a>
                </li>
                <li>
                  <?php if(empty($get_biaya)){?>
                    <a>
                      <button type="button" onclick="window.location.href='<?php echo base_url()?>biaya_op'" class="btn btn-sm btn-warning" title="Reset Data"><i class="glyphicon glyphicon-refresh"></i> Reset Data</button>
                    </a>
                  <?php }else{?>
                    <a>
                      <button type="button" data-toggle="modal" data-placement="top" data-target="#modal_cari_data" class="btn btn-sm btn-success" title="Cari Data"><i class="glyphicon glyphicon-search"></i> Cari Data</button>
                    </a>
                  <?php } ?>
                </li>
                <li>
                  <!-- <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> -->
                  <?php if(empty($get_biaya)){?>
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
                      <th rowspan="2" class="tengah" width="35">ID Cabutan</th>
                      <th rowspan="2" class="tengah" width="60">Hari</th>
                      <th rowspan="2" class="tengah" width="100">Tanggal</th>
                      <th colspan="5" class="tengah">Item Biaya Operasional</th>
                      <th rowspan="2" class="tengah" width="100">Jumlah</th>
                      <th rowspan="2" class="tengah" width="150">Aksi</th>
                    </tr>
                    <tr>
                      <th rowspan="1" class="tengah" width="100">Beras</th>
                      <th rowspan="1" class="tengah" width="100">Air Galon</th>
                      <th rowspan="1" class="tengah" width="100">Gas LPG</th>
                      <th rowspan="1" class="tengah" width="100">Resiko</th>
                      <th rowspan="1" class="tengah" width="100">Lain-lain</th>
                    </tr>
                  </thead>
                  <?php if($get_id=='1'){ ?>
                    <tr>
                      <th colspan="13" class="tengah">Silahkan klik <a data-toggle="modal" data-placement="top" data-target="#modal_cari_data"><u>DISINI</u></a> atau klik button Cari Data di atas untuk menampilkan Data <?php echo @$sess_location; ?> </th>
                    </tr>
                  <?php }else{ ?>
                    <tbody>
                      <?php 
                      $v = isset($get_biaya[0]['tanggal_awal'])?$get_biaya[0]['tanggal_awal']:'';
                      $tgl_a = date_create($v);
                      $tahun = date_format($tgl_a,'Y');
                      ?>
                      <tr>
                        <th colspan="13" class="tengah">Minggu ke - <?php echo isset($get_biaya[0]['minggu'])?$get_biaya[0]['minggu']:'';?> (<?php echo isset($get_biaya[0]['bulan'])?$get_biaya[0]['bulan']:'';?> - <?php echo $tahun;?>)</th>
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
                            <td class="tengah"><font size="2"><?php echo $no; ?></font></td>
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
                            <td class='tengah' width="95">
                              <?php 
                              if($session['level_user']=='Operator'){
                                ?>
                                <!-- Button Edit-->
                                <div class="btn-group">
                                  <a ref="javascript:;"
                                  data-id="<?php echo $data['id_rincian'];?>"
                                  data-id_user="<?php echo $data['id_user'];?>"
                                  data-id_set="<?php echo $data['id_set'];?>"
                                  data-id_cabutan="<?php echo $data['id_cabutan'];?>"
                                  data-hari="<?php echo $data['hari'];?>"
                                  data-tanggal="<?php echo $tanggal;?>"
                                  data-biaya_beras="<?php echo $data['biaya_beras'];?>"
                                  data-biaya_air_galon="<?php echo $data['biaya_air_galon'];?>"
                                  data-biaya_gas="<?php echo $data['biaya_gas'];?>"
                                  data-biaya_resiko="<?php echo $data['biaya_resiko'];?>"
                                  data-biaya_lain="<?php echo $data['biaya_lain'];?>"

                                  data-bulan="<?php echo $data['bulan'];?>"
                                  data-minggu="<?php echo $data['minggu'];?>"
                                  data-tanggal_awal="<?php echo $data['tanggal_awal'];?>"
                                  data-tanggal_akhir="<?php echo $data['tanggal_akhir'];?>"

                                  data-toggle="modal" data-target="#ubah-data">
                                  <button data-placement="top" class="btn btn-sm btn-warning" title="Edit Data Rincian Biaya Operasional"><i class="glyphicon glyphicon-edit"></i> Edit</button>
                                </a>
                                <!-- Button Hapus-->
                                <a> 
                                  <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_delete<?php echo $data['id_rincian']; ?>" data-placement="top" title="Hapus Data Rincian Biaya Operasional"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
                                </a>
                                <!-- End Button Hapus-->
                              </div>
                              <?php
                            }    
                            ?>
                          </td>  

                        </tr>

                        <!-- Modal Detele Data -->
                        <div class="modal fade" id="modal_delete<?php echo $data['id_rincian']; ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">
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
                                <a href="<?php echo site_url()."biaya_op/hapus/".$data['id_rincian'];?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
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
                <?php if(!empty($get_biaya)){?>
                  <tfoot>
                    <tr>                

                      <th colspan="6" class="tengah">Total Jumlah</th>
                      <th colspan="1" class="kiri"><font size="2"><strong><?php echo $tl1 = "Rp " . number_format($tl1,0,',','.'); ?></strong></font></th>
                      <th colspan="1" class="kiri"><font size="2"><strong><?php echo $tl2 = "Rp " . number_format($tl2,0,',','.'); ?></strong></font></th>
                      <th colspan="1" class="kiri"><font size="2"><strong><?php echo $tl3 = "Rp " . number_format($tl3,0,',','.'); ?></strong></font></th>
                      <th colspan="1" class="kiri"><font size="2"><strong><?php echo $tl4 = "Rp " . number_format($tl4,0,',','.'); ?></strong></font></th>
                      <th colspan="1" class="kiri"><font size="2"><strong><?php echo $tl5 = "Rp " . number_format($tl5,0,',','.'); ?></strong></font></th>
                      <th colspan="2" class="kiri"><font size="2"><strong><?php echo $total = "Rp " . number_format($total,0,',','.'); ?></strong></font></th> 
                 
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
          <h4 class="modal-title" id="myModalLabel">Form Edit Data Biaya Operasional</h4>
        </div>
        <div class="modal-body">
          <p>
            <form id="form-edit-biaya-op" method="post" action="<?php echo site_url('biaya_op/prosesubah');?>"> 
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

             <label for="biaya_beras">Biaya Beras :</label>
             <input type="number" id="biaya_beras" class="form-control" name="biaya_beras" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

             <label for="biaya_air_galon">Biaya Air Galon :</label>
             <input type="number" id="biaya_air_galon" class="form-control" name="biaya_air_galon" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

             <label for="biaya_gas">Biaya Gas LPG :</label>
             <input type="number" id="biaya_gas" class="form-control" name="biaya_gas" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

             <label for="biaya_resiko">Biaya Resiko :</label>
             <input type="number" id="biaya_resiko" class="form-control" name="biaya_resiko" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

             <label for="biaya_lain">Biaya Lain :</label>
             <input type="number" id="biaya_lain" class="form-control" name="biaya_lain" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />
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

        // Isi nilai pada field
        modal.find('#id').val(div.data('id'));
        modal.find('#id_set').val(div.data('id_set'));
        modal.find('#id_user').val(div.data('id_user'));
        modal.find('#hari').val(hari);
        modal.find('#id_cabutan').val(div.data('id_cabutan'));
        modal.find('#tanggal').val(div.data('tanggal'));
        modal.find('#biaya_beras').val(div.data('biaya_beras'));
        modal.find('#biaya_air_galon').val(div.data('biaya_air_galon'));
        modal.find('#biaya_gas').val(div.data('biaya_gas'));
        modal.find('#biaya_resiko').val(div.data('biaya_resiko'));
        modal.find('#biaya_lain').val(div.data('biaya_lain'));
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
      $('#form-edit-biaya-op').trigger('reset');
    });
});
</script>

<!-- Modal Tambah Data Biaya OP -->
<div class="modal fade" id="modal_tambah_biaya_op" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Tambah Data Biaya Operasional</h4>
      </div>
      <div class="modal-body">
        <p>

          <form id="form-add-biaya-op" method="post" action="<?php echo site_url('biaya_op/simpan');?>">

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


            <label for="biaya_beras">Biaya Beras :</label>
            <input type="number" id="biaya_beras" class="form-control" name="biaya_beras" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

            <label for="biaya_air_galon">Biaya Air Galon :</label>
            <input type="number" id="biaya_air_galon" class="form-control" name="biaya_air_galon" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

            <label for="biaya_gas">Biaya Gas LPG :</label>
            <input type="number" id="biaya_gas" class="form-control" name="biaya_gas" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

            <label for="biaya_resiko">Biaya Resiko :</label>
            <input type="number" id="biaya_resiko" class="form-control" name="biaya_resiko" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

            <label for="biaya_lain">Biaya Lain :</label>
            <input type="number" id="biaya_lain" class="form-control" name="biaya_lain" required oninvalid="this.setCustomValidity('Kolom ini harus diisi')" oninput="setCustomValidity('')"  placeholder="Exs : 200000" />

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
<!-- END Modal Tambah Data Biaya OP -->

<!--Script Tambah Data-->
<script>
  $(document).ready(function() {
    // Untuk sunting
    $('#modal_tambah_biaya_op').on('show.bs.modal', function (event){
      $('.add_id_set').on('change', function() {
          var id_set = $(".add_id_set").val();
          if(id_set==""){
            $('#myDatepicker_tambah').val("");
            $('#myDatepicker_tambah').attr("disabled","disabled");
          }
          $.ajax({
            url:"<?php echo base_url('biaya_op/get_tgl/');?>"+id_set,
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

    $('#modal_tambah_biaya_op').on('hidden.bs.modal', function (event) {
     $('#form-add-biaya-op').trigger('reset');
   });
  });
</script>
<!--End Tambah Data-->


<!-- Modal Cari Data Biaya Op -->
<div class="modal fade" id="modal_cari_data" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Cari Data Biaya Operasional</h4>
      </div>
      <div class="modal-body">
        <p>

          <form id="form-search-biaya-op" method="post" action="<?php echo site_url('biaya_op');?>">

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
<!-- ENDModal Cari Data kasbon -->

<!--Script Cari Data-->
<script>
  $(document).ready(function() {
    // Untuk sunting
    $('#modal_cari_data').on('hidden.bs.modal', function (event) {
     $('#form-search-biaya-op').trigger('reset');
   });
  });
</script>
<!--End Cari Data-->


<!-- Modal Export Data Biaya OP -->
<div class="modal fade" id="modal_export_data" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Export Data Biaya Operasional to PDF</h4>
      </div>
      <div class="modal-body">
        <p>

          <form id="form-export-biaya-op" method="post" action="<?php echo site_url('export/e_biaya_op');?>">

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
     $('#form-export-biaya-op').trigger('reset');
   });
  });
</script>
<!--End Cari Data-->


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

}

?>



<div class="right_col" role="main">

  <div class="page-title">

    <div class="title_left">

      <!-- <h3>Operator <middle>Laman Setting Pelaporan Credit</middle></h3> -->

    </div>

  </div>  

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

                <?php 

                if($session['level_user']=='Operator'){

                  if(empty($get_jml_lap)){

                    ?>

                    <li>

                      <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_tambah" data-placement="top" title="Tambah Data Setting Pelaporan"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>

                    </li>

                    <?php

                  }else{

                    ?>

                    <li>

                      <a>

                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_tambah" data-placement="top" title="Tambah Data Setting Pelaporan"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>

                      </a>

                    </li>

                    <?php

                  }

                }else{}?>

              </ul>

              <div class="clearfix"></div>

            </div>

            <div class="x_content"> 

              <div>

                <?php

                if($session['level_user']=='Operator'){

                  $id="id='datatable'";

                }else{

                  $id="";

                }

                ?>

                <?php

                if(empty($get_pelaporan)){

                  ?>

                  <table class="table table-striped table-hover table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                    <?php

                  }else{

                    ?>

                    <table <?php echo $id;?> class="table table-striped table-hover table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                      <?php 

                    }

                    ?>

                    <thead>

                      <tr>                

                        <th width="50">No</th>

                        <th width="100">ID Operator</th>

                        <th width="150">Bulan</th>

                        <th width="50">Mingguan</th>

                        <th width="350">Tanggal Awal</th>

                        <th width="350">Tanggal Akhir</th>

                        <th>Aksi</th>

                      </tr>

                    </thead>

                    <tbody>

                      <?php

                  //jika data user tidak kosong maka jalankan perintah dibawah ini

                      if(!empty($get_pelaporan))

                      {

                    //load data user

                        $no=1;

                        foreach ($get_pelaporan as $data)

                        {

                          $id = $data['id_set'];

                          $id_user = $data['id_user'];

                          $bulan = $data['bulan'];

                          $minggu = $data['minggu']; 

                          $tanggal_awal = $data['tanggal_awal'];

                          $tanggal_akhir = $data['tanggal_akhir'];

                          ?>  

                          <tr>

                            <td><?php echo $no; ?></td>

                            <td><?php echo $id_user; ?></td>

                            <td><?php echo $bulan; ?></td>

                            <td><?php echo $minggu; ?></td>

                            <?php 

                            $tgl_1 = date_create($tanggal_awal);

                            $tgl_awal = date_format($tgl_1, "d-m-Y");

                            $tgl_2= date_create($tanggal_akhir);

                            $tgl_akhir = date_format($tgl_2, "d-m-Y"); 

                            ?>

                            <td><?php echo $tgl_awal; ?></td>

                            <td><?php echo $tgl_akhir; ?></td>                      

                            <td class='center' width='152'>

                              <!-- Button Ubah-->

                              <div class="btn-group">

                                <a href="javascript:;"

                                data-id="<?php echo $data['id_set'];?>"

                                data-id_user="<?php echo $data['id_user'];?>"

                                data-bulan="<?php echo $data['bulan'];?>"

                                data-minggu="<?php echo $data['minggu'];?>"

                                data-tanggal_awal="<?php echo $tgl_awal;?>"

                                data-tanggal_akhir="<?php echo $tgl_akhir;?>"

                                data-toggle="modal" data-target="#ubah-data">

                                <button  class="btn btn-sm btn-warning" title="Edit Data Setting Pelaporan"><i class="glyphicon glyphicon-edit"></i> Edit</button>

                              </a>

                            </div>

                            <!-- End Button Ubah-->



                            <?php 

                            if($session['level_user']=='Operator'){

                              ?>

                              <!-- Button Hapus-->

                              <div class="btn-group">

                                <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_delete<?php echo $data['id_set']; ?>" data-placement="top" title="Hapus Data Setting Pelaporan"><i class="glyphicon glyphicon-trash"></i> Hapus</a>

                              </div>

                              <!-- End Button Hapus-->

                              <?php

                            }    



                            ?>

                          </td>

                        </tr>



                        <!-- Modal Detele Data -->

                        <div class="modal fade" id="modal_delete<?php echo $data['id_set']; ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">

                          <div class="modal-dialog modal-md">

                            <div class="modal-content">

                              <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>

                                </button>

                                <h4 class="modal-title" id="myModalLabel2">Konfirmasi Hapus Data</h4>

                              </div>

                              <div class="modal-body">

                                <p>Dengan menghapus data ini maka data-data lain yang merujuk kepada data ini ikut terdelete. Periksa Kembali Data anda sebelum dihapus. Silahkan klik tombol <strong> Hapus </strong> untuk menghapus data</p>

                              </div>

                              <div class="modal-footer">

                                <button type="button" class="btn btn-success" data-dismiss="modal"><i class="glyphicon glyphicon-backward"></i> Kembali</button>

                                <a href="<?php echo site_url()."set_pelaporan/hapus/".$data['id_set'];?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>

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





                  <!-- Modal Edit Data -->

                  <div class="modal fade" id="ubah-data" tabindex="-1" role="dialog" aria-hidden="true">

                    <div class="modal-dialog modal-md">

                      <div class="modal-content">



                        <div class="modal-header">

                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>

                          </button>

                          <h4 class="modal-title" id="myModalLabel">Form Edit Data <br>Setting Pelaporan Input Credit</h4>

                        </div>

                        <div class="modal-body">

                          <p>

                            <form id="form-edit-setting" method="post" action="<?php echo site_url('set_pelaporan/prosesubah');?>"> 

                              <div class="form-group">

                                <input type="hidden" id="id" name="id">

                                <input type="hidden" id="id_user" name="id_user">

                              </div>



                              <label for="bulan">Bulan :</label>

                              <select id="bulan" class="form-control" name="bulan" required oninvalid="this.setCustomValidity('Kolom Bulan ke harus diisi')" oninput="setCustomValidity('')">

                                <option value="">-- Pilih Bulan --</option>

                                <option value="Januari">Januari</option>

                                <option value="Februari">Februari</option>

                                <option value="Maret">Maret</option>

                                <option value="April">April</option>

                                <option value="Mei">Mei</option>

                                <option value="Juni">Juni</option>

                                <option value="Juli">Juli</option>

                                <option value="Agustus">Agustus</option>

                                <option value="September">September</option>

                                <option value="Oktober">Oktober</option>

                                <option value="November">November</option>

                                <option value="Desember">Desember</option>

                              </select>



                              <label for="minggu">Minggu :</label>

                              <select id="minggu" class="form-control" name="minggu" required oninvalid="this.setCustomValidity('Kolom Minggu ke harus diisi')" oninput="setCustomValidity('')">

                                <option value="">-- Pilih Minggu --</option>
                                <?php for($i=1;$i<=5;$i++){ ?>
                                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>

                              </select>

                              <label for="tanggal_awal">Tanggal Awal :</label>

                              <div class="form-group">

                                <div class='input-group date' id="myDatepicker_tawal_edit">

                                  <input type="text" id="tanggal_awal" class="form-control" name="tanggal_awal" required oninvalid="this.setCustomValidity('Kolom Tanggal Awal ke harus diisi')" oninput="setCustomValidity('')" placeholder="HH-BB-TTTT" />

                                  <span class="input-group-addon">

                                   <span class="glyphicon glyphicon-calendar"></span>

                                 </span>

                               </div>

                             </div>

                             

                             <label for="tanggal_akhir">Tanggal Akhir :</label>

                             <div class="form-group">

                              <div class='input-group date' id="myDatepicker_takhir_edit">

                                <input type="text" id="tanggal_akhir" class="form-control" name="tanggal_akhir" required oninvalid="this.setCustomValidity('Kolom Tanggal Akhir ke harus diisi')" oninput="setCustomValidity('')" placeholder="HH-BB-TTTT" />

                                <span class="input-group-addon">

                                 <span class="glyphicon glyphicon-calendar"></span>

                               </span>

                             </div>

                           </div>

                           

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

                          // Isi nilai pada field

                          modal.find('#id').val(div.data('id'));

                          modal.find('#id_user').val(div.data('id_user'));

                          modal.find('#bulan').val(div.data('bulan'));

                          modal.find('#minggu').val(div.data('minggu'));

                          modal.find('#tanggal_awal').val(div.data('tanggal_awal'));

                          modal.find('#tanggal_akhir').val(div.data('tanggal_akhir'));

                          $('#myDatepicker').datetimepicker();

                          $('#myDatepicker_tawal_edit').datetimepicker({

                            format: 'DD-MM-YYYY'

                          });

                          $('#myDatepicker_takhir_edit').datetimepicker({

                            format: 'DD-MM-YYYY'

                          });

                        });

                      $('#ubah-data').on('hidden.bs.modal', function (event) {

                        $('#form-edit-setting').trigger('reset');

                      });

                    });

                  </script>



                  <!-- Modal Tambah Data Setting Input -->

                  <div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-hidden="true">

                    <div class="modal-dialog modal-md">

                      <div class="modal-content">



                        <div class="modal-header">

                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>

                          </button>

                          <h4 class="modal-title" id="myModalLabel">Form Tambah Data Setting Input Pelaporan Credit</h4>

                        </div>

                        <div class="modal-body">

                          <p>

                            <form id="form-add-set" method="post" action="<?php echo site_url('set_pelaporan/simpan');?>"> 

                              <div class="form-group">

                                <input type="hidden" id="id" name="id">

                                <input type="hidden" id="id_user" name="id_user">

                              </div>



                              <label for="bulan">Bulan :</label>

                              <select id="bulan" class="form-control" name="bulan" required oninvalid="this.setCustomValidity('Kolom Bulan ke harus diisi')" oninput="setCustomValidity('')">

                                <option value="">-- Pilih Bulan --</option>

                                <option value="Januari">Januari</option>

                                <option value="Februari">Februari</option>

                                <option value="Maret">Maret</option>

                                <option value="April">April</option>

                                <option value="Mei">Mei</option>

                                <option value="Juni">Juni</option>

                                <option value="Juli">Juli</option>

                                <option value="Agustus">Agustus</option>

                                <option value="September">September</option>

                                <option value="Oktober">Oktober</option>

                                <option value="November">November</option>

                                <option value="Desember">Desember</option>

                              </select>



                              <label for="minggu">Minggu :</label>

                              <select id="minggu" class="form-control" name="minggu" required oninvalid="this.setCustomValidity('Kolom Minggu ke harus diisi')" oninput="setCustomValidity('')">

                                <option value="">-- Pilih Minggu --</option>
                                <?php for($i=1;$i<=5;$i++){ ?>
                                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>                        

                              </select>



                              <label for="tanggal_awal">Tanggal Awal :</label>

                              <input type="text" id="myDatepicker_tawal_tambah" data-date-format="DD-MM-YYYY" class="form-control" name="tanggal_awal" placeholder="HH-BB-TTTT" required oninvalid="this.setCustomValidity('Kolom Tanggal Awal ke harus diisi')" oninput="setCustomValidity('')" />



                              <label for="tanggal_akhir">Tanggal Akhir :</label>

                              <input type="text" id="myDatepicker_takhir_tambah" data-date-format="DD-MM-YYYY" class="form-control" name="tanggal_akhir" placeholder="HH-BB-TTTT" required oninvalid="this.setCustomValidity('Kolom Tanggal Akhir ke harus diisi')" oninput="setCustomValidity('')" />

                            </p>

                          </div>

                          <div class="modal-footer">

                            <button type="button" class="btn btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>

                            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Simpan</button>

                          </div>

                        </form>

                      </div>

                    </div>

                  </div>



                  <script type="text/javascript">

                    $('#modal_tambah').on('show.bs.modal', function (event) {

                      $('#myDatepicker_tawal_tambah').datetimepicker();

                      $('#myDatepicker_takhir_tambah').datetimepicker();

                    });

                    $('#modal_tambah').on('hidden.bs.modal', function (event) {

                      $('#form-add-set').trigger('reset');

                    });

                  </script>

                </tbody>

              </table>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>



  

  
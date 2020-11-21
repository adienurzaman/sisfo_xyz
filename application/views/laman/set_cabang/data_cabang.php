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

}?>



<div class="right_col" role="main">

  <div class="page-title">

    <div class="title_left">

      <!-- <h3>User <middle>Laman Data User</middle></h3> -->

    </div>

  </div>  

  <!--Content-->

  <?php if($session['level_user']=='Admin'){?>

    <div class="row">

      <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel">

          <div class="x_title">

            <h2><middle><span class="fa fa-cog"></span> Halaman <?php echo @$sess_location; ?></middle></h2>

            <ul class="nav navbar-right panel_toolbox">

              <?php if($session['level_user']=='Admin'){?>

                <li>

                  <button data-toggle="tooltip" data-placement="left" title="Kembali Ke Welcome Page"  class="btn btn-sm btn-warning" onclick="window.location.href='<?php echo base_url()?>backend/welcome'"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali ke Halaman Utama</button>

                </li>

              <?php }?>



            </ul>

            <div class="clearfix"></div>

          </div>

        </div>

        <?php

      }

      ?>

      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">

          <div class="x_panel">

            <div class="x_title">

              <h2><middle><span class="fa fa-database"></span> Data <?php echo @$sess_location; ?></middle></h2>

              <ul class="nav navbar-right panel_toolbox">
                <?php if($session['level_user']=='Admin'){?>

                  <li>

                    <button type="button" data-placement="top" title="Tambah Data User" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_tambah"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>

                  </li>

                <?php }else{?>

                  <li>

                    <button type="button" data-toggle="tooltip" data-placement="left" title="Kembali Ke Welcome Page" class="btn btn-sm btn-warning" onclick="window.location.href='<?php echo base_url()?>backend/welcome'"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali</button>



                  </li>

                <?php }?>

              </ul>

              <div class="clearfix"></div>

            </div>



            <div class="x_content"> 

              <div class='table-responsive'>

                <?php

                if($session['level_user']=='Admin'){

                  $id="id='datatable'";

                }else{

                  $id="";

                }

                ?>

                <?php

                if(empty($cabang)){

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

                        <th>No</th>

                        <th>Nama Cabang</th>

                        <th>Alamat</th>

                        <th>Aksi</th>

                      </tr>

                    </thead>

                    <tbody>

                      <?php

                  //jika data user tidak kosong maka jalankan perintah dibawah ini

                      if(!empty($cabang))

                      {

                        $no=1;

                    //load data user

                        foreach ($cabang as $data)

                        {

                          ?>  

                          <td><?php echo $no; ?></td>

                          <td><?php echo $data->nama_cabang; ?></td>

                          <td><?php echo $data->alamat_cabang; ?></td>

                          <td class='center' width='159'>

                            <!-- Button Ubah-->

                            <a href="javascript:void(0);"

                              data-id="<?php echo $data->id_cabang;?>"

                              data-nama_cabang="<?php echo $data->nama_cabang;?>"

                              data-alamat_cabang="<?php echo $data->alamat_cabang;?>"

                              class="btn btn-sm btn-warning edit" title="Edit Data User"><i class="glyphicon glyphicon-edit"></i> Edit

                            </a>

                          <!-- End Button Ubah-->

                          <!-- Button Hapus-->

                          <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_delete<?php echo $data->id_cabang; ?>" data-placement="top" title="Hapus Data User"><i class="glyphicon glyphicon-trash"></i> Hapus</a>

                          <!-- End Button Hapus-->

                        </td>

                      </tr>



                      <!-- ================================================================================================= -->

                      <!-- Modal Detele Data -->

                      <div class="modal fade" id="modal_delete<?php echo $data->id_cabang; ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">

                        <div class="modal-dialog modal-md">

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

                              <a href="<?php echo site_url()."set_cabang/hapus/".$data->id_cabang;?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>

                            </div>



                          </div>

                        </div>

                      </div>

                      <!-- Modal Detele Data -->



                      <!-- ================================================================================================= -->





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





                <!-- ================================================================================================= -->

                <!-- Modal Tambah Data -->

                <div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-hidden="true">

                  <div class="modal-dialog modal-md">

                    <div class="modal-content">



                      <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>

                        </button>

                        <h4 class="modal-title" id="myModalLabel">Form Tambah Data</h4>

                      </div>

                      <div class="modal-body">

                        <p>

                          <form id="form_tambah_data" method="post" action="<?php echo site_url('set_cabang/simpan');?>">



                            <label for="nama_cabang">Nama Cabang * :</label>

                            <input type="text" class="form-control" name="nama_cabang" required oninvalid="this.setCustomValidity('Kolom nama cabang harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan nama cabang" />



                            <label for="alamat">Alamat * :</label>

                            <textarea type="text" class="form-control" name="alamat_cabang" required oninvalid="this.setCustomValidity('Kolom alamat harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan Alamat"></textarea>





                          </div>

                          <div class="modal-footer">

                            <button type="button" class="btn btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>

                            <button type="reset" class="btn btn-warning"><i class="glyphicon glyphicon-refresh"></i> Reset</button>

                            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Simpan</span>

                            </div>

                          </form>

                        </div>

                      </div>

                    </div>



                    <script type="text/javascript">

                      $('#modal_tambah').on('hidden.bs.modal', function (event) {

                        $('#form_tambah_data').trigger("reset");

                      });

                    </script>



                    <!-- ================================================================================================= -->

                    <!-- Modal Edit Data -->

                    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-hidden="true">

                      <div class="modal-dialog modal-md">

                        <div class="modal-content">



                          <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>

                            </button>

                            <h4 class="modal-title" id="myModalLabel">Form Edit Data</h4>

                          </div>

                          <div class="modal-body">

                            <p>

                              <form id="form_edit_data" method="post" action="<?php echo site_url('set_cabang/edit');?>">

                                <input type="hidden" id="id_cabang" name="id_cabang">

                                <label for="nama_cabang">Nama Cabang * :</label>

                                <input type="text" class="form-control" id="nama_cabang" name="nama_cabang" required oninvalid="this.setCustomValidity('Kolom nama cabang harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan nama cabang" />



                                <label for="alamat">Alamat * :</label>

                                <textarea type="text" class="form-control" id="alamat_cabang" name="alamat_cabang" required oninvalid="this.setCustomValidity('Kolom alamat harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan Alamat"></textarea>





                              </div>

                              <div class="modal-footer">

                                <button type="button" class="btn btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>

                                <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Ubah</span>

                                </div>

                              </form>

                            </div>

                          </div>

                        </div>



                        <script type="text/javascript">

                          $(function(){

                            $('#modal_edit').on('hidden.bs.modal', function (event) {

                              $('#form_edit_data').trigger("reset");

                            });



                            $("#datatable").on('click','.edit',function(){

                              var id_cabang = $(this).data('id');

                              var nama_cabang = $(this).data('nama_cabang');

                              var alamat_cabang = $(this).data('alamat_cabang');



                              $("#modal_edit").modal('show');

                              $("#id_cabang").val(id_cabang);

                              $("#nama_cabang").val(nama_cabang);

                              $("#alamat_cabang").val(alamat_cabang);

                            });

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






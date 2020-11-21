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



  <!--Content-->

  <?php if($session['level_user']=='Operator'){?>

    <div class="row">

      <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel">

          <div class="x_title">

            <h2><middle><span class="fa fa-cog"></span> Halaman <?php echo @$sess_location; ?></middle></h2>

            <ul class="nav navbar-right panel_toolbox">

              <?php if($session['level_user']=='Operator'){?>

                <li>

                  <button type="button" data-toggle="tooltip" data-placement="left" title="Kembali ke Welcome Page" class="btn btn-sm btn-warning" onclick="window.location.href='<?php echo base_url()?>backend/welcome'"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali ke Halaman Utama</button>

                </li>

              <?php }?>

            </ul>

            <div class="clearfix"></div>

          </div>

        </div>

        <?php

      }

      ?>

      <!-- ================================================ Persentase Gaji =========================================== -->

      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">

          <div class="x_panel">

            <div class="x_title">

              <h2><middle><span class="fa fa-database"></span> Data <?php echo @$sess_location; ?></middle></h2>

              <ul class="nav navbar-right panel_toolbox">

                <?php 

                if($session['level_user']=='Operator'){

                  if(!empty($get_persen)){

                            //null

                  }else{

                    ?>

                    <li>

                      <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_tambah" data-placement="top" title="Tambah Data Setting Persen"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>

                    </li>

                    <?php

                  }

                }else{?>

                  <li>

                    <button type="button" data-toggle="tooltip" data-placement="left" title="Kembali Ke Welcome Page" class="btn btn-sm btn-warning" onclick="window.location.href='<?php echo base_url()?>backend/welcome'"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali</button>

                  </li>

                <?php } ?>

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

                if(empty($get_persen)){

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

                        <th width="250px">Persentase (%) Gaji Sales</th>

                        <th width="250px">Persentase (%) Gaji Team Leader 1</th>

                        <th width="250px">Persentase (%) Gaji Team Leader 2</th>

                        <th width="250px">Persentase (%) Gaji Grouf Leader</th>

                        <th>Aksi</th>

                      </tr>

                    </thead>

                    <tbody>

                      <?php

                  //jika data user tidak kosong maka jalankan perintah dibawah ini

                      if(!empty($get_persen))

                      {

                    //load data user

                        foreach ($get_persen as $data)

                        {

                          $id = $data['id_set_penggajian'];

                          $gs = $data['gaji_sales']; 

                          $tl1 = $data['gaji_team_leader_1'];

                          $tl2 = $data['gaji_team_leader_2']; 

                          $gl = $data['gaji_grouf_leader'];



                          ?>  

                          <tr>

                            <td><?php echo $gs; ?></td>

                            <td><?php echo $tl1; ?></td>    

                            <td><?php echo $tl2; ?></td>                      

                            <td><?php echo $gl; ?></td>

                            <td class='center' width='40'>

                              <!-- Button Ubah-->

                              <a href="javascript:;"

                              data-id="<?php echo $data['id_set_penggajian'];?>"

                              data-gs="<?php echo $data['gaji_sales'];?>"

                              data-tl1="<?php echo $data['gaji_team_leader_1'];?>"

                              data-tl2="<?php echo $data['gaji_team_leader_2'];?>"

                              data-gl="<?php echo $data['gaji_grouf_leader'];?>"

                              data-toggle="modal" data-target="#ubah-data">

                              <button  class="btn btn-sm btn-warning" title="Edit Data Setting Persentase"><i class="glyphicon glyphicon-edit"></i> Edit</button>

                            </a>

                          </td>

                        </tr>



                        <?php

                      }

                    }else{

                     ?>

                     <table>

                      <tr>

                        <div class="alert alert-danger alert-dismissible">

                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                          <i class="icon fa fa-close"></i> Setting Persentase Gaji Belum dilakukan, data tidak ada pada database.

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

                          <h4 class="modal-title" id="myModalLabel">Form Edit Data <br>Setting Persentase Gaji</h4>

                        </div>

                        <div class="modal-body">

                          <p>



                            <form id="form-edit-gaji" method="post" action="<?php echo site_url('set_persen/prosesubah');?>"> 

                              <div class="form-group">

                                <input type="hidden" id="id" name="id">

                              </div>

                              <label for="gs">% Gaji Sales :</label>

                              <input type="text" id="gs" class="form-control" name="gs" required oninvalid="this.setCustomValidity('Kolom % Gaji Sales harus diisi')" oninput="setCustomValidity('')"/>



                              <label for="tl1">% Gaji Team Leader 1 :</label>

                              <input type="text" id="tl1" class="form-control" name="tl1" required oninvalid="this.setCustomValidity('Kolom % Gaji Team Leader 1 harus diisi')" oninput="setCustomValidity('')" />



                              <label for="tl2">% Gaji Team Leader 2 :</label>

                              <input type="text" id="tl2" class="form-control" name="tl2" required oninvalid="this.setCustomValidity('Kolom % Gaji Team Leader 2 harus diisi')" oninput="setCustomValidity('')" />



                              <label for="gl">% Gaji Group Leader :</label>

                              <input type="text" id="gl" class="form-control" name="gl" required oninvalid="this.setCustomValidity('Kolom % Gaji Group Leader harus diisi')" oninput="setCustomValidity('')"/>

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

                  <!--Script Edit-->

                  <script>

                    $(document).ready(function() {

                      // Untuk sunting

                      $('#ubah-data').on('show.bs.modal', function (event) {

                          var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan

                          var modal = $(this);



                          // Isi nilai pada field

                          modal.find('#id').val(div.data('id'));

                          modal.find('#gs').val(div.data('gs'));

                          modal.find('#tl1').val(div.data('tl1'));

                          modal.find('#tl2').val(div.data('tl2'));

                          modal.find('#gl').val(div.data('gl'));

                          

                        });

                      $('#ubah-data').on('hidden.bs.modal', function (event) {

                        $('#form-edit-gaji').trigger('reset');

                      });

                    });

                  </script>

                  <!--End Script Edit-->



                  <!-- Modal Tambah Data -->

                  <div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-hidden="true">

                    <div class="modal-dialog modal-md">

                      <div class="modal-content">



                        <div class="modal-header">

                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>

                          </button>

                          <h4 class="modal-title" id="myModalLabel">Form Tambah Data Setting Persentase Gaji</h4>

                        </div>

                        <div class="modal-body">

                          <p>

                            <form id="form-tambah-gaji" method="post" action="<?php echo site_url('set_persen/simpan');?>"/>

                              <div class="form-group">

                                <label class="control-label col-md-6 col-sm-6 col-xs-5">Persentese (%) Gaji Sales</label>

                                <div class="col-md-6 col-sm-6 col-xs-6">

                                  <input type="text" id="gs" name="gs" class="form-control" required oninvalid="this.setCustomValidity('Kolom % Gaji Sales harus diisi')" oninput="setCustomValidity('')" placeholder="Contoh : 4.5"/>

                                  <span class="fa fa-cogs form-control-feedback right" aria-hidden="true"></span>

                                </div>

                              </div>



                              <div class="form-group">

                                <label class="control-label col-md-6 col-sm-6 col-xs-5">Persentase (%) Team Leader 1</label>

                                <div class="col-md-6 col-sm-6 col-xs-6">

                                  <input type="text" id="tl1" name="tl1" class="form-control" required oninvalid="this.setCustomValidity('Kolom % Gaji Team Leader 1 harus diisi')" oninput="setCustomValidity('')" placeholder="Contoh : 4.5"/>

                                  <span class="fa fa-cogs form-control-feedback right" aria-hidden="true"></span>

                                </div>

                              </div>



                              <div class="form-group">

                                <label class="control-label col-md-6 col-sm-6 col-xs-5">Persentase (%) Team Leader 2</label>

                                <div class="col-md-6 col-sm-6 col-xs-6">

                                  <input type="text" id="tl2" name="tl2" class="form-control" required oninvalid="this.setCustomValidity('Kolom % Gaji Team Leader 2 harus diisi')" oninput="setCustomValidity('')" placeholder="Contoh : 4.5"/>

                                  <span class="fa fa-cogs form-control-feedback right" aria-hidden="true"></span>

                                </div>

                              </div>



                              <div class="form-group">

                                <label class="control-label col-md-6 col-sm-6 col-xs-5">Persentase (%) Group Leader</label>

                                <div class="ccol-md-6 col-sm-6 col-xs-6">

                                  <input type="text" id="gl" name="gl" class="form-control" required oninvalid="this.setCustomValidity('Kolom % Gaji Group Leader harus diisi')" oninput="setCustomValidity('')" placeholder="Contoh : 4.5"/>

                                  <span class="fa fa-cogs form-control-feedback right" aria-hidden="true"></span>

                                </div>

                              </div>



                            </p>

                          </div>

                          <div class="modal-footer">

                            <button type="button" class="btn btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>

                            <button type="reset" class="btn btn-warning"><i class="glyphicon glyphicon-refresh"></i> Reset</button>

                            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Simpan</button>

                          </div>

                        </form>

                      </div>

                    </div>

                  </div>



                  <script type="text/javascript">

                    $('#modal_tambah').on('hidden.bs.modal', function (event) {

                      $('#form-tambah-gaji').trigger('reset');

                    });

                  </script>



                </tbody>

              </table>

            </div>

          </div>

        </div>

      </div>

    </div>



    <!-- ================================================ Setting Asis Leader =========================================== -->

    <div class="row">

      <div class="col-md-6 col-sm-6 col-xs-12">

        <div class="x_panel">

          <div class="x_title">

            <h2><middle><span class="fa fa-database"></span> Data Set Asis Leader</middle></h2>

            <ul class="nav navbar-right panel_toolbox">

              <?php 

              if($session['level_user']=='Operator'){

                ?>

                <?php

                if(!empty($get_set_al)){

                  foreach ($get_set_al as $data)

                  { 

                    ?>  

                    <li>

                      <a href="javascript:;"

                      data-id="<?php echo $data['id_set_gaji_al'];?>"

                      data-id_u="<?php echo $data['id_user'];?>"

                      data-st="<?php echo $data['status'];?>"

                      data-minggu="<?php echo $data['minggu'];?>"

                      data-ket="<?php echo $data['keterangan'];?>"

                      data-toggle="modal" data-target="#data_set_al">

                      <button  class="btn btn-sm btn-warning" title="<?php echo 'Status : '.$data['status'];?>"><i class="glyphicon glyphicon-cog"></i> Setting Status Asis Leader</button>

                    </a>

                  </li>

                  <?php

                }

              }else{

                ?>

                <li>

                  <button  class="btn btn-sm btn-info" data-toggle="modal" data-target="#data_set_al" title="Setting Status Gaji AL"><i class="glyphicon glyphicon-cog"></i> Setting Status Asis Leader</button>

                </li>

                <?php

              }

            }else{ ?>

              <li>

                <button type="button" data-toggle="tooltip" data-placement="left" title="Kembali Ke Welcome Page" class="btn btn-sm btn-warning" onclick="window.location.href='<?php echo base_url()?>backend/welcome'"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali</button>

              </li>

            <?php } ?>

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

            if(empty($get_persen)){

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

                    <th width="250px">#</th>                

                    <th width="250px">Status</th>

                    <th width="250px">Gaji Keluar Pada Minggu Ke</th>

                    <th width="250px">Keterangan</th>

                  </tr>

                </thead>

                <tbody>

                  <?php

                  //jika data user tidak kosong maka jalankan perintah dibawah ini

                  if(!empty($get_set_al))

                  {

                    //load data user

                    foreach ($get_set_al as $data)

                    {

                      $id = $data['id_set_gaji_al'];

                      $id_u = $data['id_user']; 

                      $st = $data['status'];

                      $mg = $data['minggu']; 

                      $ket = $data['keterangan'];

                      

                      ?>  

                      <tr>

                        <td><?php echo 'Asis Leader'; ?></td>

                        <td><?php echo $st; ?></td>

                        <td><?php echo $mg; ?></td>    

                        <td><?php echo $ket; ?></td>                      

                      </tr>

                      <?php

                    }

                  }else{

                   ?>

                   <table>

                    <tr>

                      <div class="alert alert-danger alert-dismissible">

                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        <i class="icon fa fa-close"></i> Setting Persentase Gaji Belum dilakukan, data tidak ada pada database.

                      </div>

                    </tr>

                  </table>

                  <?php

                }

                ?>





                <!-- Modal Set Data Gaji AL -->

                <div class="modal fade" id="data_set_al" tabindex="-1" role="dialog" aria-hidden="true">

                  <div class="modal-dialog modal-md">

                    <div class="modal-content">



                      <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>

                        </button>

                        <h4 class="modal-title" id="myModalLabel">Form Setting Status Gaji Asis Leader</h4>

                      </div>

                      <div class="modal-body">

                        <p>

                          <?php 

                          if(!empty($get_set_al)){

                            ?>

                            <form id="form-id" method="post" action="<?php echo site_url('set_persen/prosesubah_al');?>"/>

                              <?php 

                            }else{

                              ?>

                              <form id="form-id" method="post" action="<?php echo site_url('set_persen/simpan_al');?>"/>

                                <?php 

                              } 

                              ?>

                              <div class="form-group">

                                <input type="hidden" name="id" id="id">

                                <input type="hidden" name="id_u" id="id_u">

                              </div>

                              <div class="form-group">

                                <label for="status">Pilih Status Asis Leader</label>

                                <div>

                                  <select id="status" class="form-control" name="status" required oninvalid="this.setCustomValidity('Kolom Status harus dipilih')" oninput="setCustomValidity('')">

                                    <option value="">-- Pilih Status --</option>

                                    <option value="Training">Training</option>

                                    <option value="Pasca Training">Pasca Training</option>

                                    <option value="Gaji Penuh">Gaji Penuh</option>

                                  </select>

                                </div>

                              </div>  


                              <div class="form-group">

                                <label for="minggu">Gaji Keluar pada Minggu ke ?</label>

                                <div>

                                  <input type="number" id="minggu" name="minggu" class="form-control" required oninvalid="this.setCustomValidity('Kolom Minggu harus diisi')" oninput="setCustomValidity('')" placeholder="Keterangan status Asis Leader"/>

                                </div>

                              </div>



                              <div class="form-group">

                                <label for="keterangan">Keterangan</label>

                                <div>

                                  <input type="text" id="keterangan" name="keterangan" class="form-control" required oninvalid="this.setCustomValidity('Kolom Keterangan harus diisi')" oninput="setCustomValidity('')" placeholder="Keterangan status Asis Leader"/>

                                </div>

                              </div>



                              <div class="form-group">

                                <label for="perkiraan_gaji">Perkiraan Gaji</label>

                                <div>

                                  <input type="text" id="perkiraan_gaji" name="perkiraan_gaji" class="form-control" required oninvalid="this.setCustomValidity('Kolom Keterangan harus diisi')" oninput="setCustomValidity('')" placeholder="Perkiraan Gaji Asis Leader" readonly="readonly" />

                                </div>

                              </div>



                            </p>

                          </div>

                          <div class="modal-footer">

                            <button type="button" class="btn btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>

                            <button type="reset" class="btn btn-warning"><i class="glyphicon glyphicon-refresh"></i> Reset</button>

                            <?php 

                            if(!empty($get_set_al)){

                              ?>

                              <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Ubah</button>

                              <?php

                            }else{

                              ?>

                              <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Simpan</button>

                              <?php

                            }

                            ?>

                          </div>

                        </form>

                      </div>

                    </div>

                  </div>



                  <script type="text/javascript">

                    $(document).ready(function() {

                      // Untuk sunting

                      $("#status").change(function(){

                        var value = $('#status').val();

                        if (value == "Training"){

                          $("#keterangan").val('Gaji Training');

                          $("#perkiraan_gaji").val('Rp. 1.000.000');

                        }else if (value == "Pasca Training"){

                          $("#keterangan").val('Gaji Pasca Training');

                          $("#perkiraan_gaji").val('Rp. 1.250.000');

                        }else if (value == "Gaji Penuh"){

                          $("#keterangan").val('Gaji Penuh');

                          $("#perkiraan_gaji").val('5% dari Total Omzet');

                        }

                      });



                      $('#data_set_al').on('show.bs.modal', function (event) {

                          var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan

                          var modal = $(this);

                          var status = div.data("st");

                          if (status == "Training"){

                            $("#keterangan").val('Gaji Training');

                            $("#perkiraan_gaji").val('Rp. 1.000.000');

                          }else if (status == "Pasca Training"){

                            $("#keterangan").val('Gaji Pasca Training');

                            $("#perkiraan_gaji").val('Rp. 1.250.000');

                          }else if (status == "Gaji Penuh"){

                            $("#keterangan").val('Gaji Penuh');

                            $("#perkiraan_gaji").val('5% dari Total Omzet');

                          }


                          modal.find('#id').val(div.data('id'));

                          modal.find('#status').val(status);

                          modal.find('#minggu').val(div.data('minggu'));

                          modal.find('#id_u').val(div.data('id_u'));

                          modal.find('#keterangan').val(div.data('ket'));

                          

                        });

                      

                      $('#data_set_al').on('hidden.bs.modal', function (event) {

                        $('#form-id').trigger('reset');

                      });

                    });

                  </script>



                </tbody>

              </table>

            </div>

          </div>

        </div>

      </div>



      <!-- ================================================ Setting Gaji Tukang Masak =========================================== -->

      <div class="col-md-6 col-sm-6 col-xs-12">

        <div class="x_panel">

          <div class="x_title">

            <h2><middle><span class="fa fa-database"></span> Data Set Gaji Tukang Masak</middle></h2>

            <ul class="nav navbar-right panel_toolbox">

              <?php 

              if($session['level_user']=='Operator'){

                ?>

                <li>

                  <a>

                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_tambah_tm" data-placement="top" title="Tambah Data Setting Persen"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>

                  </a>

                </li>

                <?php

              }else{?>

                <li>

                  <button type="button" data-toggle="tooltip" data-placement="left" title="Kembali Ke Welcome Page" class="btn btn-sm btn-warning" onclick="window.location.href='<?php echo base_url()?>backend/welcome'"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali</button>

                </li>

              <?php } ?>

            </ul>

            <div class="clearfix"></div>

          </div>



          <div class="x_content"> 

            <div class='table-responsive'>

              <?php

              if($session['level_user']=='Admin'){

                $id="id='datatable'";

              }else{

                $id="id=datatable-tm";

              }

              ?>

              <?php

              if(empty($get_set_gaji_tm)){

                ?>

                <table class="table table-striped table-hover table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                  <?php

                }else{

                  ?>

                  <table <?php echo $id;?> class="table table-striped table-hover table-bordered nowrap" cellspacing="0" width="100%">

                    <?php 

                  }

                  ?>

                  <thead>

                    <tr>                

                      <th width="90px">#</th>

                      <th width="250px">Bulan</th>

                      <th width="250px">Minggu</th>

                      <th width="250px">Besar Gaji</th>

                      <th width="210px">Aksi</th>

                    </tr>

                  </thead>

                  <tbody>

                    <?php

                  //jika data user tidak kosong maka jalankan perintah dibawah ini

                    if(!empty($get_set_gaji_tm))

                    {

                      $no=1;

                    //load data user

                      foreach ($get_set_gaji_tm as $data)

                      {

                        $id = $data['id_set_gaji_tm'];

                        $id_u = $data['id_user'];

                        $bulan = $data['bulan'];

                        $minggu = $data['minggu'];

                        $gaji = $data['gaji']; 



                        ?>  

                        <tr>

                          <td><?php echo $no; ?></td>

                          <td><?php echo $bulan; ?></td>

                          <td><?php echo $minggu; ?></td>    

                          <td><?php echo $gaji = "Rp " . number_format($gaji,0,',','.'); ?></td>                                          

                          <td class='center'>

                            <!-- Button Ubah-->

                            <a href="javascript:;"

                            data-id="<?php echo $data['id_set_gaji_tm'];?>"

                            data-id_u="<?php echo $data['id_user'];?>"

                            data-id_set="<?php echo $data['id_set'];?>"

                            data-bulan="<?php echo $data['bulan'];?>"

                            data-minggu="<?php echo $data['minggu'];?>"

                            data-gaji="<?php echo $data['gaji'];?>"

                            data-tanggal_awal="<?php echo $data['tanggal_awal'];?>"

                            data-tanggal_akhir="<?php echo $data['tanggal_akhir'];?>"

                            data-toggle="modal" data-target="#ubah-data-tm">

                            <button  class="btn btn-sm btn-warning" title="Edit Data Set Gaji Tukang Masak"><i class="glyphicon glyphicon-edit"></i> Edit</button>

                          </a>

                          <!-- End Button Ubah -->

                          <?php 

                          if($session['level_user']=='Operator'){

                            ?>

                            <!-- Button Hapus-->

                            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_delete_tm<?php echo $data['id_set_gaji_tm']; ?>" data-placement="top" title="Hapus Data Setting Persentase"><i class="glyphicon glyphicon-trash"></i> Hapus

                            </a>

                            <!-- End Button Hapus-->

                            <?php

                          }    



                          ?>

                        </td>

                      </tr>



                      <!-- Modal Detele Data -->

                      <div class="modal fade" id="modal_delete_tm<?php echo $data['id_set_gaji_tm']; ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">

                        <div class="modal-dialog modal-md">

                          <div class="modal-content">

                            <div class="modal-header">

                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>

                              </button>

                              <h4 class="modal-title" id="myModalLabel2">Konfirmasi Hapus Data</h4>

                            </div>

                            <div class="modal-body">

                              <p>Silahkan klik tombol <strong> Hapus </strong> untuk menghapus data (Gaji TM)</p>

                            </div>

                            <div class="modal-footer">

                              <button type="button" class="btn btn-success" data-dismiss="modal"><i class="glyphicon glyphicon-backward"></i> Kembali</button>

                              <a href="<?php echo site_url()."set_persen/hapus_tm/".$data['id_set_gaji_tm'];?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>

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

                        <i class="icon fa fa-close"></i> Setting Persentase Gaji Belum dilakukan, data tidak ada pada database.

                      </div>

                    </tr>

                  </table>

                  <?php

                }

                ?>



                <!-- Modal Edit Data -->

                <div class="modal fade" id="ubah-data-tm" tabindex="-1" role="dialog" aria-hidden="true">

                  <div class="modal-dialog modal-md">

                    <div class="modal-content">



                      <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>

                        </button>

                        <h4 class="modal-title" id="myModalLabel">Form Edit Data <br>Set Gaji Tukang Masak</h4>

                      </div>

                      <div class="modal-body">

                        <p>

                          <form id="form-edit-gaji-tm" method="post" action="<?php echo site_url('set_persen/prosesubah_tm');?>"/>

                            <input type="hidden" name="id" id="id">

                            <input type="hidden" name="id_user" id="id_user">

                            <label for="id_set_tm">ID Set Gaji :</label>

                            <select id="id_set_tm" class="form-control" name="id_set" required oninvalid="this.setCustomValidity('Kolom ID Set Gaji harus diisi')" oninput="setCustomValidity('')">

                            </select>

                            <label for="gaji">Besaran Gaji</label>

                            <input type="text" id="gaji" name="gaji" class="form-control" placeholder="Contoh : 20000, Jika nilai Gaji Rp 0 maka gunakan tanda - " required oninvalid="this.setCustomValidity('Kolom Besaran Uang untuk Gaji Tukang Masak harus diisi')" oninput="setCustomValidity('')">



                          </p>

                        </div>

                        <div class="modal-footer">

                          <button type="button" class="btn btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>

                          <button type="reset" class="btn btn-warning"><i class="glyphicon glyphicon-refresh"></i> Reset</button>

                          <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Simpan</button>

                        </div>

                      </form>

                    </div>

                  </div>

                </div>

                <!--Script Edit-->

                <script>

                  $(document).ready(function() {

                      // Untuk sunting

                      $('#ubah-data-tm').on('show.bs.modal', function (event) {

                          var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan

                          var modal = $(this);

                          var id_set = $("#id_set_tm")[0]; //document.getElementById("id_set");

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

                           id_set_tm.options.add(newOption);  

                         }

                          // Isi nilai pada field

                          modal.find('#id').val(div.data('id'));

                          modal.find('#id_user').val(div.data('id_u'));

                          modal.find('#gaji').val(div.data('gaji'));                          

                        });

                      $('#ubah-data-tm').on('hidden.bs.modal', function (event) {

                        var id_set = $("#id_set_tm")[0];

                        id_set.options.length = 0;

                        $('#form-edit-gaji-tm').trigger('reset');

                      });

                    });

                  </script>

                  <!--End Script Edit-->



                  <!-- Modal Tambah Data -->

                  <div class="modal fade" id="modal_tambah_tm" tabindex="-1" role="dialog" aria-hidden="true">

                    <div class="modal-dialog modal-md">

                      <div class="modal-content">



                        <div class="modal-header">

                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>

                          </button>

                          <h4 class="modal-title" id="myModalLabel">Form Tambah Data Set Gaji</h4>

                        </div>

                        <div class="modal-body">

                          <p>

                            <form id="form-tambah-gaji-tm" method="post" action="<?php echo site_url('set_persen/simpan_tm');?>"/>

                              <label for="id_set">ID Set Gaji :</label>

                              <select id="id_set" class="form-control" name="id_set" required oninvalid="this.setCustomValidity('Kolom ID Set Gaji harus diisi')" oninput="setCustomValidity('')">

                                <?php 

                                if(!empty($get_set_input)){

                                  ?>

                                  <option value="">--- Pilih Salah Satu ---</option>

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

                              <label for="gaji">Besaran Gaji</label>

                              <input type="text" id="gaji" name="gaji" class="form-control" placeholder="Contoh : 20000, Jika nilai Gaji Rp 0 maka gunakan tanda - " required oninvalid="this.setCustomValidity('Kolom Besaran Uang untuk Gaji Tukang Masak harus diisi')" oninput="setCustomValidity('')">



                            </p>

                          </div>

                          <div class="modal-footer">

                            <button type="button" class="btn btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>

                            <button type="reset" class="btn btn-warning"><i class="glyphicon glyphicon-refresh"></i> Reset</button>

                            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Simpan</button>

                          </div>

                        </form>

                      </div>

                    </div>

                  </div>



                  <script type="text/javascript">

                    $(function() {

                      $("#datatable-tm").DataTable({
                        "responsive":true,
                        "language":{
                          url:"./build/dt_ID.json"
                        },

                        "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
                        
                        dom:  "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

                        pageLength: 5,
                        buttons: [
                        {
                          extend:'pageLength',
                          text:'Tampilkan Data',
                          className:'btn-sm btn-light',
                        },
                        {
                          extend: "copy",
                          className: "btn-sm btn-info"
                        },
                        {
                          extend: "print",
                          className: "btn-sm btn-success"
                        }
                        
                        ]
                      });

                      $('#modal_tambah_tm').on('hidden.bs.modal', function (event) {

                        $('#form-tambah-gaji-tm').trigger('reset');

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



    <!-- ================================================ Setting Biaya Operasional =========================================== -->

    <div class="row">

      <div class="col-md-6 col-sm-6 col-xs-12">

        <div class="x_panel">

          <div class="x_title">

            <h2><middle><span class="fa fa-database"></span> Data Set By Operasional</middle></h2>

            <ul class="nav navbar-right panel_toolbox">

              <?php 

              if($session['level_user']=='Operator'){

                ?>

                <li>

                  <a>

                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_tambah_bop" data-placement="top" title="Tambah Data Setting Persen"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>

                  </a>

                </li>

                <?php

              }else{?>

                <li>

                  <button type="button" data-toggle="tooltip" data-placement="left" title="Kembali Ke Welcome Page" class="btn btn-sm btn-warning" onclick="window.location.href='<?php echo base_url()?>backend/welcome'"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali</button>

                </li>

              <?php } ?>

            </ul>

            <div class="clearfix"></div>

          </div>



          <div class="x_content"> 

            <div class='table-responsive'>

              <?php

              if($session['level_user']=='Admin'){

                $id="id='datatable'";

              }else{

                $id="id='datatable-bop'";

              }

              ?>

              <?php

              if(empty($get_set_by_op)){

                ?>

                <table class="table table-striped table-hover table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                  <?php

                }else{

                  ?>

                  <table <?php echo $id;?> class="table table-striped table-hover table-bordered nowrap" cellspacing="0" width="100%">

                    <?php 

                  }

                  ?>

                  <thead>

                    <tr>                

                      <th width="90px">#</th>

                      <th width="170px">Bulan</th>

                      <th width="100px">Minggu</th>

                      <th width="230px">Biaya Operasional</th>

                      <th width="320px">Aksi</th>

                    </tr>

                  </thead>

                  <tbody>

                    <?php

                  //jika data user tidak kosong maka jalankan perintah dibawah ini

                    if(!empty($get_set_by_op))

                    {

                    //load data

                      $no = 1;

                      foreach ($get_set_by_op as $data)

                      {

                        $id = $data['id_set_biaya_op'];

                        $id_u = $data['id_user']; 

                        $bulan = $data['bulan'];

                        $minggu = $data['minggu']; 

                        $biaya_op = $data['biaya_op'];



                        ?>  

                        <tr>

                          <td><?php echo $no; ?></td>

                          <td><?php echo $bulan; ?></td>

                          <td><?php echo $minggu; ?></td>    

                          <td><?php echo $biaya_op = "Rp " . number_format($biaya_op,0,',','.'); ?></td>                      

                          <td class='center'>

                            <!-- Button Ubah -->

                            <a href="javascript:;"

                            data-id="<?php echo $data['id_set_biaya_op'];?>"

                            data-id_u="<?php echo $data['id_user'];?>"

                            data-id_set="<?php echo $data['id_set'];?>"

                            data-biaya_op="<?php echo $data['biaya_op'];?>"

                            data-bulan = "<?php echo $data['bulan'];?>"

                            data-minggu = "<?php echo $data['minggu'];?>"

                            data-tanggal_awal = "<?php echo $data['tanggal_awal'];?>"

                            data-tanggal_akhir = "<?php echo $data['tanggal_akhir'];?>"

                            data-toggle="modal" data-target="#ubah-data-bop">

                            <button  class="btn btn-sm btn-warning" title="Edit Data Setting Biaya Operasional"><i class="glyphicon glyphicon-edit"></i> Edit</button>

                          </a>

                          <!-- End Button Ubah -->



                          <?php 

                          if($session['level_user']=='Operator'){

                            ?>

                            <!-- Button Hapus -->

                            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_delete_bop<?php echo $data['id_set_biaya_op']; ?>" data-placement="top" title="Hapus Data Setting Persentase"><i class="glyphicon glyphicon-trash"></i> Hapus</a>

                            <!-- End Button Hapus -->

                            <?php

                          }    

                          ?>

                        </td>

                      </tr>



                      <!-- Modal Detele Data -->

                      <div class="modal fade" id="modal_delete_bop<?php echo $data['id_set_biaya_op']; ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">

                        <div class="modal-dialog modal-md">

                          <div class="modal-content">

                            <div class="modal-header">

                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>

                              </button>

                              <h4 class="modal-title" id="myModalLabel2">Konfirmasi Hapus Data</h4>

                            </div>

                            <div class="modal-body">

                              <p>Silahkan klik tombol <strong> Hapus </strong> untuk menghapus data (BOP)</p>

                            </div>

                            <div class="modal-footer">

                              <button type="button" class="btn btn-success" data-dismiss="modal"><i class="glyphicon glyphicon-backward"></i> Kembali</button>

                              <a href="<?php echo site_url()."set_persen/hapus_bop/".$data['id_set_biaya_op'];?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>

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

                        <i class="icon fa fa-close"></i> Setting Persentase Gaji Belum dilakukan, data tidak ada pada database.

                      </div>

                    </tr>

                  </table>

                  <?php

                }

                ?>



                <!-- Modal Edit Data -->

                <div class="modal fade" id="ubah-data-bop" tabindex="-1" role="dialog" aria-hidden="true">

                  <div class="modal-dialog modal-md">

                    <div class="modal-content">



                      <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>

                        </button>

                        <h4 class="modal-title" id="myModalLabel">Form Edit Data <br>Set Biaya Operasional</h4>

                      </div>

                      <div class="modal-body">

                        <p>

                          <form id="form-edit-bop" method="post" action="<?php echo site_url('set_persen/prosesubah_bop');?>"/>

                            <input type="hidden" name="id" id="id">

                            <input type="hidden" name="id_user" id="id_user">

                            <label for="id_set_bop">ID Set Biaya Operasional :</label>

                            <select id="id_set_bop" class="form-control" name="id_set" required oninvalid="this.setCustomValidity('Kolom ID Set Biaya Operasional harus diisi')" oninput="setCustomValidity('')">



                            </select>

                            <label for="biaya_op">Besaran Uang untuk Biaya Operasional</label>

                            <input type="text" id="biaya_op" name="biaya_op" class="form-control" placeholder="Contoh : 20000, Jika nilai Biaya Operasional Rp 0 maka gunakan tanda - " required oninvalid="this.setCustomValidity('Kolom Besaran Uang untuk Biaya Operasional harus diisi')" oninput="setCustomValidity('')">



                          </p>

                        </div>

                        <div class="modal-footer">

                          <button type="button" class="btn btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>

                          <button type="reset" class="btn btn-warning"><i class="glyphicon glyphicon-refresh"></i> Reset</button>

                          <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Simpan</button>

                        </div>

                      </form>

                    </div>

                  </div>

                </div>

                <!--Script Edit-->

                <script>

                  $(document).ready(function() {

                      // Untuk sunting

                      $('#ubah-data-bop').on('show.bs.modal', function (event) {

                          var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan

                          var modal = $(this);

                          var id_set = $("#id_set_bop")[0]; //document.getElementById("id_set");

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

                           id_set_bop.options.add(newOption);  

                         }



                          // Isi nilai pada field

                          modal.find('#id').val(div.data('id'));

                          modal.find('#id_user').val(div.data('id_u'));

                          modal.find('#biaya_op').val(div.data('biaya_op'));

                          

                        });

                      $('#ubah-data-bop').on('hidden.bs.modal', function (event) {

                        var id_set = $("#id_set_bop")[0];

                        id_set.options.length = 0;

                        $('#form-edit-bop').trigger('reset');

                      });

                    });

                  </script>



                  <!-- Modal Tambah Data -->

                  <div class="modal fade" id="modal_tambah_bop" tabindex="-1" role="dialog" aria-hidden="true">

                    <div class="modal-dialog modal-md">

                      <div class="modal-content">



                        <div class="modal-header">

                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>

                          </button>

                          <h4 class="modal-title" id="myModalLabel">Form Tambah Data Set Biaya Operasional</h4>

                        </div>

                        <div class="modal-body">

                          <p>

                            <form id="form-tambah-bop" method="post" action="<?php echo site_url('set_persen/simpan_bop');?>"/>

                              <label for="id_set">ID Set Biaya Operasional :</label>

                              <select id="id_set" class="form-control" name="id_set" required oninvalid="this.setCustomValidity('Kolom ID Set Biaya Operasional harus diisi')" oninput="setCustomValidity('')">

                                <?php 

                                if(!empty($get_set_input)){

                                  ?>

                                  <option value="">--- Pilih Salah Satu ---</option>

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

                              <label for="biaya_op">Besaran Uang untuk Biaya Operasional</label>

                              <input type="text" id="biaya_op" name="biaya_op" class="form-control" placeholder="Contoh : 20000, Jika nilai Biaya Operasional Rp 0 maka gunakan tanda - " required oninvalid="this.setCustomValidity('Kolom Besaran Uang untuk Biaya Operasional harus diisi')" oninput="setCustomValidity('')">



                            </p>

                          </div>

                          <div class="modal-footer">

                            <button type="button" class="btn btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>

                            <button type="reset" class="btn btn-warning"><i class="glyphicon glyphicon-refresh"></i> Reset</button>

                            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Simpan</button>

                          </div>

                        </form>

                      </div>

                    </div>

                  </div>



                  <script type="text/javascript">

                    $(function() {
                      $("#datatable-bop").DataTable({
                        "responsive":true,
                        "language":{
                          url:"./build/dt_ID.json"
                        },

                        "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
                        
                        dom:  "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

                        pageLength: 5,
                        buttons: [
                        {
                          extend:'pageLength',
                          text:'Tampilkan Data',
                          className:'btn-sm btn-light',
                        },
                        {
                          extend: "copy",
                          className: "btn-sm btn-info"
                        },
                        {
                          extend: "print",
                          className: "btn-sm btn-success"
                        },
                        ]
                      });

                      $('#modal_tambah_bop').on('hidden.bs.modal', function (event) {

                        $('#form-tambah-bop').trigger('reset');

                      });
                    });


                  </script>



                </tbody>

              </table>

            </div>

          </div>

        </div>

      </div>

      <!-- ================================================ Setting Ongkos Belanja =========================================== -->

      <div class="col-md-6 col-sm-6 col-xs-12">

        <div class="x_panel">

          <div class="x_title">

            <h2><middle><span class="fa fa-database"></span> Data Set Ongkos Belanja</middle></h2>

            <ul class="nav navbar-right panel_toolbox">

              <?php 

              if($session['level_user']=='Operator'){

                ?>

                <li>

                  <a>

                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_tambah_ob" data-placement="top" title="Tambah Data Setting Persen"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>

                  </a>

                </li>

                <?php

              }else{?>

                <li>

                  <button type="button" data-toggle="tooltip" data-placement="left" title="Kembali Ke Welcome Page" class="btn btn-sm btn-warning" onclick="window.location.href='<?php echo base_url()?>backend/welcome'"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali</button>

                </li>

              <?php } ?>

            </ul>

            <div class="clearfix"></div>

          </div>



          <div class="x_content"> 

            <div class='table-responsive'>

              <?php

              if($session['level_user']=='Admin'){

                $id="id='datatable'";

              }else{

                $id="id='datatable-ob'";

              }

              ?>

              <?php

              if(empty($get_set_ongkos_belanja)){

                ?>

                <table class="table table-striped table-hover table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                  <?php

                }else{

                  ?>

                  <table <?php echo $id;?> class="table table-striped table-hover table-bordered nowrap" cellspacing="0" width="100%">

                    <?php 

                  }

                  ?>

                  <thead>

                    <tr>                

                      <th width="90px">#</th>

                      <th width="170px">Bulan</th>

                      <th width="150px">Minggu</th>

                      <th width="220px">Besar Ongkos</th>

                      <th width="170px">Aksi</th>

                    </tr>

                  </thead>

                  <tbody>

                    <?php

                  //jika data user tidak kosong maka jalankan perintah dibawah ini

                    if(!empty($get_set_ongkos_belanja))

                    {

                    //load data

                      $no = 1;

                      foreach ($get_set_ongkos_belanja as $data)

                      {

                        $id = $data['id_set_ongkos_belanja'];

                        $id_u = $data['id_user']; 

                        $bulan = $data['bulan'];

                        $minggu = $data['minggu']; 

                        $ongkos = $data['ongkos'];



                        ?>  

                        <tr>

                          <td><?php echo $no; ?></td>

                          <td><?php echo $bulan; ?></td>

                          <td><?php echo $minggu; ?></td>    

                          <td><?php echo $ongkos = "Rp " . number_format($ongkos,0,',','.'); ?></td>                      

                          <td class='center'>

                            <!-- Button Ubah-->

                            <a href="javascript:;"

                            data-id="<?php echo $data['id_set_ongkos_belanja'];?>"

                            data-id-u="<?php echo $data['id_user'];?>"

                            data-id_set="<?php echo $data['id_set'];?>"

                            data-ongkos="<?php echo $data['ongkos'];?>"

                            data-bulan = "<?php echo $data['bulan'];?>"

                            data-minggu = "<?php echo $data['minggu'];?>"

                            data-tanggal_awal = "<?php echo $data['tanggal_awal'];?>"

                            data-tanggal_akhir = "<?php echo $data['tanggal_akhir'];?>"

                            data-toggle="modal" data-target="#ubah-data-ob">

                            <button  class="btn btn-sm btn-warning" title="Edit Data Setting Ongkos Belanja"><i class="glyphicon glyphicon-edit"></i> Edit</button>

                          </a>

                          <!-- End Button Ubah-->



                          <?php 

                          if($session['level_user']=='Operator'){

                            ?>

                            <!-- Button Hapus-->

                            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_delete_ob<?php echo $data['id_set_ongkos_belanja']; ?>" data-placement="top" title="Hapus Data"><i class="glyphicon glyphicon-trash"></i> Hapus</a>

                            <!-- End Button Hapus-->

                            <?php

                          }    



                          ?>

                        </td>

                      </tr>



                      <!-- Modal Detele Data -->

                      <div class="modal fade" id="modal_delete_ob<?php echo $data['id_set_ongkos_belanja']; ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">

                        <div class="modal-dialog modal-md">

                          <div class="modal-content">

                            <div class="modal-header">

                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>

                              </button>

                              <h4 class="modal-title" id="myModalLabel2">Konfirmasi Hapus Data</h4>

                            </div>

                            <div class="modal-body">

                              <p>Silahkan klik tombol <strong> Hapus </strong> untuk menghapus data (OB)</p>

                            </div>

                            <div class="modal-footer">

                              <button type="button" class="btn btn-success" data-dismiss="modal"><i class="glyphicon glyphicon-backward"></i> Kembali</button>

                              <a href="<?php echo site_url()."set_persen/hapus_ob/".$data['id_set_ongkos_belanja'];?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>

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

                        <i class="icon fa fa-close"></i> Setting Persentase Gaji Belum dilakukan, data tidak ada pada database.

                      </div>

                    </tr>

                  </table>

                  <?php

                }

                ?>



                <!-- Modal Edit Data -->

                <div class="modal fade" id="ubah-data-ob" tabindex="-1" role="dialog" aria-hidden="true">

                  <div class="modal-dialog modal-md">

                    <div class="modal-content">



                      <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>

                        </button>

                        <h4 class="modal-title" id="myModalLabel">Form Edit Data Set Ongkos Belanja</h4>

                      </div>

                      <div class="modal-body">

                        <p>

                          <form id="form-edit-ob" method="post" action="<?php echo site_url('set_persen/prosesubah_ob');?>"/>

                            <input type="hidden" id="id" name="id">

                            <input type="hidden" id="id_user" name="id_user">



                            <label for="id_set_ob">ID Set Ongkos Belanja :</label>

                            <select id="id_set_ob" class="form-control" name="id_set" required oninvalid="this.setCustomValidity('Kolom ID Set Gaji harus diisi')" oninput="setCustomValidity('')">



                            </select>

                            <label for="ongkos">Besaran Uang untuk Ongkos Belanja</label>

                            <input type="text" id="ongkos" name="ongkos" class="form-control" placeholder="Contoh : 20000, Jika nilai Ongkos Belanja Rp 0 maka gunakan tanda - " required oninvalid="this.setCustomValidity('Kolom Besaran Uang untuk Ongkos Belanja harus diisi')" oninput="setCustomValidity('')">



                          </p>

                        </div>

                        <div class="modal-footer">

                          <button type="button" class="btn btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>

                          <button type="reset" class="btn btn-warning"><i class="glyphicon glyphicon-refresh"></i> Reset</button>

                          <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Simpan</button>

                        </div>

                      </form>

                    </div>

                  </div>

                </div>

                <!--Script Edit-->

                <script>

                  $(document).ready(function() {

                      // Untuk sunting

                      $('#ubah-data-ob').on('show.bs.modal', function (event) {

                          var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan

                          var modal = $(this);

                          var id_set = $("#id_set_ob")[0]; //document.getElementById("id_set");

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

                           id_set_ob.options.add(newOption);  

                         }



                          // Isi nilai pada field

                          modal.find('#id').val(div.data('id'));

                          modal.find('#id_u').val(div.data('gs'));

                          modal.find('#id_set').val(div.data('id_set'));

                          modal.find('#ongkos').val(div.data('ongkos'));                             

                        });

                      $('#ubah-data-ob').on('hidden.bs.modal', function (event) {

                        var id_set = $("#id_set_ob")[0];

                        id_set.options.length = 0;

                        $('#form-edit-ob').trigger('reset');

                      });

                    });

                  </script>

                  <!--End Script Edit-->



                  <!-- Modal Tambah Data -->

                  <div class="modal fade" id="modal_tambah_ob" tabindex="-1" role="dialog" aria-hidden="true">

                    <div class="modal-dialog modal-md">

                      <div class="modal-content">



                        <div class="modal-header">

                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>

                          </button>

                          <h4 class="modal-title" id="myModalLabel">Form Tambah Data Set Ongkos Belanja</h4>

                        </div>

                        <div class="modal-body">

                          <p>

                            <form id="form-tambah-bop" method="post" action="<?php echo site_url('set_persen/simpan_ob');?>"/>

                              <label for="id_set">ID Set Ongkos Belanja :</label>

                              <select id="id_set" class="form-control" name="id_set" required oninvalid="this.setCustomValidity('Kolom ID Set Gaji harus diisi')" oninput="setCustomValidity('')">

                                <?php 

                                if(!empty($get_set_input)){

                                  ?>

                                  <option value="">--- Pilih Salah Satu ---</option>

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

                              <label for="ongkos">Besaran Uang untuk Ongkos Belanja</label>

                              <input type="text" id="ongkos" name="ongkos" class="form-control" placeholder="Contoh : 20000, Jika nilai Ongkos Belanja Rp 0 maka gunakan tanda - " required oninvalid="this.setCustomValidity('Kolom Besaran Uang untuk Ongkos Belanja harus diisi')" oninput="setCustomValidity('')">



                            </p>

                          </div>

                          <div class="modal-footer">

                            <button type="button" class="btn btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>

                            <button type="reset" class="btn btn-warning"><i class="glyphicon glyphicon-refresh"></i> Reset</button>

                            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Simpan</button>

                          </div>

                        </form>

                      </div>

                    </div>

                  </div>



                  <script type="text/javascript">

                    $(function() {
                      $("#datatable-ob").DataTable({
                        "responsive":true,
                        "language":{
                          url:"./build/dt_ID.json"
                        },

                        "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
                        
                        dom:  "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

                        pageLength: 5,
                        buttons: [
                        {
                          extend:'pageLength',
                          text:'Tampilkan Data',
                          className:'btn-sm btn-light',
                        },
                        {
                          extend: "copy",
                          className: "btn-sm btn-info"
                        },
                        {
                          extend: "print",
                          className: "btn-sm btn-success"
                        },
                        ]
                      });
                      $('#modal_tambah_bop').on('hidden.bs.modal', function (event) {

                        $('#form-tambah-bop').trigger('reset');

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






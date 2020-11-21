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

}elseif($this->session->flashdata('reset_gagal') == TRUE){

  ?>

  <body onload="new PNotify({

    title:'Reset Password Gagal',

    type: 'error',

    text: '<?php echo $this->session->flashdata('reset_gagal');?>',

    nonblock: {

      nonblock: true

    },

    styling: 'bootstrap3',

    addclass: 'dark'

  });">

</body>



<?php 

}elseif($this->session->flashdata('reset_berhasil') == TRUE){

  ?>

  <body onload="new PNotify({

    title:'Reset Password Berhasil',

    type: 'success',

    text: '<?php echo $this->session->flashdata('reset_berhasil');?>',

    nonblock: {

      nonblock: true

    },

    styling: 'bootstrap3',

    addclass: 'dark'

  });">

</body>

<?php } ?>



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

                if(empty($user)){

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

                        <th width="50px">No</th>

                        <th width="80px">Username</th>

                        <th>Nama</th>

                        <th width="80px">Jabatan</th>

                        <th width="80px">ID Cabang</th>

                        <th width="80px">Nama Cabang</th>

                        <th width="80px">ID Lapangan</th>

                        <th width="100px">Email</th>

                        <th width="80px">Level</th>

                        <th width="80px">Status Akun</th>

                        <th>Aksi</th>

                      </tr>

                    </thead>

                    <tbody>

                      <?php

                  //jika data user tidak kosong maka jalankan perintah dibawah ini

                      if(!empty($user))

                      {

                        $no=1;

                    //load data user

                        foreach ($user as $data)

                        {

                          $waktu_sekarang = date('H:i:s');

                          $username = $data['username']; 

                          $namauser = $data['namauser']; 

                          $jabatan = $data['jabatan'];

                          $level_user = $data['level_user'];

                          $status_user = $data['status_user'];

                          $id_lapangan = $data['id_lapangan'];

                          if(empty($data['id_cabang'])){

                            $id_cabang = "0";

                            $nama_cabang = "-";

                          }else{

                            $id_cabang = $data['id_cabang'];

                            $nama_cabang = $data['nama_cabang'];

                          }

                          $set_login = $data['login_time'];

                          $set_logout = $data['logout_time'];

                          $email = $data['email'];

                          $label1 = "<span class='label label-success pull-right'>Online</span>";

                          $label2 = "<span class='label label-default pull-right'>Offline</span>";



                          ?>  

                          <tr>

                            <?php if($session['level_user']=='Admin'){?>

                              <td><?php echo $no; ?></td>

                            <?php }

                            if($level_user == 'Admin' || $level_user == 'Operator'){

                              if(($set_login <= $waktu_sekarang) && ($set_login != '00:00:00') && ($set_logout == '00:00:00')){ ?>

                                <td><?php echo $username.$label1; ?></td>

                                <?php 

                              }else{

                                ?>

                                <td><?php echo $username.$label2; ?></td>

                                <?php 

                              }

                            }else{

                              ?>

                              <td><?php echo $username; ?></td>

                              <?php 

                            }

                            ?>

                            <td><?php echo $namauser; ?></td>                      

                            <td><?php echo $jabatan; ?></td>

                            <td><?php echo $id_cabang; ?></td>

                            <td><?php echo $nama_cabang; ?></td>

                            <td><?php echo $id_lapangan ?></td>

                            <td><?php echo $email; ?></td>

                            <td><?php echo $level_user; ?></td>

                            <td><?php echo $status_user; ?></td>

                            <td class='center' width='159'>



                              <!--Button Detail-->

                              <a href="javascript:void(0);"

                              data-id_user="<?php echo $data['id_user'];?>"

                              data-id_lapangan="<?php echo $data['id_lapangan'];?>"

                              data-id_cabang="<?php echo $id_cabang;?>"

                              data-nama_cabang="<?php echo $nama_cabang;?>"

                              data-username="<?php echo $data['username'];?>"

                              data-namauser="<?php echo $data['namauser'];?>"

                              data-jabatan="<?php echo $data['jabatan'];?>"

                              data-jk="<?php echo $data['jk'];?>"

                              data-tempat_lahir="<?php echo $data['tempat_lahir'];?>"

                              <?php 

                              $create_tgl = date_create($data['tanggal_lahir']);

                              $tgl_lahir = date_format($create_tgl, "d-m-Y");

                              ?>

                              data-tanggal_lahir="<?php echo $tgl_lahir;?>"

                              data-alamat="<?php echo $data['alamat'];?>"

                              data-tlp="<?php echo $data['no_tlp'];?>"

                              data-email="<?php echo $data['email'];?>"

                              data-level_user="<?php echo $data['level_user'];?>"

                              data-status_user="<?php echo $data['status_user'];?>"

                              class="btn btn-sm btn-success detail-data" title="Detail Data User"><i class="glyphicon glyphicon-check"></i> Detail

                            </a>

                            <!-- End Button Detail-->



                            <!-- Button Ubah-->

                            <a href="javascript:void(0);"

                            data-id_user="<?php echo $data['id_user'];?>"

                            data-id_lapangan="<?php echo $data['id_lapangan'];?>"

                            data-id_cabang="<?php echo $id_cabang;?>"

                            data-nama_cabang="<?php echo $nama_cabang;?>"

                            data-username="<?php echo $data['username'];?>"

                            data-namauser="<?php echo $data['namauser'];?>"

                            data-jabatan="<?php echo $data['jabatan'];?>"

                            data-jk="<?php echo $data['jk'];?>"

                            data-tempat_lahir="<?php echo $data['tempat_lahir'];?>"

                            <?php 

                            $create_tgl = date_create($data['tanggal_lahir']);

                            $tgl_lahir = date_format($create_tgl, "d-m-Y");

                            ?>

                            data-tanggal_lahir="<?php echo $tgl_lahir;?>"

                            data-alamat="<?php echo $data['alamat'];?>"

                            data-tlp="<?php echo $data['no_tlp'];?>"

                            data-email="<?php echo $data['email'];?>"

                            data-level_user="<?php echo $data['level_user'];?>"

                            data-status_user="<?php echo $data['status_user'];?>"

                            class="btn btn-sm btn-warning edit" title="Edit Data User"><i class="glyphicon glyphicon-edit"></i> Edit

                          </a>

                          <!-- End Button Ubah-->



                          <?php 

                          if($session['level_user']=='Admin'){

                            ?>

                            <!-- Button Hapus -->

                            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_delete<?php echo $data['id_user']; ?>" data-placement="top" title="Hapus Data User"><i class="glyphicon glyphicon-trash"></i> Hapus</a>

                            <!-- End Button Hapus-->



                            <!-- Button Reset-->

                            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_reset<?php echo $data['id_user']; ?>" data-placement="top" title="Password Default (admin321)"><i class="glyphicon glyphicon-repeat"></i> Reset Password</a>

                            <!-- End Button Reset-->

                            <?php

                          }    



                          ?>

                        </td>

                      </tr>





                      <!-- Modal Detele Data -->

                      <div class="modal fade" id="modal_delete<?php echo $data['id_user']; ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">

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

                              <a href="<?php echo site_url()."user/hapus/".$data['id_user'];?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>

                            </div>



                          </div>

                        </div>

                      </div>

                      <!-- Modal Detele Data -->



                      <!-- ================================================================================================= -->

                      <!-- Modal Reset Password -->

                      <div class="modal fade" id="modal_reset<?php echo $data['id_user']; ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">

                        <div class="modal-dialog modal-md">

                          <div class="modal-content">

                            <div class="modal-header">

                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>

                              </button>

                              <h4 class="modal-title" id="myModalLabel2">Konfirmasi Reset Password</h4>

                            </div>

                            <div class="modal-body">

                              <p>Silahkan klik tombol <strong> Reset </strong> untuk mereset password ke password default</p>

                            </div>

                            <div class="modal-footer">

                              <button type="button" class="btn btn-success" data-dismiss="modal"><i class="glyphicon glyphicon-backward"></i> Kembali</button>

                              <a href="<?php echo site_url()."user/reset_pass/".$data['id_user'];?>" class="btn btn-danger"><i class="glyphicon glyphicon-repeat"></i> Reset</a>

                            </div>



                          </div>

                        </div>

                      </div>

                      <!-- Modal Reset Data -->

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

                        <h4 class="modal-title" id="myModalLabel">Form Tambah Data User</h4>

                      </div>

                      <div class="modal-body">

                        <p>

                          <form id="form_tambah_data" method="post" action="<?php echo site_url('user/simpan');?>">





                            <label for="id_cabang">ID Cabang * :</label>

                            <select class="form-control" name="id_cabang" id="tambah_id_cabang">

                              <option value="">-- Pilih Cabang -- </option>

                              <?php foreach ($cabang as $key) { ?>

                                <option value="<?php echo $key->id_cabang; ?>"><?php echo $key->nama_cabang; ?></option>

                              <?php } ?>

                            </select>



                            <br>

                            <label for="id_lapangan">ID Lapangan * :</label>

                            <input type="number" id="tambah_id_lapangan" class="form-control" name="id_lapangan" required oninvalid="this.setCustomValidity('Kolom ID Lapangan harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan ID Lapangan" />

                            *Untuk <b>Admin</b> atau <b>Operator</b> adalah Isi ID Lapangan dengan angka 0 (nol)



                            <br>

                            <label for="username">Username * :</label>

                            <input type="text" id="tambah_username" class="form-control" name="username" required oninvalid="this.setCustomValidity('Kolom Username harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan username untuk login" />



                            <br>

                            <label for="nama">Nama Lengkap * :</label>

                            <input type="text" id="tambah_namauser" class="form-control" name="namauser" required oninvalid="this.setCustomValidity('Kolom Nama Lengkap harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan nama lengkap" />



                            <br>

                            <label for="password">Password * :</label>

                            <input type="password" id="tambah_password" class="form-control" name="password" required oninvalid="this.setCustomValidity('Kolom Password harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan password untuk login" />



                            <br>

                            <label for="tlp">Telepon/No.Hp * :</label>

                            <input type="number" id="tambah_tlp" class="form-control" name="tlp" required oninvalid="this.setCustomValidity('Kolom Telepon/No.Hp harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan Telepon/No.Hp" />



                            <br>

                            <label for="email">Email * :</label>

                            <input type="email" id="tambah_email" class="form-control" name="email" required oninvalid="this.setCustomValidity('Kolom Email harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan Email" />



                            <br>

                            <label for="jabatan">Jabatan *:</label>

                            <select class="form-control" id="tambah_jabatan" name="jabatan">

                              <option value="">-- Pilih Jabatan --</option>

                              <option value="Sales">Sales</option>

                              <option value="Team Leader 1">Team Leader 1</option>

                              <option value="Team Leader 2">Team Leader 2</option>

                              <option value="Gruof Leader">Gruof Leader</option>

                              <option value="Asis Leader">Asis Leader</option>

                              <option value="Karyawan Biasa">Karwayan Biasa</option>

                              <option value="Owner">Owner</option>

                            </select>

                            *Jabatan untuk <b>Admin</b> atau <b>Operator</b> adalah Karyawan Biasa atau Owner



                            <p>

                              <label for="jk">Jenis Kelamin *: </label>

                              L:

                              <input type="radio" name="jk" value="Laki-laki" checked="" required /> 

                              P:

                              <input type="radio" name="jk" value="Perempuan" />

                            </p>



                            <label for="tempat_lahir">Tempat Lahir * :</label>

                            <input type="text" id="tambah_tempat_lahir" class="form-control" name="tempat_lahir" required oninvalid="this.setCustomValidity('Kolom Tempat Lahir harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan tempat lahir" />



                            <br>

                            <label for="tanggal_lahir">Tanggal Lahir * :</label>

                            <input type="text" id="tambah_tanggal_lahir" data-date-format="DD-MM-YYYY" class="form-control" name="tanggal_lahir" required oninvalid="this.setCustomValidity('Kolom Tanggal Lahir harus diisi')" oninput="setCustomValidity('')" placeholder="HH-MM-TTTT" />



                            <br>

                            <label for="alamat">Alamat * :</label>

                            <textarea type="text" id="tambah_alamat" class="form-control" name="alamat" required oninvalid="this.setCustomValidity('Kolom alamat harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan Alamat"></textarea>



                            <br>

                            <p>

                              <label for="level">Level User *:</label>

                              Admin:

                              <input type="radio" name="level" value="Admin" /> 

                              | Operator:

                              <input type="radio" name="level" value="Operator"/>

                              | Nothing (-):

                              <input type="radio" name="level" value="-" required />

                              <br>

                              *<b>Operator</b> hanya diperbolehkan 1 Cabang 1 orang Operator.

                              <br>

                              *Pilih <b>Admin</b> atau <b>Operator</b> jika anda memilih Jabatan <b>Owner</b> atau <b>Karyawan Biaya</b>.

                              <br>

                              *Pilih <b>Nothing(-)</b> untuk Jabatan <b>Selain</b> <b>Owner</b> dan <b>Karyawan Biaya</b>.

                            </p>



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

                      $('#modal_tambah').on('show.bs.modal', function (event) {

                        $('#tambah_tanggal_lahir').datetimepicker();

                      });

                    </script>

                    <script type="text/javascript">

                      $('#modal_tambah').on('hidden.bs.modal', function (event) {

                        $('#form_tambah_data').trigger("reset");

                      });

                    </script>



                    <!-- ================================================================================================= -->



                    <!-- Modal Detail Data -->

                    <div class="modal fade" id="detail-data" tabindex="-1" role="dialog" aria-hidden="true">

                      <div class="modal-dialog modal-md">

                        <div class="modal-content">



                          <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>

                            </button>

                            <h4 class="modal-title" id="myModalLabel">Detail Data User</h4>

                          </div>

                          <div class="modal-body">

                            <p>

                              <form>

                                <input type="hidden" id="id_user" name="id_user">



                                <label for="username">ID Cabang :</label>

                                <input type="text" id="id_cabang" name="id_cabang" class="form-control" readonly/>



                                <label for="username">Nama Cabang :</label>

                                <input type="text" id="nama_cabang" name="nama_cabang" class="form-control" readonly/>



                                <label for="username">ID Lapangan :</label>

                                <input type="text" id="id_lapangan" name="id_lapangan" class="form-control" readonly/>



                                <label for="username">Username :</label>

                                <input type="text" id="username" name="username" class="form-control" readonly/>



                                <label for="nama">Nama Lengkap :</label>

                                <input type="text" id="namauser" name="namauser" class="form-control" readonly/>



                                <label for="tlp">Telepon/No.Hp :</label>

                                <input type="text" id="tlp" name="tlp" class="form-control" readonly/>



                                <label for="email">Email :</label>

                                <input type="text" id="email" name="email" class="form-control" readonly/>



                                <label for="jabatan">Jabatan :</label>

                                <input type="text" id="jabatan" name="jabatan" class="form-control" readonly/>



                                <label for="jk">Jenis Kelamin :</label>

                                <input type="text" id="jk" name="jk" class="form-control" readonly/>



                                <label for="tempat_lahir">Tempat Lahir :</label>

                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" readonly/>



                                <label for="tanggal_lahir">Tanggal Lahir :</label>

                                <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control" readonly/>



                                <label for="alamat">Alamat :</label>

                                <textarea type="text" id="alamat" class="form-control" name="alamat" readonly=""></textarea>



                                <label for="level">Level User :</label>

                                <input type="text" id="level_user" name="level" class="form-control" readonly/>



                                <label for="status">Status Akun :</label>

                                <input type="text" id="status_user" name="status" class="form-control" readonly/>



                              </div>

                              <div class="modal-footer">

                                <button type="button" class="btn btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>

                              </div>

                            </form>

                          </div>

                        </div>

                      </div>

                      <!--Script Detail-->

                      <script>

                        $(document).ready(function() {

                      // Untuk sunting

                      $('#datatable').on('click','.detail-data', function () {

                        var div = $(this);



                        $('#detail-data').modal('show');

                          // Isi nilai pada field

                          $('#id_user').val(div.data('id_user'));

                          $('#id_lapangan').val(div.data('id_lapangan'));

                          $('#id_cabang').val(div.data('id_cabang'));

                          $('#nama_cabang').val(div.data('nama_cabang'));

                          $('#username').val(div.data('username'));

                          $('#namauser').val(div.data('namauser'));

                          $('#jabatan').val(div.data('jabatan'));

                          $('#jk').val(div.data('jk'));

                          $('#tempat_lahir').val(div.data('tempat_lahir'));

                          $('#tanggal_lahir').val(div.data('tanggal_lahir'));

                          $('#alamat').html(div.data('alamat'));

                          $('#level_user').val(div.data('level_user'));

                          $('#status_user').val(div.data('status_user'));

                          $('#tlp').val(div.data('tlp'));

                          $('#email').val(div.data('email'));

                        });

                    });

                  </script>

                  <!--End Script Detail-->





                  <!-- ================================================================================================= -->



                  <!-- Modal Edit Data -->

                  <div class="modal fade" id="ubah-data" tabindex="-1" role="dialog" aria-hidden="true">

                    <div class="modal-dialog modal-md">

                      <div class="modal-content">



                        <div class="modal-header">

                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>

                          </button>

                          <h4 class="modal-title" id="myModalLabel">Form Edit Data User</h4>

                        </div>

                        <div class="modal-body" id="body">

                          <p>

                            <form id="form_ubah_data" method="post" action="<?php echo site_url('user/prosesubah');?>">

                              <input type="hidden" id="edit_id_user" name="id_user">



                              <label for="id_cabang">ID Cabang * :</label>

                              <select class="form-control" name="id_cabang" id="edit_id_cabang">

                                <option value="">-- Pilih Cabang --</option>

                                <option value="0">Pusat (OWNER)</option>

                                <?php foreach ($cabang as $key) { ?>

                                  <option value="<?php echo $key->id_cabang; ?>"><?php echo $key->nama_cabang; ?></option>

                                <?php } ?>

                              </select>



                              <br>

                              <label for="id_lapangan">ID Lapangan * :</label>

                              <input type="number" id="edit_id_lapangan" class="form-control" name="id_lapangan" required oninvalid="this.setCustomValidity('Kolom ID Lapangan harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan ID Lapangan" />

                              *Untuk <b>Admin</b> atau <b>Operator</b> adalah Isi ID Lapangan dengan angka 0 (nol)



                              <br>

                              <label for="username">Username * :</label>

                              <input type="text" id="edit_username" class="form-control" name="username" required oninvalid="this.setCustomValidity('Kolom Username harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan username untuk login" readonly="" />



                              <br>

                              <label for="nama">Nama Lengkap * :</label>

                              <input type="text" id="edit_namauser" class="form-control" name="namauser" required oninvalid="this.setCustomValidity('Kolom Nama Lengkap harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan nama lengkap" readonly="" />



                              <!-- <br> -->

                              <!-- <label for="password">Password * :</label> -->

                              <input type="hidden" id="edit_password" class="form-control" name="password"/>



                              <br>

                              <label for="tlp">Telepon/No.Hp * :</label>

                              <input type="number" id="edit_tlp" class="form-control" name="tlp" required oninvalid="this.setCustomValidity('Kolom Telepon/No.Hp harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan Telepon/No.Hp" readonly="" />



                              <br>

                              <label for="email">Email * :</label>

                              <input type="email" id="edit_email" class="form-control" name="email" required oninvalid="this.setCustomValidity('Kolom Email harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan Email" readonly="" />



                              <br>

                              <label for="jabatan">Jabatan *:</label>

                              <select class="form-control" id="edit_jabatan" name="jabatan">

                                <option value="">-- Pilih Jabatan --</option>

                                <option value="Sales">Sales</option>

                                <option value="Team Leader 1">Team Leader 1</option>

                                <option value="Team Leader 2">Team Leader 2</option>

                                <option value="Gruof Leader">Gruof Leader</option>

                                <option value="Asis Leader">Asis Leader</option>

                                <option value="Karyawan Biasa">Karwayan Biasa</option>

                                <option value="Owner">Owner</option>

                              </select>

                              *Jabatan untuk <b>Admin</b> atau <b>Operator</b> adalah Karyawan Biasa atau Owner



                              <p>

                                <label for="jk">Jenis Kelamin *: </label>

                                L:

                                <input type="radio" id="jkL" name="jk" value="Laki-laki" checked="" required /> 

                                P:

                                <input type="radio" id="jkP" name="jk" value="Perempuan" />

                              </p>



                              <label for="tempat_lahir">Tempat Lahir * :</label>

                              <input type="text" id="edit_tempat_lahir" class="form-control" name="tempat_lahir" required oninvalid="this.setCustomValidity('Kolom Tempat Lahir harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan tempat lahir" />



                              <br>

                              <label for="tanggal_lahir">Tanggal Lahir * :</label>

                              <input type="text" id="edit_tanggal_lahir" data-date-format="DD-MM-YYYY" class="form-control" name="tanggal_lahir" required oninvalid="this.setCustomValidity('Kolom Tanggal Lahir harus diisi')" oninput="setCustomValidity('')" placeholder="HH-MM-TTTT" />



                              <br>

                              <label for="alamat">Alamat * :</label>

                              <textarea type="text" id="edit_alamat" class="form-control" name="alamat" required oninvalid="this.setCustomValidity('Kolom alamat harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan Alamat"></textarea>



                              <br>

                              <p>

                                <label for="level">Level User *:</label>

                                Admin:

                                <input type="radio" id="LA" name="level" value="Admin" /> 

                                | Operator:

                                <input type="radio" id="LO" name="level" value="Operator"/>

                                | Nothing (-):

                                <input type="radio" id="LN" name="level" value="-" required />

                                <br>

                                *<b>Operator</b> hanya diperbolehkan 1 Cabang 1 orang Operator.

                                <br>

                                *Pilih <b>Admin</b> atau <b>Operator</b> jika anda memilih Jabatan <b>Owner</b> atau <b>Karyawan Biaya</b>.

                                <br>

                                *Pilih <b>Nothing(-)</b> untuk Jabatan <b>Selain</b> <b>Owner</b> dan <b>Karyawan Biaya</b>.

                              </p>



                              <p>

                                <label for="status">Status Akun *:</label>

                                Aktif:

                                <input type="radio" id="idA" name="status" value="Aktif" /> 

                                Non Aktif:

                                <input type="radio" id="idN" name="status" value="Nonaktif" required/>

                                <br>

                                *Pilih <b>Aktif</b> jikalau anda memilih <b>Admin</b> atau <b>Operator</b>

                              </p>

                            </div>

                            <div class="modal-footer">

                              <button type="button" class="btn btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>

                              <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Simpan</span>

                              </div>

                            </form>

                          </div>

                        </div>

                      </div>





                      <!--Script Edit-->

                      <script>

                        $(document).ready(function() {

                          $("#datatable").on("click",".edit",function() {

                            $("#ubah-data").modal("show");

                            $("#edit_id_user").val($(this).data('id_user'));

                            $("#edit_id_cabang").val($(this).data('id_cabang'));

                            $("#edit_id_lapangan").val($(this).data('id_lapangan'));

                            $("#edit_username").val($(this).data('username'));

                            $("#edit_namauser").val($(this).data('namauser'));

                            $("#edit_tlp").val($(this).data('tlp'));

                            $("#edit_email").val($(this).data('email'));

                            $("#edit_jabatan").val($(this).data('jabatan'));



                            var jk = $(this).data('jk');

                            if(jk=="Laki-laki"){

                              $("#jkL").prop('checked', true);

                              $("#jkP").prop('checked', false);

                            }else{ 

                              $("#jkP").prop('checked', true);

                              $("#jkL").prop('checked', false);

                            }



                            $("#edit_tempat_lahir").val($(this).data('tempat_lahir'));

                            $("#edit_tanggal_lahir").val($(this).data('tanggal_lahir'));

                            $('#edit_tanggal_lahir').datetimepicker();

                            $("#edit_alamat").val($(this).data('alamat'));



                            var lv = $(this).data('level_user');

                            if(lv=="Admin"){

                              $("#LA").prop('checked', true);

                              $("#LO").prop('checked', false);

                              $("#LN").prop('checked', false);                              

                            }else if(lv=="Operator"){

                              $("#LO").prop('checked', true);

                              $("#LN").prop('checked', false);

                              $("#LA").prop('checked', false);

                            }else{

                              $("#LN").prop('checked', true);

                              $("#LA").prop('checked', false);

                              $("#LO").prop('checked', false);

                            }



                            var st = $(this).data('status_user');

                            if(st=="Aktif"){

                              $("#idA").prop('checked', true);

                              $("#idN").prop('checked', false);



                            }else{ 

                              $("#idN").prop('checked', true);

                              $("#idA").prop('checked', false);



                            }

                          });



                          $('#ubah-data').on('hidden.bs.modal', function (event) {

                            $('#form_ubah_data').trigger("reset");

                          });

                        });



                      </script>          



                      <!-- ================================================================================================= -->

                    </tbody>

                  </table>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>






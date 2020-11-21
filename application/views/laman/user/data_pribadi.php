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

  <?php if($session['level_user']=='Operator' || $session['level_user']=='Admin' || $session['level_user']=='-'){?>

    <div class="row">

      <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel">

          <div class="x_title">

            <h2><middle><span class="fa fa-cog"></span> Halaman <?php echo @$sess_location; ?></middle></h2>

            <ul class="nav navbar-right panel_toolbox">

              <?php if($session['level_user']=='Operator' || $session['level_user']=='Admin' || $session['level_user']=='-'){?>

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

      <!-- ================================================ Profil Pengguna =========================================== -->

      <div class="row">

        <div class="col-md-6 col-sm-6 col-xs-12">

          <div class="x_panel">

            <div class="x_title">

              <h2><middle><span class="fa fa-user"></span> Profil Pengguna</middle></h2>

              <ul class="nav navbar-right panel_toolbox">

                <li><a class="collapse-link"></i></a></li>

                <li><a class="collapse-link"></i></a></li>

                <li><a class="collapse-link"></i></a></li>

                <li></li>

                <li></li>

                <li></li>

                <li></li>

                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>

              </ul>

              <div class="clearfix"></div>

            </div>

            <div class="x_content"> 

              <div class="modal-body">

                <p>

                  <form id="form_tambah_data" method="post" class="form-horizontal form-label-left" action="<?php echo site_url('user/simpan');?>">

                    <label for="username">ID Cabang :</label>

                    <?php if(!empty($session['id_cabang'])){ ?>

                      <input type="text" id="id_cabang" name="id_cabang" class="form-control" value="<?= $session['id_cabang']; ?>" readonly/>

                    <?php } else { ?>

                      <input type="text" id="id_cabang" name="id_cabang" class="form-control" value="0" readonly/>

                    <?php } ?>



                    <label for="username">Nama Cabang :</label>

                    <?php if(!empty($session['nama_cabang'])){ ?>

                      <input type="text" id="nama_cabang" name="nama_cabang" class="form-control" value="<?= $session['nama_cabang']; ?>" readonly/>

                    <?php } else{ ?>

                      <input type="text" id="nama_cabang" name="nama_cabang" class="form-control" value="Pusat" readonly/>

                    <?php } ?>

                    <label for="username">ID Lapangan :</label>

                    <input type="text" id="id_lapangan" name="id_lapangan" class="form-control" value="<?= $session['id_lapangan']; ?>" readonly/>



                    <label for="jabatan">Jabatan :</label>

                    <input type="text" id="jabatan" name="jabatan" class="form-control" value="<?= $session['jabatan']; ?>" readonly/>



                    <label for="jk">Jenis Kelamin :</label>

                    <input type="text" id="jk" name="jk" class="form-control" value="<?= $session['jk']; ?>" readonly/>



                    <label for="tempat_lahir">Tempat Lahir :</label>

                    <input type="text" id="tempat_lahir" name="tempat_lahir" value="<?= $session['tempat_lahir']; ?>" class="form-control" readonly/>



                    <label for="tanggal_lahir">Tanggal Lahir :</label>

                    <input type="text" id="tanggal_lahir" name="tanggal_lahir" value="<?= $session['tanggal_lahir']; ?>" class="form-control" readonly/>



                    <label for="alamat">Alamat :</label>

                    <textarea type="text" id="alamat" class="form-control" name="alamat" readonly=""><?= $session['alamat']; ?></textarea>

                    <div class="ln_solid"></div>

                    <p>

                      <div class='alert alert-info alert-dismissible fade in' role='alert'>

                        <i class="fa fa-info-circle"></i> <strong>Informasi</strong> <br>

                        <p>

                          Anda hanya diperbolehkan untuk mengubah username, nama, email dan nomor telepon saja.<br>

                          Jika ada berubahan data username, nama, email atau nomor telepon, silahkan ubah dengan memasukan nilai pada field yang telah disediakan.<br>

                          Jika terdapat kekeliruan data identitas segera hubungi administrator.

                        </p>

                      </div>

                    </p>

                    <!-- Untuk di update -->

                    <div class="ln_solid"></div>

                    <div class="item form-group">

                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username</label>

                      <div class="col-md-9 col-sm-9 col-xs-12">

                        <div class="form-group">

                          <div class='input-group' id="keyup">

                            <input type='text' id="username" class="form-control" name="username" required placeholder="Username Anda" />

                            <span class="input-group-addon btn-info" id="change_username">

                              <span class="fa fa-edit"></span><i> Ubah</i>

                            </span>

                          </div>

                        </div>

                      </div>

                    </div>



                    <div class="item form-group">

                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="namauser">Nama Anda</label>

                      <div class="col-md-9 col-sm-9 col-xs-12">

                        <div class="form-group">

                          <div class='input-group' id="keyup">

                            <input type='text' id="namauser" class="form-control" name="namauser" required placeholder="Nama Anda" />

                            <span class="input-group-addon btn-info" id="change_namauser">

                              <span class="fa fa-edit" ></span><i> Ubah</i>

                            </span>

                          </div>

                        </div>

                      </div>

                    </div>



                    <div class="item form-group">

                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email</label>

                      <div class="col-md-9 col-sm-9 col-xs-12">

                        <div class="form-group">

                          <div class='input-group' id="keyup">

                            <input type='email' id="email" class="form-control" name="email" required placeholder="Email Anda" />

                            <span class="input-group-addon btn-info" id="change_email">

                              <span class="fa fa-edit"></span><i> Ubah</i>

                            </span>

                          </div>

                        </div>

                      </div>

                    </div>



                    <div class="item form-group">

                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nohp">Nomor Handphone</label>

                      <div class="col-md-9 col-sm-9 col-xs-12">

                        <div class="form-group">

                          <div class='input-group' id="keyup">

                            <input type='text' id="no_tlp" class="form-control" name="no_tlp" required placeholder="Nomor Telepon Anda" />

                            <span class="input-group-addon btn-info" id="change_notelp">

                              <span class="fa fa-edit" ></span><i> Ubah</i>

                            </span>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                  <div class="modal-footer">

                  </div>

                </form>

              </div>

            </div>

          </div>

          <script type="text/javascript">

            $(function() {

              get_data_user();



              var id_user = "<?= $session['id_user'];?>";



              $("#change_username").click(function() {

                var username = $("#username").val();



                $.ajax({

                  url: "<?php echo site_url('user/ajax_ubah_username'); ?>",

                  type: "POST",

                  data: {username:username, id_user:id_user},

                  dataType: "JSON",

                  success: function(data){

                    if(data.status == true){

                      get_data_user();

                      (new PNotify({

                        title: 'Informasi',

                        text: 'Username Berhasil Diubah',

                        type: 'success',

                        nonblock: {

                          nonblock: true

                        },

                        addclass: 'dark',

                        styling: 'bootstrap3'

                      }));

                    }else{

                      (new PNotify({

                        title: 'Informasi',

                        text: 'Username Gagal Diubah',

                        type: 'error',

                        nonblock: {

                          nonblock: true

                        },

                        addclass: 'dark',

                        styling: 'bootstrap3'

                      }));

                    }

                  }

                });

              });



              $("#change_namauser").click(function() {

                var namauser = $("#namauser").val();



                $.ajax({

                  url: "<?php echo site_url('user/ajax_ubah_namauser'); ?>",

                  type: "POST",

                  data: {namauser:namauser, id_user:id_user},

                  dataType: "JSON",

                  success: function(data){

                    if(data.status == true){

                      get_data_user();

                      (new PNotify({

                        title: 'Informasi',

                        text: 'Nama User Berhasil Diubah',

                        type: 'success',

                        nonblock: {

                          nonblock: true

                        },

                        addclass: 'dark',

                        styling: 'bootstrap3'

                      }));

                    }else{

                      (new PNotify({

                        title: 'Informasi',

                        text: 'Nama User Gagal Diubah',

                        type: 'error',

                        nonblock: {

                          nonblock: true

                        },

                        addclass: 'dark',

                        styling: 'bootstrap3'

                      }));

                    }

                  }

                });

              });



              $("#change_email").click(function() {

                var email = $("#email").val();



                $.ajax({

                  url: "<?php echo site_url('user/ajax_ubah_email'); ?>",

                  type: "POST",

                  data: {email:email, id_user:id_user},

                  dataType: "JSON",

                  success: function(data){

                    if(data.status == true){

                      get_data_user();

                      (new PNotify({

                        title: 'Informasi',

                        text: 'Email Berhasil Diubah',

                        type: 'success',

                        nonblock: {

                          nonblock: true

                        },

                        addclass: 'dark',

                        styling: 'bootstrap3'

                      }));

                    }else{

                      (new PNotify({

                        title: 'Informasi',

                        text: 'Email Gagal Diubah',

                        type: 'error',

                        nonblock: {

                          nonblock: true

                        },

                        addclass: 'dark',

                        styling: 'bootstrap3'

                      }));

                    }

                  }

                });

              });



              $("#change_notelp").click(function() {

                var no_tlp = $("#no_tlp").val();



                $.ajax({

                  url: "<?php echo site_url('user/ajax_ubah_no_tlp'); ?>",

                  type: "POST",

                  data: {no_tlp:no_tlp, id_user:id_user},

                  dataType: "JSON",

                  success: function(data){

                    if(data.status == true){

                      get_data_user();

                      (new PNotify({

                        title: 'Informasi',

                        text: 'Nomor Telepon Berhasil Diubah',

                        type: 'success',

                        nonblock: {

                          nonblock: true

                        },

                        addclass: 'dark',

                        styling: 'bootstrap3'

                      }));

                    }else{

                      (new PNotify({

                        title: 'Informasi',

                        text: 'Nomor Telepon Gagal Diubah',

                        type: 'error',

                        nonblock: {

                          nonblock: true

                        },

                        addclass: 'dark',

                        styling: 'bootstrap3'

                      }));

                    }

                  }

                });

              }); 



              function get_data_user()

              {

                var id_user = "<?= $session['id_user'];?>";

                $.ajax({

                  url:"<?php echo site_url('user/get_data_user/');?>"+id_user,

                  dataType:"JSON",

                  success:function(data){

                    $('#username').val(data.username);

                    $('#namauser').val(data.namauser);

                    $('#email').val(data.email);

                    $('#no_tlp').val(data.no_tlp);

                  }

                });

              }

            });

          </script>



          <!-- ================================================ Ubah Password =========================================== -->

          <div class="col-md-6 col-sm-6 col-xs-12">

            <div class="x_panel">

              <div class="x_title">

                <h2><middle><span class="fa fa-key"></span> Ubah Password</middle></h2>

                <ul class="nav navbar-right panel_toolbox">

                  <li><a class="collapse-link"></i></a></li>

                  <li><a class="collapse-link"></i></a></li>

                  <li><a class="collapse-link"></i></a></li>

                  <li></li>

                  <li></li>

                  <li></li>

                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>

                </ul>

                <div class="clearfix"></div>

              </div>



              <div class="x_content"> 

                <div class="modal-body">

                  <p>

                    <form method="post" action="<?php echo site_url('user/gantiPassword');?>" class="form-horizontal form-label-left" id="form_ganti_password" data-parsley-validate novalidate>

                      <p>

                        <div class='alert alert-info alert-dismissible fade in' role='alert'>

                          <i class="fa fa-info-circle"></i> <strong>Informasi</strong> <br>

                          <p>

                            Silahkan masukkan Kata Sandi Lama anda untuk memulai proses Ubah Kata Sandi / <i>Password</i>.<br>

                            Jika perubahan Kata Sandi berhasil, maka sistem akan otomatis menghapus <i>Session Login</i> anda, dan silahkan untuk <i>Login</i> kembali.

                          </p>

                        </div>

                      </p>

                      <hr/>

                      <!-- <div id='Area'></div> -->



                      <div class='alert alert-success alert-dismissible fade in hideElement' id='benar' role='alert'>

                        <strong>Password Lama Benar!</strong> Silahkan untuk mengisi <i>field</i> password baru.

                      </div>

                      <div class='alert alert-danger alert-dismissible fade in hideElement' id='salah' role='alert'>

                        <strong>Password Lama Tidak Benar!</strong> Cek kembali Password Lama yang anda masukan.

                      </div>



                      <div class="item form-group">

                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="temp_password">Password Lama</label>

                        <div class="col-md-7 col-sm-7 col-xs-12">

                          <div class="form-group">

                            <div class='input-group' id="keyup">

                              <input type='password' id="temp_password" class="form-control" name="temp_password" required placeholder="Masukan Password Lama Anda" required="required" />

                              <span class="input-group-addon">

                                <span class="fa fa-eye-slash" id="keyup_temp_password"></span>

                              </span>

                            </div>

                          </div>

                        </div>

                      </div>



                      <div class="item form-group">

                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="new_password">Password Baru</label>

                        <div class="col-md-7 col-sm-7 col-xs-12">

                          <div class="form-group">

                            <div class='input-group' id="keyup">

                              <input type='password' id="new_password" class="form-control" name="new_password" placeholder="Masukan Password Baru Anda" required/>

                              <c id='passbaru' class='text-warning'></c>

                              <span class="input-group-addon">

                                <span class="fa fa-eye-slash" id="keyup_new_password"></span>

                              </span>

                            </div>

                          </div>

                        </div>

                      </div>



                      <div class="item form-group">

                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="temp_password">Konfirmasi Password Baru</label>

                        <div class="col-md-7 col-sm-7 col-xs-12">

                          <div class="form-group">

                            <div class='input-group' id="keyup">

                              <input id="password" type="password" name="password" class="form-control col-md-7 col-xs-12" placeholder="Masukan Kembali Password Baru Anda" required>

                              <c id='passtidaksama' class='text-warning'></c>

                              <span class="input-group-addon">

                                <span class="fa fa-eye-slash" id="keyup_password"></span>

                              </span>

                            </div>

                          </div>

                        </div>

                      </div>



                    </div>

                    <div class="modal-footer">

                      <button type="button" id="ganti" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Submit</span>

                        <button id="reset" class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-refresh"></span> Reset</button>

                      </div>

                    </form>



                  </div>

                </div>

              </div>

            </div>

          </div>



          <!--Modal Logout-->

          <div class="modal fade" id="modal_konfirmasi" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">

            <div class="modal-dialog modal-md">

              <div class="modal-content">

                <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>

                  </button>

                  <h4 class="modal-title" id="myModalLabel2">Konfirmasi Ubah Password</h4>

                </div>

                <div class="modal-body">

                  <p>Silahkan klik tombol <strong> Ubah Sekarang </strong> untuk mengubah password. Jika Proses Berhasil sistem akan menghapus Session Login dan <strong>Silahkan Login Kembali</strong></p>

                </div>

                <div class="modal-footer">

                  <a id="submitUbahPassword" class="btn btn-success"><i class="fa fa-edit"></i> Ubah Sekarang</a>

                  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>

                </div>

              </div>

            </div>

          </div>



          <script type="text/javascript">

            $(function(){

              $("#ganti").click(function(){

                $("#modal_konfirmasi").modal('show');

              });

              $("#submitUbahPassword").click(function(){

                $("#form_ganti_password").submit();

              });

            });

          </script>



          <script type="text/javascript">



            $(document).ready(function(){

              $("#new_password").attr("disabled","disabled");

              $("#password").attr("disabled","disabled");

              $("#ganti").attr("disabled","disabled");



              $('#password').on('keyup', function () {

                var nps = $("#new_password").val();

                var ps = $("#password").val();



                if(nps == ps){

                  $("#passtidaksama").text("");

                  $("#ganti").removeAttr("disabled","disabled");

                }else{

                  $("#passtidaksama").text("Password tidak sama dengan password baru");

                  $("#ganti").attr("disabled","disabled");

                }

              });



              $('#new_password').on('keyup', function () {

                var nps = $("#new_password").val();

                var tp = $("#temp_password").val();

                var jml = nps.length;



                // alert(jml);



                if(jml == 0){

                  $("#passbaru").text("");

                  $("#ganti").attr("disabled","disabled");

                  $("#password").attr("disabled","disabled");

                }



                if(jml>0 && jml<8){

                  $("#passbaru").text("");

                  $("#passbaru").text("Password baru minimal berisikan 8 Karakter"); 

                  $("#ganti").attr("disabled","disabled");

                  $("#password").attr("disabled","disabled");

                }



                if((jml>0) && (jml<8) && (nps == tp)){

                  $("#passbaru").text("");

                  $("#passbaru").text("Password baru tidak boleh sama dengan password lama. Password baru minimal berisikan 8 Karakter."); 

                  $("#ganti").attr("disabled","disabled");

                  $("#password").attr("disabled","disabled");

                }



                if(jml>=8){

                  $("#passbaru").text("");

                  $("#ganti").attr("disabled","disabled");

                  $("#password").removeAttr("disabled","disabled"); 

                }



                if((jml>=8) && (nps == tp)){

                  $("#passbaru").text("");

                  $("#passbaru").text("Password baru tidak boleh sama dengan password lama");

                  $("#ganti").attr("disabled","disabled");

                  $("#password").removeAttr("disabled","disabled"); 

                }



                // if(nps == tp){

                //   $("#passbaru").text("Password baru tidak boleh sama dengan password lama");

                //   $("#ganti").attr("disabled","disabled");

                //   $("#password").attr("disabled","disabled");

                // }else{

                //   $("#passbaru").text("");

                //   $("#ganti").attr("disabled","disabled");

                //   $("#password").removeAttr("disabled","disabled");

                // }

              });





              $('#temp_password').on('keyup', function () { 

                var temp_password = $("#temp_password").val();

                if(temp_password != ""){

                  $.ajax({

                    type:'POST',  

                    cache:false,

                    url:"<?php echo site_url('user/temp_password'); ?>",

                    data:"temp_password=" + temp_password,

                    success: function(html)

                    { 

                      var status = html;

                      if(status == "benar"){

                        $("#benar").show();

                        $("#salah").hide();

                        $("#new_password").removeAttr("disabled","disabled");

                        $("#password").removeAttr("disabled","disabled");

                        $("#ganti").removeAttr("disabled","disabled");

                      }else{

                        $("#salah").show()

                        $("#benar").hide();

                        $("#new_password").attr("disabled","disabled");

                        $("#password").attr("disabled","disabled");

                        $("#ganti").attr("disabled","disabled");

                      }

                      setTimeout(function(){

                        $('#benar').hide();

                        $('#salah').hide();

                      }, 10000);

                    }

                  });   

                }  

              }); 



              $("#keyup_temp_password").click(function(){

                if($("#temp_password").attr('type') == 'password'){

                  $("#temp_password").attr('type','text');

                  $("#keyup_temp_password").removeClass('fa-eye-slash');

                  $("#keyup_temp_password").addClass('fa-eye');

                }else{

                  $("#temp_password").attr('type','password');

                  $("#keyup_temp_password").addClass('fa-eye-slash');

                  $("#keyup_temp_password").removeClass('fa-eye');

                }

              });



              $("#keyup_new_password").click(function(){

                if($("#new_password").attr('type') == 'password'){

                  $("#new_password").attr('type','text');

                  $("#keyup_new_password").removeClass('fa-eye-slash');

                  $("#keyup_new_password").addClass('fa-eye');

                }else{

                  $("#new_password").attr('type','password');

                  $("#keyup_new_password").addClass('fa-eye-slash');

                  $("#keyup_new_password").removeClass('fa-eye');

                }

              });



              $("#keyup_password").click(function(){

                if($("#password").attr('type') == 'password'){

                  $("#password").attr('type','text');

                  $("#keyup_password").removeClass('fa-eye-slash');

                  $("#keyup_password").addClass('fa-eye');

                }else{

                  $("#password").attr('type','password');

                  $("#keyup_password").addClass('fa-eye-slash');

                  $("#keyup_password").removeClass('fa-eye');

                }

              });







            });



          </script>




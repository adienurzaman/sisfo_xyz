<?php
$tahun = date('Y');
$versionApp = '2.0';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Login Area | CV. Xyz</title>

  <link rel="shortcut icon" href="<?php echo base_url('build/img/Logo.png'); ?>" type="image/x-icon" />

  <!-- Bootstrap -->

  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css'); ?>" />

  <!-- Font Awesome -->

  <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" />

  <!-- NProgress -->

  <link rel="stylesheet" href="<?php echo base_url('assets/nprogress/nprogress.css'); ?>" />

  <!-- PNotify -->

  <link href="<?php echo base_url('assets/pnotify/dist/pnotify.css'); ?>" rel="stylesheet">

  <link href="<?php echo base_url('assets/pnotify/dist/pnotify.buttons.css'); ?>" rel="stylesheet">

  <link href="<?php echo base_url('assets/pnotify/dist/pnotify.nonblock.css'); ?>" rel="stylesheet">

  <!-- Custom Theme Style -->

  <link rel="stylesheet" href="<?php echo base_url('build/css/custom.css?v=' . $versionApp); ?>" />

  <!-- jQuery -->
  <link rel="manifest" href="<?php echo base_url(); ?>manifest.json">

  <script src="<?php echo base_url('assets/jquery/dist/jquery.min.js'); ?>"></script>

</head>


<body style="background-color:#eaeaea;" class="login">

  <?php

  if ($this->session->flashdata('error_login') == TRUE) {
  ?>

    <body onload="new PNotify({

      title:'Gagal Login',

      type: 'error',

      text: 'Akun anda belum terdaftar atau Nonaktif, segera hubungi Admin Sistem.',

      nonblock: {

        nonblock: true

      },

      styling: 'bootstrap3',

      addclass: 'dark'

    });">

    </body>

  <?php
  } elseif ($this->session->flashdata('sql_injection_attack') == TRUE) {
  ?>

    <body onload="new PNotify({

    title:'SQL Injection Attack',

    type: 'error',

    text: 'Serangan SQL Injection terdeteksi, Website ini tidak dapat diinjeksi.',

    nonblock: {

      nonblock: true

    },

    styling: 'bootstrap3',

    addclass: 'dark'

  });">

    </body>
  <?php
  } elseif ($this->session->flashdata('password_salah') == TRUE) {
  ?>

    <body onload="new PNotify({

    title:'Password Tidak Tepat',

    type: 'error',

    text: 'Segera Hubungi Admin Sistem. PASSWORD yang anda masukan TIDAK TEPAT',

    nonblock: {

      nonblock: true

    },

    styling: 'bootstrap3',

    addclass: 'dark'

  });">

    </body>
  <?php
  } elseif (@$suksesLogout) {

  ?>

    <body onload="new PNotify({

    title:'Berhasil Logout',

    type: 'success',

    text: 'Anda telah keluar dari sistem. Session anda otomatis terhapus',

    nonblock: {

      nonblock: true

    },

    styling: 'bootstrap3',

    addclass: 'dark'

  });">

    </body>

  <?php

  } else {

  ?>

    <body onload="new PNotify({

    title:'Silahkan Login terlebih dahulu',

    type: 'info',

    text: 'Session anda belum tersedia. Silahkan Login untuk masuk ke sistem ini',

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

  <div class="login_wrapper">
    <div class="animate form login_form">
      <div class="x_panel">
        <div>
          <center><img src="<?php echo base_url('build/img/xyz_1.png'); ?>" height="100" class="img img-rounded">
            <h2>CV. XYZ</h2>
          </center>
        </div>
        <section class="login_content">
          <form action="<?php echo site_url('login'); ?>" method="POST">
            <h1>Login Form</h1>
            <div>
              <input autocomplete="off" type="text" name="username" class="form-control" placeholder="Username" required="" />
            </div>
            <div>
              <input type="password" name="password" class="form-control" placeholder="Password" required="" />
            </div>
            <div>
              <a>
                <button data-toggle="tooltip" data-placement="left" class="btn btn-info form-control" type="submit" title="Masuk ke Dalam Sistem"><span class="glyphicon glyphicon-log-in"></span> Masuk Sistem</button>
              </a>
            </div>
            <div>
              <button class="btn btn-default form-control" id="forgot" type="button" data-toggle="tooltip" data-placement="right" title="Lupa Password"><span class="fa fa-question-circle" id="change"></span>
                <d class="" id="lupa">Lupa Kata Sandi</d>
                <c class="hideElement" id="tutup">Tutup (klik 2x)</c>
              </button>
              <p>
                <input type="email" name="email" class="form-control hideElement" id="email" placeholder="Masukkan Email Yang Anda Daftarkan" />
                <button class="btn btn-default form-control hideElement" id="send" type="button" data-toggle="tooltip" data-placement="right" title="Submit"><span class="fa fa-check-circle"></span> Submit</button>
              </p>
            </div>

            <div class="clearfix"></div>

            <div class="separator">

              <div class="clearfix"></div>
              <br />

              <div>
                <!--<center><img src="<?php echo base_url('build/img/Logo.png'); ?>" height="80" class="img img-rounded"> </center> <h2>Putra Mandiri Traders Clothis</h2>-->
                <p>© <?php echo $tahun; ?> All Rights Reserved. <br>Page Rendered is <strong>{elapsed_time}</strong><i> second </i> <br>Version <?php echo $versionApp; ?></p>
              </div>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>

  <div class="clearfix"></div>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#forgot").click(function() {
        $("#email").show();
        $("#email").val("");
        $("#send").show();
        $('#change').removeClass();
        $('#change').addClass('fa fa-times-circle');
        $('#tutup').show();
        $('#lupa').hide();
      }).dblclick(function() {
        $("#email").hide();
        $("#email").val("");
        $("#send").hide();
        $('#change').removeClass();
        $('#change').addClass('fa fa-question-circle');
        $('#tutup').hide();
        $('#lupa').show();
      });
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#send").on("click", function() {
        $('#email').hide();
        $('#change').removeClass();
        $('#change').addClass('fa fa-question-circle');
        $('#tutup').hide();
        $('#lupa').show();
        $("#send").hide();

        var email = $('#email').val();
        $.ajax({
          type: 'POST',
          url: "<?php echo site_url('login/forgot'); ?>",
          cache: false,
          data: {
            email: email
          },
          dataType: "JSON",
          success: function(data) {

            if (data.status) //if success tutup modal and reload ajax table
            {
              (new PNotify({
                title: 'Password Baru Terkirim',
                text: 'Password Baru telah dikirimkan ke email anda. Segera Cek Email Anda',
                type: 'success',
                nonblock: {
                  nonblock: true
                },
                addclass: 'dark',
                styling: 'bootstrap3'
              }));
            } else {
              (new PNotify({
                title: 'Informasi',
                text: 'Gagal Mengirim Email Reset Password',
                type: 'error',
                nonblock: {
                  nonblock: true
                },
                addclass: 'dark',
                styling: 'bootstrap3'
              }));
            }


          },
          error: function(jqXHR, textStatus, errorThrown) {
            // alert('Error adding / update data');
            (new PNotify({
              title: 'Informasi',
              text: 'Gagal memproses data. Email tidak terdaftar. Hubungi Administrator Sistem',
              type: 'error',
              nonblock: {
                nonblock: true
              },
              addclass: 'dark',
              styling: 'bootstrap3'
            }));
          }
        });
      });
    });
  </script>



  <script src="<?php echo base_url('build/js/main.js'); ?>"></script>
  <!-- Bootstrap -->

  <script src="<?php echo base_url('assets/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

  <!-- NProgress -->

  <script src="<?php echo base_url('assets/nprogress/nprogress.js'); ?>"></script>

  <!-- PNotify -->

  <script src="<?php echo base_url('assets/pnotify/dist/pnotify.js'); ?>"></script>

  <script src="<?php echo base_url('assets/pnotify/dist/pnotify.buttons.js'); ?>"></script>

  <script src="<?php echo base_url('assets/pnotify/dist/pnotify.nonblock.js'); ?>"></script>

  <!-- Custom Theme Scripts -->

  <script src="<?php echo base_url('build/js/custom.js'); ?>"></script>

</body>

</html>
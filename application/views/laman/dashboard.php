<script type="text/javascript">

    //set timezone

    <?php date_default_timezone_set('Asia/Jakarta'); ?>

    //buat object date berdasarkan waktu di server

    var serverTime = new Date(<?php print date('Y, m, d, H, i, s, 0'); ?>);

    //buat object date berdasarkan waktu di client

    var clientTime = new Date();

    //hitung selisih

    var Diff = serverTime.getTime() - clientTime.getTime();    

    //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik

    function displayServerTime(){

        //buat object date berdasarkan waktu di client

        var clientTime = new Date();

        //buat object date dengan menghitung selisih waktu client dan server

        var time = new Date(clientTime.getTime() + Diff);

        //ambil nilai jam

        var sh = time.getHours().toString();

        //ambil nilai menit

        var sm = time.getMinutes().toString();

        //ambil nilai detik

        var ss = time.getSeconds().toString();

        //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)

        document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);

    }

</script>

<body onload="setInterval('displayServerTime()', 1000);">

<?php if($session['level_user']=='Operator'){ 

$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");

$hari = date("w");

$hari_ini = $seminggu[$hari];





?>

<div class="container">

<div class="right_col" role="main">

  <div class="x_panel">

                  <div class="x_title">

                    <h2><?php echo @$sess_location; ?></h2>

                    <ul class="nav navbar-right panel_toolbox">

                        <li>

                          <button data-toggle="tooltip" data-placement="left" title="Kembali Ke Welcome Page"  class="btn btn-sm btn-warning" onclick="window.location.href='<?php echo base_url()?>backend/welcome'"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali ke Halaman Utama</button>

                        </li>

                    </ul>

                    <div class="clearfix"></div>

                  </div>

                  <div class="x_content">

                    <h4>Selamat Datang<small> di Aplikasi Sistem Operasi Keuangan CV. XYZ</small></h4>

                    <br/>

                    <p align=center>Hai <b><?php echo @$namalengkap;?></b>, selamat datang di halaman Operator Cabang <?php echo $session['id_cabang']; ?>. 

                    <br/>Silahkan klik menu pilihan yang berada di bagian Welcome Page untuk mengelola sistem Aplikasi Ini. <br /> <b><?php echo $hari_ini;?>, <?php echo date('d-m-Y');?>,&nbsp;<span id="clock"><?php print date('H:i:s'); ?></span></b> WIB

              </p>

                  </div>

                </div>

  <div class="row top_tiles">

              <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">

                <div class="tile-stats">

                  <div class="icon"><i class="fa fa-users"></i></div>

                  <div class="count"><?php echo isset($get_jml_lap[0]['jumlah'])?$get_jml_lap[0]['jumlah']:'';?></div>

                  <h3>Lapangan</h3>

                </div>

              </div>

              <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">

                <div class="tile-stats">

                  <div class="icon"><i class="fa fa-check-square-o"></i></div>

                  <div class="count"><?php echo $session['id_cabang']; ?></div>

                  <h3>Kode Cabang</h3>

                </div>

              </div>

            </div>

</div>

<?php }elseif($session['level_user']='Admin'){

$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");

$hari = date("w");

$hari_ini = $seminggu[$hari];

?>

<div class="container">

<div class="right_col" role="main">

  <div class="x_panel">

                  <div class="x_title">

                    <h2><?php echo @$sess_location; ?></h2>

                    <ul class="nav navbar-right panel_toolbox">

                      <li><a class="collapse-link"></i></a></li>

                        <li><a class="collapse-link"></i></a></li>

                        <li><a class="collapse-link"></i></a></li>

                        <li>

                        </li>

                        <li>

                        

                        </li>

                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                      </li>

                    </ul>

                    <div class="clearfix"></div>

                  </div>

                  <div class="x_content">

                    <h4>Selamat Datang<small> di Aplikasi Sistem Operasi Keuangan CV. XYZ</small></h4>

                    <br/>

                    <p align=center>Hai <b><?php echo @$namalengkap;;?></b>, selamat datang di halaman Administrator. 

                    <br/>Silahkan klik menu pilihan yang berada di bagian Sidebar Menu untuk mengelola sistem Aplikasi Ini. <br /> <b><?php echo $hari_ini;?>, <?php echo date('d-m-Y');?>,&nbsp;<span id="clock"><?php print date('H:i:s'); ?></span></b> WIB

              </p>

                  </div>

                </div>

          

</div>

</div>

<?php } ?>

</body>
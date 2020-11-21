<script type="text/javascript">
    $(document).ready(function() {
        $('#alert').delay(3000).fadeOut();
    });
</script>
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
    <?php 
    if($session['level_user']=='Operator'){
        ?>
        <?php 
        // $id = 'target="_blank"';
        $id = '';
        $seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $hari = date("w");
        $hari_ini = $seminggu[$hari];
        ?>
        <br>
        <?php 
        $id = '';
        ?>
        <div class="demo-area">
            <div class="container">
                <?php
                if($this->session->flashdata('login_berhasil')==TRUE){
                    ?>
                    <div class="alert alert-success alert-dismissible" id="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-close"></i> Login Berhasil. <?php echo $this->session->flashdata('login_berhasil')?>.
                    </div>
                    <?php
                }elseif($this->session->flashdata('access_denied')==TRUE){
                    ?>

                    <div class="alert alert-danger alert-dismissible" id="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-close"></i> Access Denied. <?php echo $this->session->flashdata('access_denied')?>.
                    </div>
                    <?php
                }
                ?>
                <div class="row">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2><img src="<?php echo base_url('build/img/xyz_2.png');?>" height="100" class="img img-rounded"></h2>
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
                    <h4>Selamat Datang<small> di Aplikasi Sistem Informasi Keuangan CV. XYZ</small></h4>
                    <br/>
                    <p align=center>Hai <b><?php echo @$namalengkap;;?></b>, selamat datang di halaman Panel Operator. 
                        <br/>Silahkan klik menu pilihan yang berada di bagian bawah, untuk mengelola sistem Aplikasi Ini. <br /> <b><?php echo $hari_ini;?>, <?php echo date('d-m-Y');?>,&nbsp;<span id="clock"><?php print date('H:i:s'); ?></span></b> WIB
                    </p>
                </div> 
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                    <div class="demo-item">
                        <div class="thumb-area">
                            <a href="<?php echo site_url('backend/dashboard');?>" ><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_build-website.png');?>" alt="demo image"></a>
                            <a href="<?php echo site_url('backend/dashboard');?>" class="lets-view" <?php echo $id;?>><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                        <div class="demo-title">
                            <h2>Dashboard / Home</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                    <div class="demo-item">
                        <div class="thumb-area">
                            <a href="<?php echo site_url('staff');?>" ><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_affiliate-marketing.png');?>" alt="demo image"></a>
                            <a href="<?php echo site_url('staff');?>" class="lets-view" <?php echo $id;?>><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                        <div class="demo-title">
                            <h2>Setting Cabang dan Staff</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                    <div class="demo-item">
                        <div class="thumb-area">
                            <a href="<?php echo site_url('set_pelaporan');?>" ><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_content-management.png');?>" alt="demo image"></a>
                            <a href="<?php echo site_url('set_pelaporan');?>" class="lets-view" <?php echo $id;?>><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                        <div class="demo-title">
                            <h2>Setting Pelaporan </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                    <div class="demo-item">
                        <div class="thumb-area">
                            <a href="<?php echo site_url('set_persen');?>"><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_WEB-analytics.png');?>" alt="demo image"></a>
                            <a href="<?php echo site_url('set_persen');?>" class="lets-view" <?php echo $id;?>><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                        <div class="demo-title">
                            <h2>Setting Persentase Gaji</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                    <div class="demo-item">
                        <div class="thumb-area">
                            <a href="<?php echo site_url('omzet');?>" ><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_revenues.png');?>" alt="demo image"></a>
                            <a href="<?php echo site_url('omzet');?>" class="lets-view" <?php echo $id;?>><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                        <div class="demo-title">
                            <h2>Rekapitulasi Omzet Harian</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                    <div class="demo-item">
                        <div class="thumb-area">
                            <a href="<?php echo site_url('gaji_anggaran');?>" ><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_calculator,-computer.png');?>" alt="demo image"></a>
                            <a href="<?php echo site_url('gaji_anggaran');?>" class="lets-view" <?php echo $id;?>><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                        <div class="demo-title">
                            <h2>Kontribusi Gaji & By Operasional</h2>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                    <div class="demo-item">
                        <div class="thumb-area">
                            <a href="<?php echo site_url('rincian_gaji');?>" ><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_training-courses-flipchart.png');?>" alt="demo image"></a>
                            <a href="<?php echo site_url('rincian_gaji');?>" class="lets-view" <?php echo $id;?>><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                        <div class="demo-title">
                            <h2>Rincian Gaji</h2>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                    <div class="demo-item">
                        <div class="thumb-area">
                            <a href="<?php echo site_url('cashbon');?>" ><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_sync.png');?>" alt="demo image"></a>
                            <a href="<?php echo site_url('cashbon');?>" class="lets-view" <?php echo $id;?>><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                        <div class="demo-title">
                            <h2>Cashbon Sales & Leader</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                    <div class="demo-item">
                        <div class="thumb-area">
                            <a href="<?php echo site_url('biaya_op');?>" ><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_conversion-optimization.png');?>" alt="demo image"></a>
                            <a href="<?php echo site_url('biaya_op');?>" class="lets-view" <?php echo $id;?>><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                        <div class="demo-title">
                            <h2>Biaya Operasional</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                    <div class="demo-item">
                        <div class="thumb-area">
                            <a href="<?php echo site_url('posisi_uang');?>" ><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_pay-per-click.png');?>" alt="demo image"></a>
                            <a href="<?php echo site_url('posisi_uang');?>" class="lets-view" <?php echo $id;?>><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                        <div class="demo-title">
                            <h2>Informasi Posisi Uang</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                    <div class="demo-item">
                        <div class="thumb-area">
                            <a href="<?php echo site_url('user/set_data_pribadi');?>" ><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_SEO-consultant.png');?>" alt="demo image"></a>
                            <a href="<?php echo site_url('user/set_data_pribadi');?>" class="lets-view" <?php echo $id;?>><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                        <div class="demo-title">
                            <h2>Setting Data Pribadi</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                    <div class="demo-item">
                        <div class="thumb-area">
                            <a data-toggle="modal" data-target=".bs-example-modal-md"><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_rocket-startup-launch-campaign-mission.png');?>" alt="demo image"></a>
                            <a data-toggle="modal" data-target=".bs-example-modal-md" class="lets-view"><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                        <div class="demo-title">
                            <h2>Logout Sistem</h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php 
}elseif($session['level_user']=='-'){ ?>
    <?php
    $seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
    $hari = date("w");
    $hari_ini = $seminggu[$hari];
    ?>
    <br>
    <?php 
    $id = '';
    ?>
    <div class="demo-area">
        <div class="container">
            <?php
            if($this->session->flashdata('login_berhasil')==TRUE){
                ?>
                <div class="alert alert-success alert-dismissible" id="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-close"></i> Login Berhasil. <?php echo $this->session->flashdata('login_berhasil')?>.
                </div>
                <?php
            }elseif($this->session->flashdata('access_denied')==TRUE){
                ?>

                <div class="alert alert-danger alert-dismissible" id="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-close"></i> Access Denied. <?php echo $this->session->flashdata('access_denied')?>.
                </div>
                <?php
            }
            ?>
            <div class="row">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><img src="<?php echo base_url('build/img/xyz_2.png');?>" height="100" class="img img-rounded"></h2>
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
                <h4>Selamat Datang<small> di Aplikasi Sistem Informasi Keuangan CV. XYZ</small></h4>
                <br/>
                <p align=center>Hai <b><?php echo @$namalengkap;;?></b>, selamat datang di halaman Panel Sales. 
                    <br/>Silahkan klik menu pilihan yang berada di bagian bawah, untuk mengelola sistem Aplikasi Ini. <br /> <b><?php echo $hari_ini;?>, <?php echo date('d-m-Y');?>,&nbsp;<span id="clock"><?php print date('H:i:s'); ?></span></b> WIB
                </p>
            </div> 
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                <div class="demo-item">
                    <div class="thumb-area">
                        <a href="<?php echo site_url('omzet');?>" ><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_revenues.png');?>" alt="demo image"></a>
                        <a href="<?php echo site_url('omzet');?>" class="lets-view" <?php echo $id;?>><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                    <div class="demo-title">
                        <h2>Rekapitulasi Omzet Harian</h2>
                    </div>
                </div>
            </div>            
            <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                <div class="demo-item">
                    <div class="thumb-area">
                        <a href="<?php echo site_url('user/set_data_pribadi');?>" ><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_SEO-consultant.png');?>" alt="demo image"></a>
                        <a href="<?php echo site_url('user/set_data_pribadi');?>" class="lets-view" <?php echo $id;?>><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                    <div class="demo-title">
                        <h2>Setting Data Pribadi</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                <div class="demo-item">
                    <div class="thumb-area">
                        <a data-toggle="modal" data-target=".bs-example-modal-md"><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_rocket-startup-launch-campaign-mission.png');?>" alt="demo image"></a>
                        <a data-toggle="modal" data-target=".bs-example-modal-md" class="lets-view"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                    <div class="demo-title">
                        <h2>Logout Sistem</h2>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php 
}else{
    ?>
    <br>
    <?php 
        // $id = 'target="_blank"';
    $id = '';
    $seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
    $hari = date("w");
    $hari_ini = $seminggu[$hari];
    ?>

    <br>
    <?php 
    $id = '';
    ?>
    <div class="demo-area">
        <div class="container">
            <?php
            if($this->session->flashdata('login_berhasil')==TRUE){
                ?>
                <div class="alert alert-info alert-dismissible" id="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-close"></i> Login Berhasil. <?php echo $this->session->flashdata('login_berhasil')?>.
                </div>
                <?php
            }elseif($this->session->flashdata('access_denied')==TRUE){
                ?>

                <div class="alert alert-danger alert-dismissible" id="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-close"></i> Access Denied. <?php echo $this->session->flashdata('access_denied')?>.
                </div>
                <?php
            }
            ?>
            <div class="row">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><img src="<?php echo base_url('build/img/xyz_2.png');?>" height="100" class="img img-rounded"></h2>
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
                <h4>Selamat Datang<small> di Aplikasi Sistem Informasi Keuangan CV. XYZ</small></h4>
                <br/>
                <p align=center>Hai <b><?php echo @$namalengkap;;?></b>, selamat datang di halaman Administrator. 
                    <br/>Silahkan klik menu pilihan yang berada di bagian bawah, untuk mengelola sistem Aplikasi Ini. <br /> <b><?php echo $hari_ini;?>, <?php echo date('d-m-Y');?>,&nbsp;<span id="clock"><?php print date('H:i:s'); ?></span></b> WIB
                </p>
            </div> 
        </div>
        <br>
        <br>

        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                <div class="demo-item">
                    <div class="thumb-area">
                        <a href="<?php echo site_url('user');?>"><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_team-Social-media-marketing.png');?>" alt="demo image"></a>
                        <a href="<?php echo site_url('user');?>" class="lets-view" <?php echo $id;?>><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                    <div class="demo-title">
                        <h2>Setting Akun</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                <div class="demo-item">
                    <div class="thumb-area">
                        <a href="<?php echo site_url('set_cabang');?>"><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_affiliate-marketing.png');?>" alt="demo image"></a>
                        <a href="<?php echo site_url('set_cabang');?>" class="lets-view" <?php echo $id;?>><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                    <div class="demo-title">
                        <h2>Setting Cabang</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                <div class="demo-item">
                    <div class="thumb-area">
                        <a href="<?php echo site_url('view_progress');?>"><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_analysis-69.png');?>" alt="demo image"></a>
                        <a href="<?php echo site_url('view_progress');?>" class="lets-view" <?php echo $id;?>><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                    <div class="demo-title">
                        <h2>View Progress</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                <div class="demo-item">
                    <div class="thumb-area">
                        <a href="<?php echo site_url('user/set_data_pribadi');?>" ><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_SEO-consultant.png');?>" alt="demo image"></a>
                        <a href="<?php echo site_url('user/set_data_pribadi');?>" class="lets-view" <?php echo $id;?>><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                    <div class="demo-title">
                        <h2>Setting Data Pribadi</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 col-2">
                <div class="demo-item">
                    <div class="thumb-area">
                        <a data-toggle="modal" data-target=".bs-example-modal-md"><img src="<?php echo base_url('build/img/iconok/color/128px/Icon_rocket-startup-launch-campaign-mission.png');?>" alt="demo image"></a>
                        <a data-toggle="modal" data-target=".bs-example-modal-md" class="lets-view"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                    <div class="demo-title">
                        <h2>Logout Sistem</h2>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<?php
}
?>

<!--Modal Logout-->
<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h5 class="modal-title" id="myModalLabel2">Konfirmasi Logout Sistem</h5>
      </div>
      <div class="modal-body">
          <p>Silahkan klik tombol <strong> Logout </strong> untuk keluar dari sistem</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal"><i class="glyphicon glyphicon-refresh"></i> Kembali</button>
          <a href="<?php echo site_url('login/logout'); ?>" class="btn btn-warning"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
      </div>

  </div>
</div>
</div>
<!--/Modal-->
</body>
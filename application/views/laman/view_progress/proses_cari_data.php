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
            <?php if($session['level_user']=='Admin'){?>
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
              <h2><middle><span class="fa fa-database"></span> Data Get Operator </middle></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"></i></a></li>
                <li><a class="collapse-link"></i></a></li>
                <li><a class="collapse-link"></i></a></li>
                <li><a class="collapse-link"></i></a></li>
                <li>
                </li>
                <li>
                </li>
                <li>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>

            <div class="x_content">
              <div class="row top_tiles">
                <?php if(!empty($get_operator)){
                  foreach ($get_operator as $data) {
                    $id_user = $data['id_user'];
                    $id_cabang = $data['id_cabang'];
                    $nama_cabang = $data['nama_cabang'];
                    $nama = $data['namauser'];
                    $jabatan = $data['level_user'];
                    $status = $data['status_user'];
                    $waktu_sekarang = date('H:i:s');
                    $set_login = $data['login_time'];
                    $set_logout = $data['logout_time'];
                    ?>
                    <?php
                    if(($set_login <= $waktu_sekarang) && ($set_login != '00:00:00') && ($set_logout == '00:00:00')){ 
                      $label1 = "<span class='label label-success pull-right'>Online</span>";
                    }else{
                      $label1 = "<span class='label label-default pull-right'>Offline</span>";
                    }
                    ?>
                      <a href="<?php echo site_url()."view_progress/get_operator/".$data['id_user']."/".$data['id_cabang'];?>">
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <div class="tile-stats">
                            <div class="icon"></div>
                            <div class="count"><?php echo 'Cabang : '.$id_cabang.$label1; ?></div>
                            <p><h3><strong><?php echo $nama_cabang;?></h3></strong></p>
                            <h3><?php echo $nama.' ( '.$jabatan.' - '.$status.' )'; ?></h3>
                          </div>
                        </div>
                      </a>
                    <?php
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>


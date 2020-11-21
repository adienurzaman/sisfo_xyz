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
  <?php if($session['level_user']=='Operator'){?>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><middle><span class="fa fa-cog"></span> Halaman <?php echo @$sess_location; ?></middle></h2>
            <ul class="nav navbar-right panel_toolbox">          
              <?php if($session['level_user']=='Operator'){?>
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
                <?php if($session['level_user']=='Operator'){
                  if(!empty($get_jml_lap)){
                    ?>
                    <li>
                      <a>
                        <button type="button" data-placement="top" title="Tambah Data User" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_tambah"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                      </a>
                    </li>
                  <?php }else{
                    ?>
                    <li>
                      <button type="button" data-placement="top" title="Tambah Data User" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_tambah"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
                    </li>
                    <?php
                  }
                }else{
                  ?>
                  <li>
                    <button type="button" data-toggle="tooltip" data-placement="left" title="Kembali Ke Welcome Page" class="btn btn-sm btn-warning" onclick="window.location.href='<?php echo base_url()?>backend/welcome'"><i class="glyphicon glyphicon-circle-arrow-left"></i> Kembali</button>
                    
                  </li>
                <?php }
                if(!empty($get_jml_lap)){
                  foreach ($get_jml_lap as $data)
                  { 
                    ?>  
                    <li>
                      <a href="javascript:;"
                      data-id="<?php echo $data['id_jumlah'];?>"
                      data-id_u="<?php echo $data['id_user'];?>"
                      data-id_c="<?php echo $data['id_cabang'];?>"
                      data-jumlah="<?php echo $data['jumlah'];?>"
                      data-toggle="modal" data-target="#data_set_jum">
                      <button  class="btn btn-sm btn-warning" title="<?php echo 'Jumlah Lapangan : '.$data['jumlah'];?>"><i class="glyphicon glyphicon-cog"></i> Setting Jumlah Lapangan</button>
                    </a>
                  </li>
                  <?php
                }
              }else{
                ?>
                <li>
                  <button  class="btn btn-sm btn-info" data-toggle="modal" data-target="#data_set_jum" title="Setting Jumlah Lapangan"><i class="glyphicon glyphicon-cog"></i> Setting Jumlah Lapangan</button>
                </li>
                <?php
              }
              ?>
            </ul>
            <div class="clearfix"></div>
          </div>
          
          <div class="x_content"> 
            <div class='table-responsive'>
              <?php
              if($session['level_user']=='Operator'){
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
                      <?php if($session['level_user']=='Operator'){?>      
                        <th width="50px">No</th>
                      <?php } ?>

                      <th width="80px">Username</th>
                      <th>Nama</th>
                      <th>Cabang</th>
                      <th>Lapangan</th>
                      <th width="80px">Jabatan</th>
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

                        $username = $data['username']; 
                        $nama = $data['namauser']; 
                        $jabatan = $data['jabatan'];
                        $level = $data['level_user'];
                        $status = $data['status_user'];
                        $cabang = $data['id_cabang'];
                        $lapangan = $data['id_lapangan'];
                        ?>  
                        <tr>
                          <?php if($session['level_user']=='Operator'){?>
                            <td><?php echo $no; ?></td>
                          <?php } ?>
                          <td><?php echo $username; ?></td>
                          <td><?php echo $nama; ?></td> 
                          <td><?php echo $cabang; ?></td> 
                          <td><?php echo $lapangan; ?></td>                      
                          <td><?php echo $jabatan; ?></td>
                          <td><?php echo $level; ?></td>
                          <td><?php echo $status; ?></td>
                          <td class='center' width='159'>
                            <!--Button Detail-->
                            <a href="javascript:;"
                            data-id="<?php echo $data['id_user'];?>"
                            data-idlapangan="<?php echo $data['id_lapangan'];?>"
                            data-idcabang="<?php echo $data['id_cabang'];?>"
                            data-username="<?php echo $data['username'];?>"
                            data-nama="<?php echo $data['namauser'];?>"
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
                            data-toggle="modal" data-target="#detail-data">
                            <button  class="btn btn-sm btn-success" title="Detail Data User"><i class="glyphicon glyphicon-check"></i> Detail</button>
                          </a>
                          <!-- End Button Detail-->

                          <!-- Button Ubah-->
                          <a href="javascript:;"
                          data-id="<?php echo $data['id_user'];?>"
                          data-idlapangan="<?php echo $data['id_lapangan'];?>"
                          data-idcabang="<?php echo $data['id_cabang'];?>"
                          data-username="<?php echo $data['username'];?>"
                          data-nama="<?php echo $data['namauser'];?>"
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
                          data-toggle="modal" data-target="#ubah-data">
                          <button  class="btn btn-sm btn-warning" title="Edit Data User"><i class="glyphicon glyphicon-edit"></i> Edit</button>
                        </a>
                        <!-- End Button Ubah-->

                        <?php 
                        if($session['level_user']=='Operator'){
                          ?>
                          <!-- Button Hapus-->
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

                                <label for="username">ID Lapangan :</label>
                                <input type="text" id="id_lapangan" name="id_lapangan" class="form-control" readonly/>

                                <label for="username">Username :</label>
                                <input type="text" id="username" name="username" class="form-control" readonly/>

                                <label for="nama">Nama Lengkap :</label>
                                <input type="text" id="namauser" name="namauser" class="form-control" readonly/>

                                <label for="tlp">Telepon/No.Hp :</label>
                                <input type="text" id="tlp" name="tlp" class="form-control" readonly/>

                                <label for="tlp">Email :</label>
                                <input type="text" id="email" name="tlp" class="form-control" readonly/>

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
                      $('#detail-data').on('show.bs.modal', function (event) {
                          var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
                          var modal = $(this)

                          // Isi nilai pada field
                          modal.find('#id_user').val(div.data('id_user'));
                          modal.find('#id_lapangan').val(div.data('idlapangan'));
                          modal.find('#id_cabang').val(div.data('idcabang'));
                          modal.find('#username').val(div.data('username'));
                          modal.find('#namauser').val(div.data('nama'));
                          modal.find('#jabatan').val(div.data('jabatan'));
                          modal.find('#jk').val(div.data('jk'));
                          modal.find('#tempat_lahir').val(div.data('tempat_lahir'));
                          modal.find('#tanggal_lahir').val(div.data('tanggal_lahir'));
                          modal.find('#alamat').html(div.data('alamat'));
                          modal.find('#level_user').val(div.data('level_user'));
                          modal.find('#status_user').val(div.data('status_user'));
                          modal.find('#tlp').val(div.data('tlp'));
                          modal.find('#email').val(div.data('email'));
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
                          <h4 class="modal-title" id="myModalLabel">Form Edit Data Staff</h4>
                        </div>
                        <div class="modal-body" id="body">
                          <p>
                            <form id="form_ubah_data" method="post" action="<?php echo site_url('staff/prosesubah');?>">
                              <input type="hidden" id="id_user" name="id_user">

                              <label for="id_cabang">ID Cabang :</label>
                              <input type="number" id="id_cabang" name="id_cabang" class="form-control" readonly="" />

                              <label for="id_lapangan">ID Lapangan :</label>
                              <input type="number" id="id_lapangan" name="id_lapangan" class="form-control"/>


                              <label for="username">Username * :</label>
                              <input type="text" id="username" class="form-control" name="username" readonly="" />
                              
                              <label for="namauser">Nama Lengkap * :</label>
                              <input type="text" id="namauser" class="form-control" name="namauser" required oninvalid="this.setCustomValidity('Kolom Nama Lengkap harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan nama lengkap" readonly="" />
                              
                              <!-- <label for="password">Password :</label> -->
                              <input type="hidden" id="password" class="form-control" name="password" placeholder="Masukkan Password Baru apabila ingin mengganti password" />                     

                              <label for="tlp">Telepon/No.Hp * :</label>
                              <input type="number" id="tlp" class="form-control" name="tlp" required oninvalid="this.setCustomValidity('Kolom Telepon/No.Hp harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan Telepon/No.Hp" readonly="" />

                              <label for="email">Email * :</label>
                              <input type="email" id="email" class="form-control" name="email" required oninvalid="this.setCustomValidity('Kolom Email harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan Email" readonly="" />
                              
                              <label for="jabatan">Jabatan *:</label>
                              <p>
                                Sales:
                                <input type="radio" id="jbS" name="jabatan" value="Sales" /> 
                                | Team Leader 1 :
                                <input type="radio" id="jbtl1" name="jabatan" value="Team Leader 1" checked="" required/>
                                | Team Leader 2 :
                                <input type="radio" id="jbtl2" name="jabatan" value="Team Leader 2" checked="" required/>
                                | Gruof Leader :
                                <input type="radio" id="jbgl" name="jabatan" value="Gruof Leader" checked="" required/>
                                | Asis Leader :
                                <input type="radio" id="jbal" name="jabatan" value="Asis Leader" checked="" required/>
                                | Karyawan Biasa:
                                <input type="radio" id="jbK" name="jabatan" value="Karyawan Biasa" />
                              </p>

                              <label for="jk">Jenis Kelamin *:</label>
                              <p>
                                L:
                                <input type="radio" id="jkL" name="jk" value="Laki-laki" /> 
                                | P:
                                <input type="radio" id="jkP" name="jk" value="Perempuan" />
                              </p>

                              <label for="tempat_lahir">Tempat Lahir * :</label>
                              <input type="text" id="tempat_lahir" class="form-control" name="tempat_lahir" required oninvalid="this.setCustomValidity('Kolom Tempat Lahir harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan tempat lahir" />

                              <label for="tanggal_lahir">Tanggal Lahir * :</label>
                              <div class="form-group">
                                <div class='input-group date' id="myDatepicker2">
                                  <input type='text' id="tanggal_lahir" class="form-control" name="tanggal_lahir" required oninvalid="this.setCustomValidity('Kolom Tanggal Lahir harus diisi')" oninput="setCustomValidity('')" placeholder="HH-BB-TTTT" />
                                  <span class="input-group-addon">
                                   <span class="glyphicon glyphicon-calendar"></span>
                                 </span>
                               </div>
                             </div>
                             
                             <label for="alamat">Alamat * :</label>
                             <textarea type="text" id="alamat" class="form-control" name="alamat" required oninvalid="this.setCustomValidity('Kolom alamat harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan Alamat"></textarea>

                             
                             <label for="level">Level User *:</label>
                             <p>
                              Operator:
                              <input type="radio" id="LO" name="level" value="Operator"/>
                              | Nothing (-):
                              <input type="radio" id="LN" name="level" value="-" />
                            </p>

                            <label for="status">Status Akun *:</label>
                            <p>
                              Aktif:
                              <input type="radio" id="idA" name="status" value="Aktif" /> 
                              | Non Aktif:
                              <input type="radio" id="idN" name="status" value="Nonaktif" />
                            </p>
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


                  <script>
                    $(document).ready(function() {
                      // Untuk sunting
                      $('#ubah-data').on('show.bs.modal', function (event) {
                          var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
                          var modal = $(this);
                          var jk = div.data('jk');
                          var st = div.data('status_user');
                          var jb = div.data('jabatan');
                          var lv = div.data('level_user');
                          
                          
                          // Isi nilai pada field
                          modal.find('#id_user').val(div.data('id'));
                          modal.find('#id_lapangan').val(div.data('idlapangan'));
                          modal.find('#id_cabang').val(div.data('idcabang'));
                          modal.find('#username').val(div.data('username'));
                          modal.find('#namauser').val(div.data('nama'));
                          
                          if(jk=="Laki-laki"){
                            $("#jkL").prop('checked', true);
                            $("#jkP").prop('checked', false);
                          }else{ 
                            $("#jkP").prop('checked', true);
                            $("#jkL").prop('checked', false);
                          }
                          
                          modal.find('#tempat_lahir').val(div.data('tempat_lahir'));
                          modal.find('#tanggal_lahir').val(div.data('tanggal_lahir'));

                          if(jb=="Sales"){
                            $("#jbS").prop('checked', true);
                            $("#jbtl1").prop('checked', false);
                            $("#jbtl2").prop('checked', false);
                            $("#jbgl").prop('checked', false);
                            $("#jbal").prop('checked', false);
                            $("#jbK").prop('checked', false);
                            $("#jbO").prop('checked', false);
                            
                          }else if(jb=="Team Leader 1"){
                            $("#jbtl1").prop('checked', true);
                            $("#jbtl2").prop('checked', false);
                            $("#jbgl").prop('checked', false);
                            $("#jbal").prop('checked', false);
                            $("#jbK").prop('checked', false);
                            $("#jbO").prop('checked', false);
                            $("#jbS").prop('checked', false);
                            
                          }else if(jb=="Team Leader 2"){
                            $("#jbtl1").prop('checked', false);
                            $("#jbtl2").prop('checked', true);
                            $("#jbgl").prop('checked', false);
                            $("#jbal").prop('checked', false);
                            $("#jbK").prop('checked', false);
                            $("#jbO").prop('checked', false);
                            $("#jbS").prop('checked', false);
                            
                          }else if(jb=="Gruof Leader"){
                            $("#jbtl1").prop('checked', false);
                            $("#jbtl2").prop('checked', false);
                            $("#jbgl").prop('checked', true);
                            $("#jbal").prop('checked', false);
                            $("#jbK").prop('checked', false);
                            $("#jbO").prop('checked', false);
                            $("#jbS").prop('checked', false);
                            
                          }else if(jb=="Asis Leader"){
                            $("#jbtl1").prop('checked', false);
                            $("#jbtl2").prop('checked', false);
                            $("#jbgl").prop('checked', false);
                            $("#jbal").prop('checked', true);
                            $("#jbK").prop('checked', false);
                            $("#jbO").prop('checked', false);
                            $("#jbS").prop('checked', false);
                            
                          }else if(jb=="Karyawan Biasa"){
                           $("#jbtl1").prop('checked', false);
                           $("#jbtl2").prop('checked', false);
                           $("#jbgl").prop('checked', false);
                           $("#jbal").prop('checked', false);
                           $("#jbK").prop('checked', true);
                           $("#jbO").prop('checked', false);
                           $("#jbS").prop('checked', false);
                           
                         }else{ 
                          $("#jbtl1").prop('checked', false);
                          $("#jbtl2").prop('checked', false);
                          $("#jbgl").prop('checked', false);
                          $("#jbal").prop('checked', false);
                          $("#jbK").prop('checked', false);
                          $("#jbO").prop('checked', true);
                          $("#jbS").prop('checked', false);
                          
                        }

                        modal.find('#alamat').html(div.data('alamat'));

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

                        if(st=="Aktif"){
                          $("#idA").prop('checked', true);
                          $("#idN").prop('checked', false);
                          
                        }else{ 
                          $("#idN").prop('checked', true);
                          $("#idA").prop('checked', false);
                          
                        }

                        modal.find('#tlp').val(div.data('tlp'));
                        modal.find('#email').val(div.data('email'));
                        $('#myDatepicker').datetimepicker();
                        $('#myDatepicker2').datetimepicker({
                          format: 'DD-MM-YYYY'
                        });
                      });

                  $('#ubah-data').on('hidden.bs.modal', function (event) {
                    $('#form_ubah_data').trigger("reset");
                  });
                  });

                  </script>
              <!-- <script>
               $(document).ready(function() {
              });
            </script> -->
            
            <!-- ================================================================================================= -->
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
                    <a href="<?php echo site_url()."staff/hapus/".$data['id_user'];?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
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
                    <a href="<?php echo site_url()."staff/reset_pass/".$data['id_user'];?>" class="btn btn-danger"><i class="glyphicon glyphicon-repeat"></i> Reset</a>
                  </div>

                </div>
              </div>
            </div>
            <!-- Modal Reset Data -->

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
              <h4 class="modal-title" id="myModalLabel">Form Tambah Data Staff</h4>
            </div>
            <div class="modal-body">
              <p>
                <form id="form_tambah_data" method="post" action="<?php echo site_url('staff/simpan');?>">
                  <label for="id_cabang">ID Cabang * :</label>
                  <input type="text" id="id_cabang" class="form-control" name="id_cabang" required oninvalid="this.setCustomValidity('Kolom ID Cabang harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan ID Cabang" readonly="readonly" value="<?php echo $id_cabang;?>" />

                  <label for="id_lapangan">ID Lapangan * :</label>
                  <input type="number" id="id_lapangan" class="form-control" name="id_lapangan" required oninvalid="this.setCustomValidity('Kolom ID Lapangan harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan ID Lapangan" />


                  <label for="username">Username * :</label>
                  <input type="text" id="username" class="form-control" name="username" required oninvalid="this.setCustomValidity('Kolom Username harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan username untuk login" />

                  <label for="nama">Nama Lengkap * :</label>
                  <input type="text" id="nama" class="form-control" name="namauser" required oninvalid="this.setCustomValidity('Kolom Nama Lengkap harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan nama lengkap" />

                  <label for="password">Password * :</label>
                  <input type="password" id="password" class="form-control" name="password" required oninvalid="this.setCustomValidity('Kolom Password harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan password untuk login" value="admin321" />

                  <label for="tlp">Telepon/No.Hp * :</label>
                  <input type="number" id="tlp" class="form-control" name="tlp" required oninvalid="this.setCustomValidity('Kolom Telepon/No.Hp harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan Telepon/No.Hp" />

                  <label for="email">Email * :</label>
                  <input type="email" id="email" class="form-control" name="email" required oninvalid="this.setCustomValidity('Kolom Email harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan Email" />

                  <label for="jabatan">Jabatan *:</label>
                  <p>
                    Sales:
                    <input type="radio" id="jbS" name="jabatan" value="Sales" /> 
                    | Team Leader 1 :
                    <input type="radio" id="jbtl1" name="jabatan" value="Team Leader 1" checked="" required/>
                    | Team Leader 2 :
                    <input type="radio" id="jbtl2" name="jabatan" value="Team Leader 2" checked="" required/>
                    | Gruof Leader :
                    <input type="radio" id="jbgl" name="jabatan" value="Gruof Leader" checked="" required/>
                    | Asis Leader :
                    <input type="radio" id="jbal" name="jabatan" value="Asis Leader" checked="" required/>
                    | Karyawan Biasa:
                    <input type="radio" id="jbK" name="jabatan" value="Karyawan Biasa" />
                  </p>

                  <label for="jk">Jenis Kelamin *:</label>
                  <p>
                    L:
                    <input type="radio" name="jk" value="Laki-laki" checked="" required /> 
                    P:
                    <input type="radio" name="jk" value="Perempuan" />
                  </p>

                  <label for="tempat_lahir">Tempat Lahir * :</label>
                  <input type="text" id="tempat_lahir" class="form-control" name="tempat_lahir" required oninvalid="this.setCustomValidity('Kolom Tempat Lahir harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan tempat lahir" />

                  <label for="tanggal_lahir">Tanggal Lahir * :</label>
                  <input type="text" id="myDatepicker" data-date-format="DD-MM-YYYY" class="form-control" name="tanggal_lahir" required oninvalid="this.setCustomValidity('Kolom Tanggal Lahir harus diisi')" oninput="setCustomValidity('')" placeholder="HH-BB-TTTT" />

                  <label for="alamat">Alamat * :</label>
                  <textarea type="text" id="alamat" class="form-control" name="alamat" required oninvalid="this.setCustomValidity('Kolom alamat harus diisi')" oninput="setCustomValidity('')" placeholder="Masukkan Alamat"></textarea>

                  <label for="level">Level User *:</label>
                  <p>
                  <!-- Operator:
                    <input type="radio" id="LO" name="level" value="Operator"/> -->
                    Nothing (-):
                    <input type="radio" id="LN" name="level" value="-" checked="" required/>
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
                    $('#myDatepicker').datetimepicker();
                  });
                </script>
                <script type="text/javascript">
                  $('#modal_tambah').on('hidden.bs.modal', function (event) {
                    $('#form_tambah_data').trigger("reset");
                  });
                </script>
                        
                      </tbody>
                    </table>

                    <!-- ============================================== Setting Jumlah Lapangan ========================================= -->
                    <!-- Modal Set Data Jumlah Lapangan -->
                    <div class="modal fade" id="data_set_jum" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Form Setting Jumlah Lapangan</h4>
                          </div>
                          <div class="modal-body">
                            <p>
                              <?php 
                              if(!empty($get_jml_lap)){
                                ?>
                                <form id="form-id" method="post" action="<?php echo site_url('staff/prosesubah_jml_lap');?>"/>
                                  <?php 
                                }else{
                                  ?>
                                  <form id="form-id" method="post" action="<?php echo site_url('staff/simpan_jml_lap');?>"/>
                                    <?php 
                                  } 
                                  ?>
                                  <div class="form-group">
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="id_u" id="id_u">
                                    <input type="hidden" name="id_c" id="id_c">
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="jumlah">Jumlah Lapangan</label>
                                    <div>
                                      <!-- <input type="number" id="jumlah" name="jumlah" class="form-control" required oninvalid="this.setCustomValidity('Kolom Jumlah Lapangan harus diisi')" oninput="setCustomValidity('')" placeholder="Jumlah Lapangan"/> -->
                                    <select class="form-control" name="jumlah" id="jumlah">
                                      <option value="">-- Pilih Jumlah Lapangan --</option>
                                      <?php for($i=1;$i<=11;$i++){ ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                      <?php } ?>
                                    </select>
                                    </div>
                                  </div>
                                  
                                </p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal"><i class="glyphicon glyphicon-step-backward"></i> Kembali</button>
                                <?php 
                                if(!empty($get_jml_lap)){
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
                      $('#data_set_jum').on('show.bs.modal', function (event) {
                          var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
                          var modal = $(this);
                          
                          // Isi nilai pada field
                          modal.find('#id').val(div.data('id'));
                          modal.find('#id_u').val(div.data('id_u'));
                          modal.find('#id_c').val(div.data('id_c'));
                          modal.find('#jumlah').val(div.data('jumlah'));
                          
                        });
                      $('#data_set_al').on('hidden.bs.modal', function (event) {
                        $('#form-id').trigger('reset');
                      });
                    });
                  </script>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      
      
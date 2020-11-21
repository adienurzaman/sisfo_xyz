<div class="top_nav">

    <div class="">

      </div>

      <nav >

      <ul class="nav navbar-nav navbar-right">

        <li class="">

          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

            <?php

            if($session['jk']=='Laki-laki'){

              ?>  

              <img src="<?php echo base_url('build/img/avatar5.png');?>" alt="Image">

              <?php

            }else{  

              ?>  

              <img src="<?php echo base_url('build/img/avatar3.png');?>" alt="Image">

              <?php

            }

            ?>  

            <span>

              <span><?php echo @$namalengkap; ?></span>

            </span>

            <span class=" fa fa-angle-down"></span>

          </a>

          <ul class="dropdown-menu dropdown-usermenu pull-right">

            <!--Dropdown Logout-->

            <li><a data-toggle="modal" data-target=".bs-example-modal-md"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>

          </ul>

        </li>

      </ul>

    </nav>



    <!--Modal Logout-->

    <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="true">

      <div class="modal-dialog modal-md">

        <div class="modal-content">



          <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>

            </button>

            <h4 class="modal-title" id="myModalLabel2">Konfirmasi Logout Sistem</h4>

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

  </div>

</div>


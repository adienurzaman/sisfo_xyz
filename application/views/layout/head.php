<?php 
$version = '8.2';
?>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo @$sess_location; ?> | CV. Xyz</title>
<link rel="shortcut icon" href="<?php echo base_url('build/img/xyz_2.png');?>" type="image/x-icon"/>

<!-- Primary Assets -->
    <!-- Google Fonts
        ============================================ -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
        ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('primary_assets/css/bootstrap.min.css');?>">
    <!-- Bootstrap CSS
        ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('primary_assets/css/font-awesome.min.css');?>">
    <!-- owl.carousel CSS
        ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('primary_assets/css/owl.carousel.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('primary_assets/css/owl.theme.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('primary_assets/css/owl.transitions.css');?>">
    <!-- meanmenu CSS
        ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('primary_assets/css/meanmenu/meanmenu.min.css');?>">
    <!-- animate CSS
        ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('primary_assets/css/animate.css');?>">
    <!-- normalize CSS
        ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('primary_assets/css/normalize.css');?>">
    <!-- mCustomScrollbar CSS
        ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('primary_assets/css/scrollbar/jquery.mCustomScrollbar.min.css');?>">
    <!-- jvectormap CSS
        ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('primary_assets/css/jvectormap/jquery-jvectormap-2.0.3.css');?>">
    <!-- notika icon CSS
        ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('primary_assets/css/notika-custom-icon.css');?>">
    <!-- wave CSS
        ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('primary_assets/css/wave/waves.min.css');?>">
    <!-- main CSS
        ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('primary_assets/css/main.css');?>">
    <!-- style CSS
        ============================================ -->
        <!-- <link rel="stylesheet" href="<?php echo base_url('primary_assets/css/style.css');?>"> -->
    <!-- responsive CSS
        ============================================ -->
        <link rel="stylesheet" href="<?php echo base_url('primary_assets/css/responsive.css');?>">

    <!-- modernizr JS
        ============================================ -->
        <script src="<?php echo base_url('primary_assets/js/vendor/modernizr-2.8.3.min.js');?>"></script>



        <!-- <link rel="manifest" href="<?php echo base_url();?>manifest.json"> -->
        <!-- Bootstrap -->
        <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" >
        <!-- Font Awesome -->
        <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo base_url('assets/nprogress/nprogress.css');?>" rel="stylesheet">    
        <!-- PNotify -->
        <link href="<?php echo base_url('assets/pnotify/dist/pnotify.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/pnotify/dist/pnotify.buttons.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/pnotify/dist/pnotify.nonblock.css');?>" rel="stylesheet">
        <!-- Datatables -->
        <link href="<?php echo base_url('assets/datatables.net-bs/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/datatables.net-responsive-bs/css/responsive.bootstrap.min.css').'?v=' .$version;?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/dataTables/dataTables.bootstrap.css')?>" rel="stylesheet" />
        <link href="<?php echo base_url('assets/datatables.net-bs/css/dataTables.bootstrap.min.css');?>" rel="stylesheet" type="text/css">
        <!-- bootstrap-daterangepicker -->
        <link href="<?php echo base_url('assets/bootstrap-daterangepicker/daterangepicker.css');?>" rel="stylesheet">
        <!-- bootstrap-datetimepicker -->
        <link href="<?php echo base_url('assets/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css');?>" rel="stylesheet">



        <!-- Custom Theme Style -->
        <link href="<?php echo base_url('build/css/custom.css') . '?v=' . $version;?>" rel="stylesheet">
        <?php 
        if($sess_location=='Welcome Page'){
            ?>
            <link href="<?php echo base_url('build/css/style.css'). '?v=' . $version;;?>" rel="stylesheet" type="text/css" >
            <link href="<?php echo base_url('build/css/responsive.css'). '?v=' . $version;;?>" rel="stylesheet" type="text/css" >
            <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.css');?>" rel="stylesheet" type="text/css" >
            <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" >
            <?php
        }
        ?>

        <script src="<?php echo base_url('assets/jquery/dist/jquery.min.js');?>"></script>
        
        <link href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>



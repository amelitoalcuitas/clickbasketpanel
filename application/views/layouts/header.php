<?php
  if($this->session->userdata('logged_in') == TRUE) {

  } else {
    redirect('login');
  }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title id="titleUpdate"> ClickBasket Panel </title>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url().'assets/plugins/jquery/jquery.min.js';?>"></script>

    <!-- Favicon-->
     <link rel="icon" href="<?php echo base_url().'assets/favicon.ico';?>" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="<?php echo base_url().'assets/css/googlefonts.css';?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url().'assets/css/material-icons.css';?>" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url().'assets/plugins/bootstrap/css/bootstrap.css';?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url().'assets/plugins/node-waves/waves.css';?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url().'assets/plugins/animate-css/animate.css';?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url().'assets/css/style.css';?>" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url().'assets/css/themes/all-themes.css';?>" rel="stylesheet" />

     <!-- JQuery DataTable Css -->
    <link href="<?php echo base_url().'assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet';?>">
    <link href="<?php echo base_url().'assets/css/scroller.dataTables.min.css" rel="stylesheet';?>">

    <!-- Sweet Alert -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/sweetalert/sweetalert.css';?>">
    <script src="<?php echo base_url().'assets/plugins/sweetalert/sweetalert.min.js';?>"></script>

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?php echo base_url().'assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css';?>" rel="stylesheet" />

     <!-- Bootstrap Select Css -->
     <link href="<?php echo base_url().'assets/plugins/bootstrap-select/css/bootstrap-select.css';?>" rel="stylesheet" />

     <!-- TimeAgo -->
     <script src="<?php echo base_url().'assets/js/jquery.timeago.js';?>"></script>

     <!--Chart JS-->
     <script src="<?php echo base_url().'assets/plugins/chartjs/chart/chart.bundle.js';?>"></script>

   <style media="screen">
    .btn-circle {
      width: 40px;
      height: 40px;
      text-align: center;
      padding: 7px 0;
      font-size: 12px;
      line-height: 1.42;
      border-radius: 50%;
    }

    .dtp-select-year-before, .dtp-select-year-after, .dtp-select-month-before, .dtp-select-month-after{
      color: white !important;
    }

     .modal {
       overflow-y: auto;
     }

     .modal-open {
       overflow: auto;
     }

     .modal-open[style] {
       padding-right: 0px !important;
     }

     .emptyInput{
       background-color: #ffe5e5;
     }

     .sameName{
       background-color: #ffbcbc;
     }

     .prodExist{
       background-color: #fff9a5;
     }

     #anchor-element {
       display: none;
       text-transform: uppercase;
     }

     #anchor-div:hover #anchor-element {
       display: block;
     }

     img {
       display: inline-block;
       vertical-align: middle;
       max-height: 100%;
       max-width: 100%;
     }

     .imageview {
       font-size: 0;
       text-align: center;
       width: 150px;
       height: 200px;
     }

     .storeimageview {
       font-size: 0;
       text-align: center;
       width: 550px;
       height: 275px;
     }

     .prodimageview {
       font-size: 0;
       text-align: center;
       width: 250px;
       height: 250px;
     }

     .selectedRow{
       background-color: #fffb8c !important;
     }
   </style>

</head>


<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->

    <!-- TOP NAVIGATION BAR-->
    <?php
    if($this->session->userdata('restriction')=='vendor' && $this->session->userdata('restriction')!='superadmin'){
        $this->load->view('vendor_blocks/TopNav');
    }else{
        $this->load->view('blocks/TopNav');
    }
    ?>
    <!-- END OF TOP BAR NAV-->

    <section>
        <!-- Left Sidebar -->

        <!-- #END# Left Sidebar -->
    </section>

<!-- LOAD MODALS  -->

 <?php $this->load->view('layouts/modals'); ?>


     <section class="content">
         <div class="container-fluid">
             <div class="block-header">

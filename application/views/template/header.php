<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Expedition |
        <?=$titulo?>
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?=base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url('assets/bower_components/font-awesome/css/font-awesome.min.css')?>">

    <link rel="stylesheet" href="<?=base_url('assets/bower_components/fontawesome-free-5.6.3/css/all.min.css')?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?=base_url('assets/bower_components/Ionicons/css/ionicons.min.css')?>">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?=base_url('assets/bower_components/jvectormap/jquery-jvectormap.css')?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?=base_url('assets/bower_components/select2/dist/css/select2.min.css')?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('assets/dist/css/AdminLTE.min.css')?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?=base_url('assets/dist/css/skins/_all-skins.min.css')?>">

    <link rel="shortcut icon" href="<?=base_url('assets/dist/img/favicon.png')?>" />
    <!-- DataTables -->
    <link rel="stylesheet" href="<?=base_url('assets/')?>bower_components/datatables/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- <link rel="stylesheet" href="<=base_url('assets/')?>bower_components/datatables/buttons-1.5.4/css/buttons.bootstrap.min.css> -->

     <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/iCheck/all.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->

</head>

<body class=" sidebar-collapse hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?=base_url()?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><img src="<?=base_url('assets/dist/img/exp2.png')?>"></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><img src="<?=base_url('assets/dist/img/exp.png')?>"></span>

            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <?php $this->load->view('template/menu-nav')?>
        </header>
        <input type="hidden" name="base_url" id="base_url" value="<?=base_url();?>">
        <input type="hidden" name="admin" id="admin" value="<?=$this->ion_auth->is_admin();?>">
        <!-- =============================================== -->
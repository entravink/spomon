<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">


          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl;?>/dist/img/bps-large.png">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-navy">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <?php 
        $wil=Yii::app()->user->getWilayah();
        $notif = count(TUpload::model()->findAllByAttributes(array('upload_status'=>3),array('with'=>array('uploadOpd'),'condition'=>'uploadOpd.opd_wil=:wil','params'=>array(':wil'=>$wil))));
        $notifb = count(TUpload::model()->findAllByAttributes(array('upload_status'=>8),array('with'=>array('uploadOpd'),'condition'=>'uploadOpd.opd_wil=:wil','params'=>array(':wil'=>$wil))));
        //$notifb = count(TUpload::model()->reportb()->getData());
    ?>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <!-- Notifications Dropdown Menu -->
      <?php
        if(Yii::app()->user->getLevel()==1||Yii::app()->user->getLevel()==2){
      ?>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><?php echo $notif+$notifb?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Notifikasi</span>
          <div class="dropdown-divider"></div>
          
          <a href="<?php echo Yii::app()->createUrl('tUpload/reportlist'); ?>" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> <?php echo $notif;?> nama tidak ditemukan
            <span class="float-right text-muted text-sm">SPO</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo Yii::app()->createUrl('tUpload/reportlistb'); ?>" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> <?php echo $notifb;?> belum lengkap
            <span class="float-right text-muted text-sm">SPO</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Semua notifikasi</a>
        </div>
      </li>
      <?php
        }
      ?>
      
      <!--
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo Yii::app()->createUrl('/site/logout'); ?>">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo Yii::app()->createUrl('/lPegawai/dashboard'); ?>" class="brand-link">
      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/img/bps-large.png" alt="BPS" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SPO Prov. Bali</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/img/<?php echo Yii::app()->user->getAvatar(); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo Yii::app()->user->getNama(); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link <?php echo (Yii::app()->controller->id=='lPegawai' && Yii::app()->controller->action->id=='dashboard')||(Yii::app()->controller->id=='lPegawai' && Yii::app()->controller->action->id=='admin')? 'active': ''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo Yii::app()->createUrl('lPegawai/dashboard'); ?>" class="nav-link <?php echo (Yii::app()->controller->id=='lPegawai' && Yii::app()->controller->action->id=='dashboard')? 'active': ''; ?>">
                  <i class="far fa-chart-bar nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo Yii::app()->user->getLevel()==1? Yii::app()->createUrl('lPegawai/admin'):(Yii::app()->user->getLevel()==4? Yii::app()->createUrl('lPegawai/adminopd'): Yii::app()->createUrl('lPegawai/adminwil')); ?>" 
                   class="nav-link <?php echo (Yii::app()->controller->id=='lPegawai' && (Yii::app()->controller->action->id=='admin'||Yii::app()->controller->action->id=='adminwil'||Yii::app()->controller->action->id=='adminopd'))? 'active': ''; ?>">
                  <i class="far fa-building nav-icon"></i>
                  <p>Pegawai Instansi</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          <?php
            if(Yii::app()->user->getLevel()==1 || Yii::app()->user->getLevel()==2){
          ?>
          <li class="nav-header">Admin</li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link <?php echo Yii::app()->controller->id=='tUpload' && (Yii::app()->controller->action->id=='reportlist' 
                    || Yii::app()->controller->action->id=='reportlistb' || Yii::app()->controller->action->id=='reportdetail')? 'active': ''; ?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Penanganan Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo Yii::app()->createUrl('tUpload/reportlist'); ?>" class="nav-link <?php echo (Yii::app()->controller->id=='tUpload' && 
                        (Yii::app()->controller->action->id=='reportlist'))? 'active': ''; ?>">
                  <i class="nav-icon fas fa-clipboard-list"></i>
                  <p>
                    Nama Tidak Ditemukan
                    <span class="badge badge-info right"><?php echo $notif;?></span>
                    <!--<span class="right badge badge-danger">New</span> -->
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo Yii::app()->createUrl('tUpload/reportlistb'); ?>" class="nav-link <?php echo (Yii::app()->controller->id=='tUpload' && 
                        (Yii::app()->controller->action->id=='reportlistb'))? 'active': ''; ?>">
                  <i class="nav-icon fas fa-clipboard"></i>
                  <p>
                    Belum Lengkap
                    <span class="badge badge-info right"><?php echo $notifb;?></span>
                    <!--<span class="right badge badge-danger">New</span> -->
                  </p>
                </a>
              </li>
              
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="<?php echo Yii::app()->createUrl('lPegawai/admintoedit'); ?>"  class="nav-link <?php echo (Yii::app()->controller->id=='lPegawai' && 
                        (Yii::app()->controller->action->id=='admintoedit'))? 'active': ''; ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Kelola Pegawai
                <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo Yii::app()->createUrl('tUpload/upload'); ?>" target="_blank" class="nav-link">
              <i class="nav-icon fas fa-arrow-alt-circle-up"></i>
              <p>
                Upload
                <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <?php
            }
          ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php echo $content; ?>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="https://bali.bps.go.id">BPS Provinsi Bali</a>.</strong>
    
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/demo.js"></script>

</body>
</html>

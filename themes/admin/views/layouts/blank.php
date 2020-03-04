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

        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body class="hold-transition login-page" style="
  min-height: 512.8px;
  background-image: url('<?php echo Yii::app()->theme->baseUrl; ?>/dist/img/ribbon.png');
  background-repeat: no-repeat;
  background-position: bottom;background-size:100%;
  ">

<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo Yii::app()->createUrl('/site/index'); ?>">Monitoring <b>Sensus Penduduk</b> Online</a> di Instansi
  </div>
    <p>
    <h6 style="text-align: center;">
        <i><strong>Hanya untuk ASN/tenaga kontrak di Provinsi Bali</strong></i>
    </h6>
    </p>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
            <?php echo $content; ?>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>


<!-- jQuery -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/adminlte.min.js"></script>

</body>
</html>

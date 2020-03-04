<?php
/* @var $this LPegawaiController */
/* @var $model LPegawai */

$this->breadcrumbs=array(
	'Lpegawais'=>array('index'),
	$model->id_pegawai=>array('view','id'=>$model->id_pegawai),
	'Update',
);

$this->menu=array(
	array('label'=>'List LPegawai', 'url'=>array('index')),
	array('label'=>'Create LPegawai', 'url'=>array('create')),
	array('label'=>'View LPegawai', 'url'=>array('view', 'id'=>$model->id_pegawai)),
	array('label'=>'Manage LPegawai', 'url'=>array('admin')),
);
?>

<h1>Update LPegawai <?php echo $model->id_pegawai; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
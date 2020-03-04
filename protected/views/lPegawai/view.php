<?php
/* @var $this LPegawaiController */
/* @var $model LPegawai */

$this->breadcrumbs=array(
	'Lpegawais'=>array('index'),
	$model->id_pegawai,
);

$this->menu=array(
	array('label'=>'List LPegawai', 'url'=>array('index')),
	array('label'=>'Create LPegawai', 'url'=>array('create')),
	array('label'=>'Update LPegawai', 'url'=>array('update', 'id'=>$model->id_pegawai)),
	array('label'=>'Delete LPegawai', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_pegawai),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LPegawai', 'url'=>array('admin')),
);
?>

<h1>View LPegawai #<?php echo $model->id_pegawai; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_pegawai',
		'pegawai_nik',
		'pegawai_nama',
		'pegawai_opd',
		'is_updated',
		'tgl_updated',
	),
)); ?>

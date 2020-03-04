<?php
/* @var $this LPegawaiController */
/* @var $model LPegawai */

$this->breadcrumbs=array(
	'Lpegawais'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LPegawai', 'url'=>array('index')),
	array('label'=>'Manage LPegawai', 'url'=>array('admin')),
);
?>

<h1>Create LPegawai</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
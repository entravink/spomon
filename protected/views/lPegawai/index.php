<?php
/* @var $this LPegawaiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lpegawais',
);

$this->menu=array(
	array('label'=>'Create LPegawai', 'url'=>array('create')),
	array('label'=>'Manage LPegawai', 'url'=>array('admin')),
);
?>

<h1>Lpegawais</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this TUploadController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tuploads',
);

$this->menu=array(
	array('label'=>'Create TUpload', 'url'=>array('create')),
	array('label'=>'Manage TUpload', 'url'=>array('admin')),
);
?>

<h1>Tuploads</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this TUploadController */
/* @var $model TUpload */

$this->breadcrumbs=array(
	'Tuploads'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TUpload', 'url'=>array('index')),
	array('label'=>'Manage TUpload', 'url'=>array('admin')),
);
?>

<h1>Create TUpload</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this TUploadController */
/* @var $model TUpload */

$this->breadcrumbs=array(
	'Tuploads'=>array('index'),
	$model->id_upload=>array('view','id'=>$model->id_upload),
	'Update',
);

$this->menu=array(
	array('label'=>'List TUpload', 'url'=>array('index')),
	array('label'=>'Create TUpload', 'url'=>array('create')),
	array('label'=>'View TUpload', 'url'=>array('view', 'id'=>$model->id_upload)),
	array('label'=>'Manage TUpload', 'url'=>array('admin')),
);
?>

<h1>Update TUpload <?php echo $model->id_upload; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
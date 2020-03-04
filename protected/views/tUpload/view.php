<?php
/* @var $this TUploadController */
/* @var $model TUpload */

$this->breadcrumbs=array(
	'Tuploads'=>array('index'),
	$model->id_upload,
);

$this->menu=array(
	array('label'=>'List TUpload', 'url'=>array('index')),
	array('label'=>'Create TUpload', 'url'=>array('create')),
	array('label'=>'Update TUpload', 'url'=>array('update', 'id'=>$model->id_upload)),
	array('label'=>'Delete TUpload', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_upload),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TUpload', 'url'=>array('admin')),
);
?>

<h1>View TUpload #<?php echo $model->id_upload; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_upload',
		'upload_md5',
		'upload_file_loc',
		'upload_opd',
		'tgl_upload',
	),
)); ?>

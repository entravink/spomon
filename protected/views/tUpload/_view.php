<?php
/* @var $this TUploadController */
/* @var $data TUpload */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_upload')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_upload), array('view', 'id'=>$data->id_upload)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('upload_md5')); ?>:</b>
	<?php echo CHtml::encode($data->upload_md5); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('upload_file_loc')); ?>:</b>
	<?php echo CHtml::encode($data->upload_file_loc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('upload_opd')); ?>:</b>
	<?php echo CHtml::encode($data->upload_opd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_upload')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_upload); ?>
	<br />


</div>
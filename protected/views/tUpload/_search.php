<?php
/* @var $this TUploadController */
/* @var $model TUpload */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_upload'); ?>
		<?php echo $form->textField($model,'id_upload'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'upload_md5'); ?>
		<?php echo $form->textField($model,'upload_md5',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'upload_file_loc'); ?>
		<?php echo $form->textField($model,'upload_file_loc',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'upload_opd'); ?>
		<?php echo $form->textField($model,'upload_opd'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_upload'); ?>
		<?php echo $form->textField($model,'tgl_upload'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
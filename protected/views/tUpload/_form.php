<?php
/* @var $this TUploadController */
/* @var $model TUpload */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tupload-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'upload_md5'); ?>
		<?php echo $form->textField($model,'upload_md5',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'upload_md5'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'upload_file_loc'); ?>
		<?php echo $form->textField($model,'upload_file_loc',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'upload_file_loc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'upload_opd'); ?>
		<?php echo $form->textField($model,'upload_opd'); ?>
		<?php echo $form->error($model,'upload_opd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tgl_upload'); ?>
		<?php echo $form->textField($model,'tgl_upload'); ?>
		<?php echo $form->error($model,'tgl_upload'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
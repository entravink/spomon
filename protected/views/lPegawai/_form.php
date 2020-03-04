<?php
/* @var $this LPegawaiController */
/* @var $model LPegawai */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lpegawai-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pegawai_nik'); ?>
		<?php echo $form->textField($model,'pegawai_nik',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'pegawai_nik'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pegawai_nama'); ?>
		<?php echo $form->textField($model,'pegawai_nama',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'pegawai_nama'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pegawai_opd'); ?>
		<?php echo $form->textField($model,'pegawai_opd'); ?>
		<?php echo $form->error($model,'pegawai_opd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_updated'); ?>
		<?php echo $form->textField($model,'is_updated'); ?>
		<?php echo $form->error($model,'is_updated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tgl_updated'); ?>
		<?php echo $form->textField($model,'tgl_updated'); ?>
		<?php echo $form->error($model,'tgl_updated'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
/* @var $this LPegawaiController */
/* @var $model LPegawai */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_pegawai'); ?>
		<?php echo $form->textField($model,'id_pegawai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pegawai_nik'); ?>
		<?php echo $form->textField($model,'pegawai_nik',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pegawai_nama'); ?>
		<?php echo $form->textField($model,'pegawai_nama',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pegawai_opd'); ?>
		<?php echo $form->textField($model,'pegawai_opd'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_updated'); ?>
		<?php echo $form->textField($model,'is_updated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_updated'); ?>
		<?php echo $form->textField($model,'tgl_updated'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
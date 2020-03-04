<div class="col-lg-12 col-12">
<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Upload Bukti';
$this->breadcrumbs=array(
	'Contact',
);
?>

<h1>Upload Bukti</h1>

<?php if(Yii::app()->user->hasFlash('upload')): ?>

<div class="alert alert-success alert-dismissible">
	<?php echo Yii::app()->user->getFlash('upload'); ?>
</div>

<?php else: ?>

<p>
Silakan pilih instansi dan upload bukti pengisian Sensus Penduduk Online.
</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
            <?php echo $form->labelEx($model,'file'); ?>
            <div class="input-group">
		
                <div class="custom-file">
                    <?php echo $form->fileField($model,'file',array('size'=>100,'maxlength'=>255,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'file'); ?>
                </div>
            </div>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>

</div>
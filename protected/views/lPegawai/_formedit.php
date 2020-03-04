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

	<div class="alert alert-danger alert-dismissible" <?php echo $model->hasErrors()?'':'style="display:none"';?>>        
            <?php echo $form->errorSummary($model,""); ?>
        </div>


	<div class="row">
		<?php echo $form->labelEx($model,'pegawai_nama'); ?>
		<?php echo $form->textField($model,'pegawai_nama',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'pegawai_nama'); ?>
	</div>

	<div class="row">
                <?php
                        $wilAll=array();
			$wil=array();
			$wilAll= MOpd::model()->findAllByAttributes(array('opd_wil'=>Yii::app()->user->getWilayah()),array('order'=>'opd_nama'));
			
			foreach ($wilAll as $jj=>$j){
				$wil[$wilAll[$jj]['id_opd']]=$wilAll[$jj]['opd_nama'];
			}
                ?>
		<?php echo $form->labelEx($model,'pegawai_opd'); ?>
		<?php echo $form->dropDownList($model,'pegawai_opd',$wil,array('empty'=>'--Pilih Instansi--','class'=>'form-control',)); ?>
		<?php echo $form->error($model,'pegawai_opd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_aktif'); ?>
		<?php 
                    $aktif=array();
                    $aktif[0]="Tidak";
                    $aktif[1]="Ya";
                    echo $form->dropDownList($model,'is_aktif',$aktif,array('class'=>'form-control',));
                    //echo $form->textField($model,'is_aktif',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'is_aktif'); ?>
	</div>

        <br/>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Simpan',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
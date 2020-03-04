<?php
/* @var $this LPegawaiController */
/* @var $model LPegawai */
/* @var $form CActiveForm */
?>
<br/>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-filter mr-1"></i>
                    Filter
                </h3>
            </div>
            <div class="card-body">
                <p>
                Anda bisa menggunakan operator perbandingan seperti <b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
                atau <b>=</b>.
                </p>
                <div class="wide form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'action'=>Yii::app()->createUrl($this->route),
                        'method'=>'get',
                )); ?>




                        <div class="row">
                                <?php echo $form->label($model,'pegawai_nama'); ?>
                                <?php echo $form->textField($model,'pegawai_nama',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
                        </div>

                        <div class="row">
                                <?php echo $form->label($model,'is_updated'); ?>
                                <?php
                                    $flag=array();
                                    $flag[0]='Belum';
                                    $flag[1]='Sudah';
                                ?>
                                <?php //echo $form->textField($model,'is_updated',array('class'=>'form-control')); 
                                    echo $form->dropDownList($model,'is_updated',$flag,array('empty'=>'--Pilih Status--','class'=>'form-control',));
                                ?>
                        </div>

                        <div class="row">
                                <?php echo $form->label($model,'tgl_updated'); ?>
                                <?php echo $form->textField($model,'tgl_updated',array('class'=>'form-control')); ?>
                        </div>

                        

                

                </div><!-- search-form -->
            </div>
            <div class="card-footer">
                <div class="row buttons">
                                <?php echo CHtml::submitButton('Filter',array('class'=>'btn btn-info')); ?>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
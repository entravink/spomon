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
                
                <div class="wide form">

                <?php $form=$this->beginWidget('CActiveForm', array(
                        'action'=>Yii::app()->createUrl($this->route),
                        'method'=>'get',
                )); ?>




                        
                        <div class="row">                   
                                <?php
                                        $kategoriAll=array();
                                        $kategori=array();
                                        //$kategoriAll= MOpd::model()->findAllByAttributes(array('is_aktif'=>1),array('order'=>'opd_nama'));
                                        $kategoriAll= TUpload::model()->findAllByAttributes(array('upload_status'=>8),array('with'=>array('uploadOpd'),'condition'=>'uploadOpd.opd_wil=:wil','params'=>array(':wil'=>Yii::app()->user->getWilayah())));

                                        foreach ($kategoriAll as $jj=>$j){
                                                $kategori[$kategoriAll[$jj]['uploadOpd']['id_opd']]=$kategoriAll[$jj]['uploadOpd']['opd_nama'];
                                        }
                                ?>
                                <?php echo $form->labelEx($model,'upload_opd'); ?>
                                <?php
                                      echo $form->dropDownList($model,'upload_opd',$kategori,array('empty'=>'--Pilih Instansi--','class'=>'form-control',));
                                ?>
                        </div>
                    <div class="row">
                         
                                <?php echo $form->label($model,'upload_ket'); ?>
                                <?php echo $form->textField($model,'upload_ket',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
                        
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
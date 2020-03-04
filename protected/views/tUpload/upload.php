<div class="col-lg-12 col-12">
<?php
	Yii::app()->clientscript
		// use it when you need it!
		
		->registerCoreScript( 'jquery' )
		
?>
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
	<?php 
            $success=explode("|",Yii::app()->user->getFlash('upload')); 
            echo $success[0];
        ?>
</div>

<div class="row">
    <div class="col-md-12">
    <?php
        $pieChartData=array();
        $pieChartData[0]=array("Sudah",(int)$success[1]);
        $pieChartData[1]=array("Belum",(int)$success[2]);
        $this->Widget('ext.highcharts.HighchartsWidget', array(
            'options'=>array(
               'chart'=> array(
                                 'type'=>'pie'
                         ),
               'title' => array('text' => 'Persentase SP Online di Instansi Anda'),
                 'tooltip'=>array(
                         'formatter'=>'js:function() { return "<b>"+ this.point.name +"</b>: "+this.y+" orang ("+ Highcharts.numberFormat(this.percentage,2) +" %)"; }'
                              ),

                 'plotOptions'=>array(
                                 'pie'=>array(
                                         'allowPointSelect'=> true,
                                         'cursor'=>'pointer',
                                     'showInLegend'=>true,
                                         'dataLabels'=>array(
                                                 'enabled'=> false,
                                                 'color'=>'#000000',
                                                 'connectorColor'=>'#000000',
                                                 'formatter'=>'js:function() { return "<b>"+ this.point.name +"</b>:"+this.percentage +" %"; }'  

                                                            )
                                             )
                                  ),

                'credits' => array('enabled' => false),
               'series' => array(
                  array('type'=>'pie','name' => 'Persentase', 'data' => $pieChartData),

               )

            )
         ));
    ?>
    </div>
</div>

<?php elseif(Yii::app()->user->hasFlash('gagal1')): ?>

<div class="alert alert-warning alert-dismissible">
	<?php
            $val=explode("|",Yii::app()->user->getFlash('gagal1')); 
            echo $val[0];
        ?>
</div>
<div class="row">
        <div class="col-md-12">
            <p>
                Silakan tambahkan keterangan nama-nama pegawai di KK ini dan laporkan kesalahan ini melalui link/tombol berikut:
            </p>
            <div class="form">
                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'tUpload-form',
                        'action'=>Yii::app()->createUrl('tUpload/report',array('i'=>$val[1],'m'=>$val[2])),
                )); ?>
                    <?php echo $form->labelEx($model,'upload_ket'); ?>
                    <?php
                          echo $form->textArea($model,'upload_ket',array('class'=>'form-control',));
                    ?>
                <br/>
                <div class="row buttons">
                    <?php echo CHtml::submitButton('Laporkan Kesalahan',array('class'=>'btn btn-primary')); ?>
                </div>

                <?php $this->endWidget(); ?>
            </div>
                
        </div>
        
        <div class="col-md-12">
            <?php
                //echo CHtml::link('<i class="fa fa-paper-plane"></i>  Laporkan Kesalahan',array("tUpload/report&i=$val[1]&m=$val[2]"),array('class'=>'btn btn-primary','title'=>'Laporkan Kesalahan'));
            ?>
        </div>
</div>

<?php elseif(Yii::app()->user->hasFlash('gagal1b')): ?>

<div class="alert alert-warning alert-dismissible">
	<?php
            $val=explode("|",Yii::app()->user->getFlash('gagal1b')); 
            echo $val[0];
        ?>
</div>
<div class="row">
        <div class="col-md-12">
            <p>
                Silakan tambahkan keterangan nama-nama pegawai di KK ini dan laporkan kesalahan ini melalui link/tombol berikut:
            </p>
            <div class="form">
                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'tUpload-form',
                        'action'=>Yii::app()->createUrl('tUpload/reportb',array('i'=>$val[1],'m'=>$val[2])),
                )); ?>
                    <?php echo $form->labelEx($model,'upload_ket'); ?>
                    <?php
                          echo $form->textArea($model,'upload_ket',array('class'=>'form-control',));
                    ?>
                <br/>
                <div class="row buttons">
                    <?php echo CHtml::submitButton('Laporkan Kesalahan',array('class'=>'btn btn-primary')); ?>
                </div>

                <?php $this->endWidget(); ?>
            </div>
                
        </div>
        
        <div class="col-md-12">
            <?php
                //echo CHtml::link('<i class="fa fa-paper-plane"></i>  Laporkan Kesalahan',array("tUpload/reportb&i=$val[1]&m=$val[2]"),array('class'=>'btn btn-primary','title'=>'Laporkan Kesalahan'));
            ?>
        </div>
</div>

<?php elseif(Yii::app()->user->hasFlash('gagal2')): ?>

<div class="alert alert-warning alert-dismissible">
	<?php echo Yii::app()->user->getFlash('gagal2'); ?>
</div>

<?php elseif(Yii::app()->user->hasFlash('lapor')): ?>

<div class="alert alert-info alert-dismissible">
	<?php echo Yii::app()->user->getFlash('lapor'); ?>
</div>

<?php else: ?>

<p>
Silakan pilih instansi dan upload bukti pengisian Sensus Penduduk Online.
</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tUpload-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
    

    <div class="alert alert-danger alert-dismissible" <?php echo $model->hasErrors()?'':'style="display:none"';?>>        
            <?php echo $form->errorSummary($model,""); ?>
    </div>
    
        <div class="row">
                    
                <?php
                        $wilAll=array();
			$wil=array();
			$wilAll= MWil::model()->findAll();
                        //$wilAll= MWil::model()->findAll(array('condition'=>'id_wil=5104 OR id_wil=5107 OR id_wil=5101 OR id_wil=5102 OR id_wil=5105 OR id_wil=5103 OR id_wil=5171'));
			
			foreach ($wilAll as $jj=>$j){
				$wil[$wilAll[$jj]['id_wil']]=$wilAll[$jj]['wil_nama'];
			}
                ?>
		<?php echo $form->labelEx($model,'id_wil'); ?>
		<?php
                      echo $form->dropDownList($model,'id_wil',$wil,array('empty'=>'--Pilih Wilayah--','class'=>'form-control',));
                ?>
                <?php echo $form->error($model,'id_wil'); ?>
                    
        </div>
    
        <div class="row">
                    
                <?php
                        $kategoriAll=array();
			$kategori=array();
			$kategoriAll= MOpd::model()->findAllByAttributes(array('is_aktif'=>1),array('order'=>'opd_nama'));
			
			foreach ($kategoriAll as $jj=>$j){
				$kategori[$kategoriAll[$jj]['id_opd']]=$kategoriAll[$jj]['opd_nama'];
			}
                ?>
		<?php echo $form->labelEx($model,'upload_opd'); ?>
		<?php
                      //echo $form->dropDownList($model,'upload_opd',$kategori,array('empty'=>'--Pilih Instansi--','class'=>'form-control',));
                      echo $form->dropDownList($model,'upload_opd',array(),array('empty'=>'--Pilih Instansi--','class'=>'form-control',));
                ?>
                <?php echo $form->error($model,'upload_opd'); ?>
                    
        </div>
    
    
        <div class="row">
            <div class="form-group">
                <?php echo $form->labelEx($model,'upload_file_loc'); ?>
                <div class="input-group">

                    <div class="custom-file">
                        <?php echo $form->fileField($model,'upload_file_loc',array('size'=>100,'maxlength'=>255,'class'=>'form-control')); ?>
                        
                    </div>
                    
                </div>
                <?php echo $form->error($model,'upload_file_loc'); ?>
            </div>
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>

</div>

<script>

      $(document).ready(function(){
          var wil="";
			$("#TUpload_id_wil").change(function(){
				wil = $("#TUpload_id_wil").val();
				$.ajax({
					url: "<?php echo Yii::app()->createUrl('tUpload/setopd')?>",
					data: 'TUpload_id_wil='+wil,
					success: function(data){
						$("#TUpload_upload_opd").html(data);
				}
                                });
                        });

                        
	});
</script>
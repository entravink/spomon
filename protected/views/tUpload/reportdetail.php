<?php
/* @var $this TUploadController */
/* @var $model TUpload */



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#lpegawai-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Laporan Pengguna dari <?php echo $uploadfile->uploadOpd->opd_nama?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan Kesalahan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-12">
                    <?php if(Yii::app()->user->hasFlash('success')): ?>
                        <div class="alert alert-success">
                            <?php echo Yii::app()->user->getFlash('success'); 
                            Yii::app()->clientScript->registerScript(
                                    'myHideEffect',
                                    '$(".alert-success").animate({opacity: 1.0}, 5000).fadeOut("slow");',
                                    CClientScript::POS_READY
                    );
                            ?>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card card card-light">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-image mr-1"></i>
                                    Bukti Pengisian SP Online
                                </h3>
                                <div class="card-tools">
                                    <?php echo  "Keterangan: ".$uploadfile->upload_ket; ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <img class="img-fluid pad" src="<?php echo Yii::app()->request->baseUrl. "/bukti/".$uploadfile->upload_file_loc; ?> "
                                     alt="Bukti Pengisian">
                            </div>
                      
                  </div>
                </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="card card card-lightblue">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-table mr-1"></i>
                                    Tabel Pegawai
                                </h3>
                                <div class="card-tools">
                                    <div class="search-form form">
                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                            'action'=>Yii::app()->createUrl($this->route."&i=$uploadfile->id_upload&m=$uploadfile->upload_md5"),
                                            'method'=>'get',
                                    )); ?>
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                      
                                        <?php echo $form->textField($model,'pegawai_nama',array('size'=>60,'maxlength'=>100,'class'=>'form-control','placeholder'=>'Pencarian')); ?>

                                        <div class="input-group-append">
                                           <?php //echo CHtml::submitButton('<i class="fas fa-search"></i> A',array('class'=>'btn btn-default')); ?>
                                            <button type="submit" class="btn btn-default" name="yt0"><i class="fas fa-search"></i></button>
                                        </div>
                                    
                                        
                                    </div>
                                    <?php $this->endWidget(); ?>
                                    </div>
                                  </div>
                            </div>
                            <div class="card-body">
                                
                                <?php $this->widget('zii.widgets.grid.CGridView', array(
                                        'id'=>'lpegawai-grid',
                                        'itemsCssClass'=>'table table-bordered table-hover',
                                        //'dataProvider'=>$model->searchbyopd($uploadfile->upload_opd),
                                        'dataProvider'=>$model->searchbyopd($uploadfile->upload_opd,0),
                                        //'filter'=>$model,
                                        //'filterCssClass'=>'form-control',
                                        'columns'=>array(
                                                
                                                'pegawai_nama',
                                                //'pegawaiOpd.opd_nama',
                                                //'is_updated',
                                                //'tgl_updated',
                                                array(
                                                    'class'=>'CButtonColumn',
                                                    'template'=>'{acc}',
                                                    'buttons'=>array(
                                                        'acc'=>
                                                            array(
                                                            'url'=>'Yii::app()->createUrl("tUpload/acc", array("i"=>"'.$uploadfile->id_upload.'","m"=>"'.$uploadfile->upload_md5.'","e"=>$data->id_pegawai))',
                                                            'label' => '<i class="fas fa-check-circle"></i>',
                                                            'options'=>array(  
                                                                    'class'=>'action',
                                                                    'title'=>'Confim',
                                                                    'confirm'=>'Apakah pegawai yang dipilih sudah benar?'
                                                                    ),

                                                         ),

                                                        )
                                            ),
                                        ),
                                )); ?>
                            </div>
                            
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-8">
                                        <p>
                                            Jika tidak menemukan nama pegawai bersangkutan, maka tolak laporan melalui tombol berikut:
                                        </p>
                                    </div>
                                    <div class="col-4" >
                                        <div class="card-tools" style="float: right;">
                                            <?php
                                                echo CHtml::link('<i class="fas fa-times-circle"></i> Tolak',array("tUpload/rej&i=$uploadfile->id_upload&m=$uploadfile->upload_md5"),
                                                        array('class'=>'btn btn-danger','title'=>'Tolak Laporan','confirm'=>'Apakah yakin ditolak?'));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      
                  </div>
                </div>
                
                
            
            </div>
                
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card card-outline card-orange">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-image mr-1"></i>
                                    Pindahkan Bukti ke Instansi Lain
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="form">

                                    <?php $form2=$this->beginWidget('CActiveForm', array(
                                            'id'=>'tupload-form',
                                            //'action'=>Yii::app()->createUrl($this->route."&i=$uploadfile->id_upload&m=$uploadfile->upload_md5"),
                                            'action'=>Yii::app()->createUrl('tUpload/switch',array('i'=>$uploadfile->id_upload)),
                                            // Please note: When you enable ajax validation, make sure the corresponding
                                            // controller action is handling ajax validation correctly.
                                            // There is a call to performAjaxValidation() commented in generated controller code.
                                            // See class documentation of CActiveForm for details on this.
                                            'enableAjaxValidation'=>false,
                                    )); ?>
                                            <div class="row">
                                                    <?php
                                                            $wilAll=array();
                                                            $wil=array();
                                                            $wilAll= MOpd::model()->findAllByAttributes(array('opd_wil'=>Yii::app()->user->getWilayah()),array('order'=>'opd_nama'));

                                                            foreach ($wilAll as $jj=>$j){
                                                                    $wil[$wilAll[$jj]['id_opd']]=$wilAll[$jj]['opd_nama'];
                                                            }
                                                    ?>
                                                    <?php echo $form2->labelEx($uploadfile,'upload_opd'); ?>
                                                    <?php echo $form2->dropDownList($uploadfile,'upload_opd',$wil,array('class'=>'form-control',)); ?>
                                                    <?php echo $form2->error($uploadfile,'upload_opd'); ?>
                                            </div>


                                            <br/>
                                            <div class="row buttons">
                                                    <?php echo CHtml::submitButton($uploadfile->isNewRecord ? 'Create' : 'Pindahkan',array('class'=>'btn btn-primary')); ?>
                                            </div>

                                    <?php $this->endWidget(); ?>

                                </div><!-- form -->
                            </div>
                      
                        </div>
                    </div>
        </div>
                
                
                
            
    </section>




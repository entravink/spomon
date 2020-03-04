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
            <h1 class="m-0 text-dark">Copy Bukti untuk <?php echo $model->pegawai_nama ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Copy Bukti Pegawai</li>
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
                    <div class="col-lg-6 col-md-6">
                        <div class="card card card-lightblue">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-table mr-1"></i>
                                    Copy Bukti dari Pegawai Berikut
                                </h3>
                                <div class="card-tools">
                                    <div class="search-form form">
                                    <?php $form=$this->beginWidget('CActiveForm', array(
                                            'action'=>Yii::app()->createUrl($this->route."&i=".$model->id_pegawai*21156),
                                            'method'=>'get',
                                    )); ?>
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                      
                                        <?php echo $form->textField($modelList,'pegawai_nama',array('size'=>60,'maxlength'=>100,'class'=>'form-control','placeholder'=>'Pencarian')); ?>

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
                                        'dataProvider'=>$modelList->searchbyopd($model->pegawai_opd,1),
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
                                                            'url'=>'Yii::app()->createUrl("lPegawai/paste", array("i"=>"'.($model->id_pegawai*1234).'","f"=>$data->id_pegawai*1234))',
                                                            'label' => '<i class="fas fa-copy"></i>',
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
                                    
                                    <div class="col-12" >
                                        <div class="card-tools" style="float: right;">
                                            <?php
                                                echo CHtml::link('<i class="fas fa-arrow-left"></i> Kembali',array("lPegawai/admintoedit"),
                                                        array('class'=>'btn btn-info','title'=>'Kembali'));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      
                  </div>
                </div>
                
                
            
            </div>
        </div>
    </section>




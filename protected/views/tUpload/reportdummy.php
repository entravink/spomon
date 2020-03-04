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
            <h1 class="m-0 text-dark">Laporan Pengguna</h1>
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
                    <div class="col-lg-6 col-md-6">
                        <div class="card card card-light">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-image mr-1"></i>
                                    Bukti Pengisian SP Online
                                </h3>
                            </div>
                            <div class="card-body">
                                <img class="img-fluid pad" src="<?php echo Yii::app()->request->baseUrl. "/bukti/bpsbali/".$nama.".jpg" ?> "
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
                                            'action'=>Yii::app()->createUrl($this->route),
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
                                        'dataProvider'=>$model->search(),
                                        //'filter'=>$model,
                                        //'filterCssClass'=>'form-control',
                                        'columns'=>array(
                                                
                                                'pegawai_nama',
                                                //'pegawaiOpd.opd_nama',
                                                //'is_updated',
                                                //'tgl_updated',
                                                //array(
                                                //        'class'=>'CButtonColumn',
                                                //),
                                        ),
                                )); ?>
                            </div>
                      
                  </div>
                </div>
                
                
            
            </div>
        </div>
    </section>




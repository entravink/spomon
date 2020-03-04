<?php
/* @var $this LPegawaiController */
/* @var $model LPegawai */
/*
$this->breadcrumbs=array(
	'Lpegawais'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List LPegawai', 'url'=>array('index')),
	array('label'=>'Create LPegawai', 'url'=>array('create')),
);
 * 
 */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tupload-grid').yiiGridView('update', {
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
            <h1 class="m-0 text-dark">Daftar Laporan Kesalahan Nama Tidak Ditemukan</h1>
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
                    <div class="col-lg-6">
                      <?php echo CHtml::link('<i class="fas fa-filter"></i>   Opsi Filter','#',array('class'=>'search-button btn btn-outline-info')); ?>
                        <br/>
                        <div class="search-form" style="display:none">
                        <?php $this->renderPartial('_filteropd',array(
                                'model'=>$model,
                        )); ?>
                        </div>

                      
                  </div> 
                </div> 
                
                <br/>
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
                    <div class="col-lg-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-table mr-1"></i>
                                    Daftar
                                </h3>

                            </div>
                            <div class="card-body">
                                <?php $this->widget('zii.widgets.grid.CGridView', array(
                                        'id'=>'tupload-grid',
                                        'itemsCssClass'=>'table table-bordered table-hover',
                                        'dataProvider'=>$model->report(),
                                        //'filter'=>$model,
                                        //'filterCssClass'=>'form-control',
                                        'columns'=>array(
                                            array(
                                                'header'=>'No.',
                                                'value'=>'$row +1 + ($this->grid->dataProvider->pagination->currentPage
                                                * $this->grid->dataProvider->pagination->pageSize)',
                                            ),
                                            array(
                                                'header'=>'Tiket',
                                                'value'=>'$data->upload_md5',
                                            ),
                                                'uploadOpd.opd_nama',
                                                //'upload_ket',
                                                'tgl_upload',
                                            array(
                                                'header'=>'Keterangan',
                                                'value'=>'$data->upload_ket',
                                            ),

                                                array(
                                                    'class'=>'CButtonColumn',
                                                    'template'=>'{lihat}',
                                                    'buttons'=>array(
                                                        'lihat'=>
                                                            array(
                                                            'url'=>'Yii::app()->createUrl("tUpload/reportdetail", array("i"=>$data->id_upload,"m"=>$data->upload_md5))',
                                                            'label' => '<i class="fas fa-eye"></i>',
                                                            'options'=>array(  
                                                                    'class'=>'action',
                                                                    'title'=>'Lihat',
                                                                    //'confirm'=>'Apakah yakin?'
                                                                    ),

                                                         ),

                                                        )
                                            ),
                                        ),
                                )); ?>
                                
                                
                                
                            </div>
                      
                  </div>
                </div>
                
                
            
            </div>
        </div>
    </section>



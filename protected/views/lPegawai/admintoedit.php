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
            <h1 class="m-0 text-dark">Daftar Pegawai</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Kelola Pegawai</li>
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
                        <?php $this->renderPartial('_filterwil',array(
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
                                    Tabel Pegawai
                                </h3>

                            </div>
                            <div class="card-body">
                                <?php $this->widget('zii.widgets.grid.CGridView', array(
                                        'id'=>'lpegawai-grid',
                                        'itemsCssClass'=>'table table-bordered table-hover',
                                        'dataProvider'=>$model->searchbyadminwil(),
                                        //'filter'=>$model,
                                        //'filterCssClass'=>'form-control',
                                        'columns'=>array(
                                                //'id_pegawai',
                                                //'pegawai_nik',
                                                'pegawai_nama',
                                                'pegawaiOpd.opd_nama',
                                                'is_updated',
                                                'tgl_updated',
                                                'is_aktif',
                                                array(
                                                    'class'=>'CButtonColumn',
                                                    'header'=>'Tindakan',
                                                    'template'=>'{edit}{upload}{copy}',
                                                    'buttons'=>array(
                                                        'edit'=>
                                                            array(
                                                            'url'=>'Yii::app()->createUrl("lPegawai/edit", array("i"=>$data->id_pegawai*12345))',
                                                            'label' => '<i class="fas fa-pen"></i> ',
                                                            'options'=>array(  
                                                                    'class'=>'action',
                                                                    'title'=>'Edit Pegawai',
                                                                    //'confirm'=>'Apakah yakin?'
                                                                    ),

                                                         ),
                                                        'upload'=>
                                                            array(
                                                            'url'=>'Yii::app()->createUrl("tUpload/forceup", array("i"=>$data->id_pegawai*34562))',
                                                            'label' => '<i class="fas fa-file-upload"></i> ',
                                                            'visible' => '$data->is_updated==0?true:false',
                                                            'options'=>array(  
                                                                    'class'=>'action',
                                                                    'title'=>'Force Upload',
                                                                    //'confirm'=>'Apakah yakin?'
                                                                    ),

                                                         ),
                                                        
                                                        'copy'=>
                                                            array(
                                                            'url'=>'Yii::app()->createUrl("lPegawai/copy", array("i"=>$data->id_pegawai*21156))',
                                                            'label' => '<i class="fas fa-copy"></i> ',
                                                            'visible' => '$data->is_updated==0?true:false',
                                                            'options'=>array(  
                                                                    'class'=>'action',
                                                                    'title'=>'Copy Dari Pegawai Lain',
                                                                    //'confirm'=>'Apakah yakin?'
                                                                    ),

                                                         ),

                                                    )
                                                ),
                                        ),
                                )); ?>
                            </div>
                            <div class="card-footer">
                               
                                    <?php echo CHtml::link('<i class="fas fa-file-excel"></i>   Export ke Excel',array('lPegawai/export'),array('class'=>'btn btn-outline-success')); ?>
                            
                            </div>
                      
                  </div>
                </div>
                
                
            
            </div>
                
        </div>
    </section>



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
              <li class="breadcrumb-item active">Pegawai Instansi</li>
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
                                        'dataProvider'=>$model->searchbywil(),
                                        //'filter'=>$model,
                                        //'filterCssClass'=>'form-control',
                                        'columns'=>array(
                                                //'id_pegawai',
                                                //'pegawai_nik',
                                                'pegawai_nama',
                                                'pegawaiOpd.opd_nama',
                                                'is_updated',
                                                'tgl_updated',
                                                //array(
                                                //        'class'=>'CButtonColumn',
                                                //),
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



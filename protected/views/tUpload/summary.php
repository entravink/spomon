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
            <h1 class="m-0 text-dark">Summary</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Summary</li>
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
                    <div class="col-lg-12">
                        <div class="card card-olive">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-table mr-1"></i>
                                    Summary LaporSP
                                </h3>

                            </div>
                            <div class="card-body">
                                <?php
                                $this->widget('zii.widgets.grid.CGridView', array(
                                'id'=>'opd-grid',
                                'itemsCssClass'=>'table table-bordered table-hover',
                                'dataProvider'=>$model,
                                'columns'=>array(
                                        array(
                                                'header'=>'No.',
                                                'value'=>'$row +1 + ($this->grid->dataProvider->pagination->currentPage
                                                * $this->grid->dataProvider->pagination->pageSize)',
                                            ),
                                    array(
                                                'header'=>'Instansi',
                                                'value'=>'$data["opd_nama"]',
                                            ),
                                    array(
                                                'header'=>'Sudah Lapor',
                                                'value'=>'$data["sudah"]',
                                            ),
                                    array(
                                                'header'=>'Belum Lapor',
                                                'value'=>'$data["belum"]',
                                            ),
                                    array(
                                                'header'=>'Total Pegawai',
                                                'value'=>'$data["total_peg"]',
                                            ),
                                    array(
                                                'header'=>'Persentase Sudah(%)',
                                                'value'=>'$data["percentage"]',
                                            ),
                                    array(
                                                'header'=>'Laporan Ditolak',
                                                'value'=>'$data["jumlah_tolak"]',
                                            ),
                                    //'percentage',

                                ),
                        )); 
                        ?>
                                
                                
                                
                            </div>
                            <div class="card-footer">
                               
                                    <?php echo CHtml::link('<i class="fas fa-file-excel"></i>   Export ke Excel',array('tUpload/exportsum'),array('class'=>'btn btn-outline-success')); ?>
                            
                            </div>
                      
                  </div>
                </div>
                
                
            
            </div>
        </div>
    </section>



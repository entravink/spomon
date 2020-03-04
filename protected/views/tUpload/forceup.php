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

?>
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Upload Bukti</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Kelola Pegawai</li>
              <li class="breadcrumb-item active">Upload Bukti</li>
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
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-table mr-1"></i>
                                    Upload Bukti: <?php echo $modelPegawai->pegawai_nama;?>
                                </h3>

                            </div>
                            <div class="card-body">
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
                            </div>
                      
                  </div>
                </div>
                
                
            
            </div>
                
        </div>
    </section>



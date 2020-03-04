<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
                    <div class="col-lg-12 col-12">
                      <h1>Selamat datang di <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

                      <p>Ini merupakan aplikasi untuk memantau perkembangan Sensus Penduduk Online di Instansi.</p>
                      <p>Setiap pegawai harus mengunggah bukti pengisian SP Online (berupa file .pdf) pada sistem.</p>

                      
                  </div>
                </div>
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                      <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Grafik</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Tabel</a>
                        </li>
                        
                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-outline card-primary">


                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <i class="fas fa-chart-bar mr-1"></i>
                                                    Progress Instansi
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <?php
                                                    $this->Widget('ext.highcharts.HighchartsWidget', array(
                                                            //'scripts' => array(
                                                            //'modules/drilldown', // in fact, this is mandatory :)
                                                            //),
                                                        'options'=>array(
                                                            'chart' => array('type' => 'column'),
                                                            'title' => array('text' => Yii::t('app','Progress SP Online Instansi')),
                                                            //'subtitle' => array('text' => Yii::t('app','Klik untuk melihat detail.')),
                                                            'xAxis' => array('type' => 'category'),
                                                            'yAxis' => array('title' => array('text' => Yii::t('app','Persentase')),'min'=>0,
                                                                          'max'=>100,
                                                                          'tickInterval'=>10,),
                                                            'legend' => array('enabled' => false),

                                                            'plotOptions' => array (
                                                                'series' => array (
                                                                                'borderWidth' => 0,
                                                                                'dataLabels' => array(
                                                                                    'enabled' => false,
                                                                                ),
                                                                            ),
                                                                        ),
                                                            'series' => array (array(
                                                                            'name' => 'Persentase',
                                                                            'colorByPoint' => true,
                                                                            'data' => $dataku,
                                                                        )),
                                                            //'drilldown' => array(
                                                            //                'series' => $level2a,
                                                            //            ),
                                                            'credits' => array('enabled' => false),

                                                            'tooltip' => array(
                                                                                        'headerFormat'=> '<span style="font-size:11px">{series.name}</span><br>',
                                                                'pointFormat'=> '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b><br/>'),
                                                        ),
                                                    ));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="card card card-green">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <i class="fas fa-chart-pie mr-1"></i>
                                                    <?php
                                                        if(Yii::app()->user->getLevel()==4){
                                                            echo "Persentase Seluruh Pegawai ". Yii::app()->user->getUser()->userOpd->opd_nama;
                                                        }else{
                                                            echo "Persentase Seluruh Pegawai";
                                                        }
                                                    ?>
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <?php
                                                    $this->Widget('ext.highcharts.HighchartsWidget', array(
                                                        'options'=>array(
                                                           'chart'=> array(
                                                                             'type'=>'pie'
                                                                     ),
                                                           'title' => array('text' => 'Persentase Pegawai melakukan SP Online'),
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
                                                              array('type'=>'pie','name' => 'Persentase', 'data' => $dataPie),

                                                           )

                                                        )
                                                     ));
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="card card-maroon">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <i class="fas fa-chart-line mr-1"></i>
                                                    <?php
                                                        if(Yii::app()->user->getLevel()==4){
                                                            echo "Progress Kumulatif Mingguan di ". Yii::app()->user->getUser()->userOpd->opd_nama;
                                                        }else{
                                                            echo "Progress Kumulatif Mingguan";
                                                        }
                                                    ?>

                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <?php
                                                    $this->Widget('ext.highcharts.HighchartsWidget', array(
                                                        'options' => array(
                                                           'title' => array('text' => 'Perkembangan Mingguan Pengisian SPOnline di Instansi'),
                                                           'xAxis' => array(
                                                              'categories' => array('Minggu 1', 'Minggu 2', 'Minggu 3','Minggu 4 ', 'Minggu 5','Minggu 6', 'Minggu 7')
                                                           ),
                                                           'yAxis' => array(
                                                              'title' => array('text' => 'Jumlah pegawai mengisi SP Online')
                                                           ),
                                                           'credits' => array('enabled' => false),
                                                           'series' => array(
                                                              array('name' => 'Progress', 'data' => $dataLine),
                                                              //array('name' => 'John', 'data' => array(5, 7, 3))
                                                           )
                                                        )
                                                     ));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                        
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                           
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
                                                'header'=>'Persentase (%)',
                                                'value'=>'$data["percentage"]',
                                            ),
                                    //'percentage',

                                ),
                        )); 
                        ?>
                        
                        
                        </div>

                      </div>
                    </div>
                    <!-- /.card -->
                  </div>
                
      </div><!-- /.container-fluid --></div>
    </section>
    <!-- /.content -->


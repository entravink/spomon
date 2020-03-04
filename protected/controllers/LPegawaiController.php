<?php
require Yii::app()->basePath.'/vendor/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LPegawaiController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index2','view2'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create2','update2','dashboard','adminopd','export'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'expression'=>'$user->getLevel()==1',
			),
                        array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('adminwil','delete'),
				'expression'=>'$user->getLevel()==1||$user->getLevel()==2||$user->getLevel()==3',
			),
                        array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('edit','admintoedit','copy','paste'),
				'expression'=>'$user->getLevel()==1||$user->getLevel()==2',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        public function  actionDashboard2(){
            $this->redirect(array('tUpload/um'));
        }
        
        


        public function  actionDashboard(){
            $user=Yii::app()->user->getWilayah();
            $opd=Yii::app()->user->getUser()->user_opd;
            $model = LPegawai::model()->getPercentagebyWil($user);
                
                //untuk bar chart
                $barChartData=array();
                foreach ($model->getData() as $key => $val) {
                    if($val['percentage']>=0&&$val['percentage']<50){
                        $warna='red';
                    }else if($val['percentage']>=50&&$val['percentage']<100){
                        $warna='orange';
                    }else if($val['percentage']==100){
                        $warna='green';
                    }
                    $barChartData[]=array('name'=>$val["opd_nama"],'y' => (double) $val["percentage"],'color' =>$warna);
                    
                }
                
                //untuk pie chart
                //$sudah= count(LPegawai::model()->findAllByAttributes(array('is_updated'=>1))); // masih keseluruhan, ganti dengan per wilayah
                //$belum= count(LPegawai::model()->findAllByAttributes(array('is_updated'=>0)));
                //$model = IsiData::model()->findAllByAttributes(array('id_indikator'=>$idt),array('with'=>array('idItemBaris'),'order'=>'idItemBaris.kode,id_tahun,id_turunan_tahun,id_karakteristik'));
                
                if(Yii::app()->user->getLevel()==4){
                    $sudah= count(LPegawai::model()->findAllByAttributes(array('is_updated'=>1,'pegawai_opd'=>$opd,'is_aktif'=>1)));
                    $belum= count(LPegawai::model()->findAllByAttributes(array('is_updated'=>0,'pegawai_opd'=>$opd,'is_aktif'=>1)));
                
                }else{
                    $sudah= count(LPegawai::model()->findAllByAttributes(array('is_updated'=>1,'is_aktif'=>1),array('with'=>array('pegawaiOpd'),'condition'=>'pegawaiOpd.opd_wil=:wil','params'=>array(':wil'=>$user))));
                    $belum= count(LPegawai::model()->findAllByAttributes(array('is_updated'=>0,'is_aktif'=>1),array('with'=>array('pegawaiOpd'),'condition'=>'pegawaiOpd.opd_wil=:wil','params'=>array(':wil'=>$user))));
                
                }
                                
                $pieChartData=array();
                $pieChartData[0]=array("Sudah",$sudah);
                $pieChartData[1]=array("Belum",$belum);
                
                //untuk line chart
                
                $lineChartData=array();
                $week = array('2020-02-21','2020-02-28','2020-03-06','2020-03-13','2020-03-20','2020-03-27','2020-03-31');
                if(Yii::app()->user->getLevel()==4){
                    foreach ($week as $key =>$val){
                        $pegawai= LPegawai::model()->findAll(array('with'=>array('pegawaiOpd'),
                            'condition'=>'is_updated=:status AND tgl_updated <= :date AND pegawaiOpd.opd_wil=:wil AND pegawai_opd=:opd AND t.is_aktif=1',
                            'params'=>array(':status'=>1, ':date'=>$val,':wil'=>$user, 'opd'=>$opd),
                        ));
                        $lineChartData[]= count($pegawai);
                    }
                }else{
                    foreach ($week as $key =>$val){
                        $pegawai= LPegawai::model()->findAll(array('with'=>array('pegawaiOpd'),
                            'condition'=>'is_updated=:status AND tgl_updated <= :date AND pegawaiOpd.opd_wil=:wil AND t.is_aktif=1',
                            'params'=>array(':status'=>1, ':date'=>$val,':wil'=>$user),
                        ));
                        $lineChartData[]= count($pegawai);
                    }
                }
                
                
                
		$this->render('dashboard',array('dataku'=>$barChartData,'dataPie'=>$pieChartData,'dataLine'=>$lineChartData,'model'=>$model));
	
        }
        public function actionExport2(){
            $model = new LPegawai();
            $this->widget('ext.EExcelView', array(
                'grid_mode'=>'export',
                'title' => 'Daftar Pegawai',
                'dataProvider' => $model->searchbywil(),
                'filename'=>'Report',
                'exportType'=>'Excel2007',
                
                //'stream'=>false,
                'columns' => array(
                        'pegawai_nama',
                        'pegawaiOpd.opd_nama',
                        'is_updated',
                        //'tgl_updated',
                        //'is_aktif'
                ),
            ));
        }
        
        public function actionExport(){
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Report_'.date('Y-m-d H:i:s').'.xlsx"');
            header('Cache-Control: max-age=0');


            $spreadsheet = new Spreadsheet();
            $spreadsheet->getProperties()
                ->setCreator("Ryan Brayoga")
                ->setTitle("Sensus Penduduk Online di Instansi")
                ->setCategory("SP2020");
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Nama');
            $sheet->setCellValue('B1', 'Instansi');
            $sheet->setCellValue('C1', 'Sudah?');
            $sheet->setCellValue('D1', 'Tanggal Upload');
            
            if(Yii::app()->user->getLevel()==4){
                $model= LPegawai::model()->findAllByAttributes(array('is_aktif'=>1, 'pegawai_opd'=>Yii::app()->user->getUser()->user_opd));
            }else{
                $model= LPegawai::model()->findAllByAttributes(array('is_aktif'=>1),
                    array('with'=>array('pegawaiOpd'),'condition'=>'pegawaiOpd.opd_wil=:wil','params'=>array(':wil'=>Yii::app()->user->getWilayah())));
            }
            
            $i=2;
            foreach ($model as $key => $value) {
                $sheet->setCellValue('A'.$i , $value->pegawai_nama);
                $sheet->setCellValue('B'.$i , $value->pegawaiOpd->opd_nama);
                $sheet->setCellValue('C'.$i , $value->is_updated);
                $sheet->setCellValue('D'.$i , $value->tgl_updated);
                $i++;
            }

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }

        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new LPegawai;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LPegawai']))
		{
			$model->attributes=$_POST['LPegawai'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_pegawai));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEdit($i)
	{
                $id=$i/12345;
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LPegawai']))
		{
			$model->attributes=$_POST['LPegawai'];
			if($model->save()){
                            Yii::app()->user->setFlash('success','Berhasil edit pegawai '.$model->pegawai_nama);
                            $this->redirect(array('admintoedit'));
                        }
				
		}

		$this->render('edit',array(
			'model'=>$model,
		));
	}
        
	public function actionCopy($i)
	{
                $id=$i/21156;
		$model=$this->loadModel($id);

		$modelList=new LPegawai('search');
		$modelList->unsetAttributes();  // clear any default values
		if(isset($_GET['LPegawai']))
			$modelList->attributes=$_GET['LPegawai'];

		$this->render('copy',array(
			'model'=>$model,
			'modelList'=>$modelList,
		));
	}
        
        public function actionPaste($i,$f){
                $modelTarget= LPegawai::model()->findByPk($i/1234);
                $modelSource= LPegawai::model()->findByPk($f/1234);
                $modelTarget->is_updated = $modelSource->is_updated;
                $modelTarget->tgl_updated = $modelSource->tgl_updated;
                $modelTarget->pegawai_upload = $modelSource->pegawai_upload;
                
                if($modelTarget->update()){
                    Yii::app()->user->setFlash('success',"Berhasil mencopy bukti $modelSource->pegawai_nama ke $modelTarget->pegawai_nama");
                            $this->redirect(array('admintoedit'));
                }
        }
        
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LPegawai']))
		{
			$model->attributes=$_POST['LPegawai'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_pegawai));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('LPegawai');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new LPegawai('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LPegawai']))
			$model->attributes=$_GET['LPegawai'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionAdminwil()
	{
		$model=new LPegawai('searchbywil');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LPegawai']))
			$model->attributes=$_GET['LPegawai'];

		$this->render('adminwil',array(
			'model'=>$model,
		));
	}
        
        public function actionAdmintoedit()
	{
		$model=new LPegawai('searchbywil');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LPegawai']))
			$model->attributes=$_GET['LPegawai'];

		$this->render('admintoedit',array(
			'model'=>$model,
		));
	}
        
        public function actionAdminopd()
	{
                $opd = Yii::app()->user->getUser()->user_opd;
		$model=new LPegawai('searchbyopd');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LPegawai']))
			$model->attributes=$_GET['LPegawai'];

		$this->render('adminopd',array(
			'model'=>$model,
                        'opd'=>$opd,
		));
	}
        
        public function  actionAdminopd2(){
            $this->redirect(array('tUpload/um'));
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return LPegawai the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=LPegawai::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param LPegawai $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='lpegawai-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

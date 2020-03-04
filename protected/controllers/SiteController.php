<?php
require_once Yii::app()->basePath.'/../tesseract/vendor/autoload.php';
use thiagoalessio\TesseractOCR\TesseractOCR;

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
    
        
        
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
        
        

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
            /*
                $model = LPegawai::model()->getPercentagebyWil("5100");
                
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
                $sudah= count(LPegawai::model()->findAllByAttributes(array('is_updated'=>1))); // masih keseluruhan, ganti dengan per wilayah
                $belum= count(LPegawai::model()->findAllByAttributes(array('is_updated'=>0)));
                $pieChartData=array();
                $pieChartData[0]=array("Sudah",$sudah);
                $pieChartData[1]=array("Belum",$belum);
                
                //untuk line chart
                $lineChartData=array();
                $week = array('2020-02-21','2020-02-28','2020-03-06','2020-03-13','2020-03-20','2020-03-27','2020-03-31');
                foreach ($week as $key =>$val){
                    $pegawai= LPegawai::model()->findAll(array(
                        'condition'=>'is_updated=:status AND tgl_updated <= :date',
                        'params'=>array(':status'=>1, ':date'=>$val),
                    ));
                    $lineChartData[]= count($pegawai);
                }
                
                
		$this->render('index',array('dataku'=>$barChartData,'dataPie'=>$pieChartData,'dataLine'=>$lineChartData));
             * 
             */
            $this->redirect(array('tUpload/upload'));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
        
        public function actionUpload()
        {
            $this->layout='//layouts/columnBlank';
            $model=new BuktiSPO;
            $namafile;
            $mdsfile;
            if(isset($_POST['BuktiSPO']))
		{
			$model->attributes=$_POST['BuktiSPO'];
                        //$model->id=$id;
                        $model->md5="-";
                        if(strlen(trim(CUploadedFile::getInstance ($model,'file'))) > 0)
                        {
                            $simpanSementara=CUploadedFile::getInstance($model, 'file');
                            $namafile=$simpanSementara->name;
                            $mdsfile=md5_file($simpanSementara->tempName);
                            echo shell_exec('magick convert -units PixelsPerInch -density 300 '.$simpanSementara->tempName.' -resample 300 '.Yii::app()->basePath. '/../bukti/con3.jpg');
                            
                        }
			if($simpanSementara->extensionName=='pdf'){
                            if(strlen(trim($namafile))>0)
                            {        
                                
                                //$simpanSementara->saveAs(Yii::app()->basePath. '/../bukti/'.$namafile);
                                //echo shell_exec('magick convert -units PixelsPerInch -density 300 '.Yii::app()->basePath. '/../bukti/'.$namafile.' -resample 300 '.Yii::app()->basePath. '/../bukti/con3.jpg');
                            
                                $mystring = (new TesseractOCR(Yii::app()->basePath. '/../bukti/con3-0.jpg'))
                                    ->whitelist(range('a', 'z'),range('A', 'Z'), range(0, 9), ' ')
                                    ->psm(4)
                                    //->setRectangle(1,1,100,100)
                                ->run();
                            }
                            //$this->redirect(array('brs/viewtgl','t'=>$brs->tanggal,'b'=>$brs->bulan));
                            Yii::app()->user->setFlash('upload',$mystring.'<br/>'.'<br/>'.$mdsfile);
				$this->refresh();
                        }
				
		}
            $this->render('upload', array('model'=>$model));
        }

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
                $this->layout='//layouts/columnBlank';
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
		//$this->redirect(array('tUpload/um'));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		//$this->redirect(Yii::app()->homeUrl);
		$this->redirect(array('lPegawai/dashboard'));
	}
}
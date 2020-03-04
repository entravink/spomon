<?php
require_once Yii::app()->basePath.'/../tesseract/vendor/autoload.php';
include Yii::app()->basePath.'/pdf/vendor/autoload.php';
use thiagoalessio\TesseractOCR\TesseractOCR;
class TUploadController extends Controller
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
				'actions'=>array('upload','report','setopd','reportb','um'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create2','update2','index2','view2'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','rej','acc','reportdetail','reportlist','reportlistb','sikat','forceup','switch'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TUpload;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TUpload']))
		{
			$model->attributes=$_POST['TUpload'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_upload));
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TUpload']))
		{
			$model->attributes=$_POST['TUpload'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_upload));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        public function actionUm(){
            $this->layout='//layouts/columnBlank';
            $this->render('um');
        }
        
        public function actionUpload2(){
            $this->redirect(array('um'));
        }
        
        public function actionForceup($i){
            $id=$i/34562;
            $modelPegawai= LPegawai::model()->findByPk($id);
            $model=new TUpload();
            $model->setScenario('force');
            if(isset($_POST['TUpload'])){
                $model->attributes=$_POST['TUpload'];
                $model->tgl_upload=date('Y-m-d');
                $model->upload_opd=$modelPegawai->pegawai_opd;
                $folder = $modelPegawai->pegawaiOpd->opd_alias;
                if(strlen(trim(CUploadedFile::getInstance ($model,'upload_file_loc'))) > 0 && $model->upload_opd!=null)
                {
                    $simpanSementara=CUploadedFile::getInstance($model, 'upload_file_loc');
                    $namafile=$simpanSementara->name;
                    $mdsfile=md5_file($simpanSementara->tempName);
                    $model->upload_md5=$mdsfile;
                    
                    $model->fileEx=$simpanSementara->extensionName;
                    $model->upload_status=7;

                    //checking file validity by producer
                    if($simpanSementara->extensionName=="pdf"){
                        $parser = new \Smalot\PdfParser\Parser();
                        $pdf    = $parser->parseFile($simpanSementara->tempName);
                        $details  = $pdf->getDetails();
                        $model->fileVal= substr($details['Producer'],0,5);
                    }


                    if (!is_dir(Yii::app()->basePath . '/../bukti/'.$folder)) {
                            mkdir(Yii::app()->basePath . '/../bukti/'.$folder);
                    }
                    $model->upload_file_loc=$folder.'/'.$mdsfile.'.jpg';

                    //model pegawai
                    

                }
                if($model->save()){
                    if(strlen(trim($namafile))>0)
                    {        
                        echo shell_exec('magick convert -units PixelsPerInch -density 300 '.$simpanSementara->tempName.'[0] -resample 300 '.Yii::app()->basePath. '/../bukti/'.$folder.'/'.$mdsfile.'.jpg');
                        $modelPegawai->is_updated=1;
                        $modelPegawai->pegawai_upload=$model->id_upload;
                        $modelPegawai->tgl_updated=date('Y-m-d');
                        $modelPegawai->update();
                        Yii::app()->user->setFlash('success','Berhasil upload bukti '.$modelPegawai->pegawai_nama);
                            $this->redirect(array('lPegawai/admintoedit'));
                        
                    }
                
                }
            }
            $this->render('forceup', array('model'=>$model,'modelPegawai'=>$modelPegawai));
            
        }

        public function actionUpload()
        {
            $this->layout='//layouts/columnBlank';
            $model=new TUpload;
            $model->setScenario('upload');
            //$this->performAjaxValidation($model);
            $namafile;
            $mdsfile;
            $folder;
            if(isset($_POST['TUpload']))
		{
			$model->attributes=$_POST['TUpload'];
                        //$model->id=$id;
                        //$model->md5="-";
                        $model->tgl_upload=date('Y-m-d');
                        $folder = MOpd::model()->findByPk($_POST['TUpload']['upload_opd']);
                        if(strlen(trim(CUploadedFile::getInstance ($model,'upload_file_loc'))) > 0 && $model->upload_opd!=null)
                        {
                            $simpanSementara=CUploadedFile::getInstance($model, 'upload_file_loc');
                            $namafile=$simpanSementara->name;
                            $mdsfile=md5_file($simpanSementara->tempName);
                            $model->upload_md5=$mdsfile;
                            $model->fileEx=$simpanSementara->extensionName;
                            $model->upload_status=0;
                            
                            //checking file validity by producer
                            if($simpanSementara->extensionName=="pdf"){
                                $parser = new \Smalot\PdfParser\Parser();
                                $pdf    = $parser->parseFile($simpanSementara->tempName);
                                $details  = $pdf->getDetails();
                                //$model->fileVal=$details['Producer'];
                                $model->fileVal= substr($details['Producer'],0,5);
                            }

                            
                            if (!is_dir(Yii::app()->basePath . '/../bukti/'.$folder->opd_alias)) {
                                    mkdir(Yii::app()->basePath . '/../bukti/'.$folder->opd_alias);
                            }
                            $model->upload_file_loc=$folder->opd_alias.'/'.$mdsfile.'.jpg';
                            
                            //for testing purpose
                            
                        }
			if($model->save()){
                            if(strlen(trim($namafile))>0)
                            {        
                                //for testing purpose
                                //$simpanSementara->saveAs(Yii::app()->basePath. '/../bukti/'.$folder->opd_alias.'/'.$mdsfile.'.pdf');
                                //echo shell_exec('magick convert -units PixelsPerInch -density 300 '.Yii::app()->basePath. '/../bukti/'.$folder->opd_alias.'/'.$mdsfile.'.pdf[0] -resample 300 '.Yii::app()->basePath. '/../bukti/'.$folder->opd_alias.'/'.$mdsfile.'.jpg');
                                
                                echo shell_exec('magick convert -units PixelsPerInch -density 300 '.$simpanSementara->tempName.'[0] -resample 300 '.Yii::app()->basePath. '/../bukti/'.$folder->opd_alias.'/'.$mdsfile.'.jpg');
                                //echo shell_exec('magick convert -units PixelsPerInch -density 300 '.$simpanSementara->tempName.' -sharpen 0x0.5 -resample 300 '.Yii::app()->basePath. '/../bukti/'.$folder->opd_alias.'/'.$mdsfile.'.jpg');
                            
                                $mystring = (new TesseractOCR(Yii::app()->basePath. '/../bukti/'.$folder->opd_alias.'/'.$mdsfile.'.jpg'))
                                    ->whitelist(range('a', 'z'),range('A', 'Z'), range(0, 9), ' ')
                                    ->psm(4)
                                    //->setRectangle(1,1,100,100)
                                ->run();
                                $posVal=strpos($mystring, "DATA");
                                $mainString = substr($mystring, $posVal + 4);
                                //$model->fileVal=$mainString;
                                $baris=array();
                                $baris=explode("\n",$mainString);
                                
                                //doc the transaction with these variables
                                $namaUploader="";
                                $hitSudah=0;
                                $hitLainnya=0;
                                
                                $transaction = Yii::app()->db->beginTransaction();
                                try{
                                    
                                    foreach($baris as $key => $value){
                                            if (substr($value,-12)=="Sudah Update" || substr($value,-5)=="Sudah" || substr($value,-11)=="SudahUpdate" || substr($value,-11)=="sudahUpdate"){
                                                //if (preg_match('/\\d/', $value) > 0){
                                                    if (preg_match("/ (.*?) Ada/", $value, $match) == 1 ||
                                                            preg_match("/ (.*?) undefined/", $value, $match) == 1 ||
                                                            preg_match("/ (.*?) Anggota/", $value, $match) == 1 ||
                                                            preg_match("/ (.*?) Meninggal/", $value, $match) == 1) {
                                                            //echo $match[1]."<br/>";
                                                            $namaPeg;
                                                            if (substr($match[1],0,1)==1){
                                                                    //echo substr_replace($match[1],"I",0,1)."<br/>";
                                                                    $namaPeg=substr_replace($match[1],"I",0,1);
                                                                    $namaPeg=str_replace(array("1"), "I", $namaPeg); //additional mereplace 1
                                                                    $model2 = new TGenerated;
                                                                    //$model2->generated_nama = substr_replace($match[1],"I",0,1);
                                                                    $model2->generated_nama = $namaPeg;
                                                                    $model2->id_upload=$model->id_upload;
                                                            }else{
                                                                    //echo $match[1]."<br/>";
                                                                    $namaPeg = $match[1];
                                                                    $namaPeg=str_replace(array("1"), "I", $namaPeg); //additional mereplace 1
                                                                    $model2 = new TGenerated;
                                                                    //$model2->generated_nama = $match[1];
                                                                    $model2->generated_nama = $namaPeg;
                                                                    $model2->id_upload=$model->id_upload;
                                                            }
                                                            //for matching purpose - ignoring "I "
                                                            $namaPegwoI;
                                                            if (substr($namaPeg,0,2)=="I "){
                                                                $namaPegwoI=substr_replace($namaPeg,"",0,2);
                                                            }else{
                                                                $namaPegwoI=$namaPeg;
                                                            }
                                                            
                                                            //first matching query
                                                            //$modelPegawai= LPegawai::model()->findByAttributes(array('pegawai_nama'=>$namaPeg,
                                                            //    'pegawai_opd'=>$model->upload_opd));
                                                            
                                                            //second matching query
                                                            $modelPegawai= LPegawai::model()->find('(REPLACE(REPLACE(REPLACE(pegawai_nama," ",""),".",""),"\'","")=REPLACE(?," ","") OR '
                                                                    . 'REPLACE(REPLACE(REPLACE(CONCAT(REPLACE(LEFT(pegawai_nama,2), "I ", ""),SUBSTRING(pegawai_nama, 2, CHAR_LENGTH(pegawai_nama)))," ",""),".",""),"\'","")=REPLACE(?," ","")) '
                                                                    . 'AND pegawai_opd=?',
                                                                    array($namaPeg,$namaPegwoI,$model->upload_opd));
                                                            if($modelPegawai!=null){
                                                                $namaUploader.="<br/>".$modelPegawai->pegawai_nama;
                                                                $modelPegawai->is_updated=1;
                                                                $modelPegawai->pegawai_upload=$model->id_upload;
                                                                $modelPegawai->tgl_updated=date('Y-m-d');
                                                                $modelPegawai->update();
                                                            }
                                                            if(!$model2->save()){
                                                                    throw new CException('Transaction failed: ');
                                                            }else{
                                                                
                                                            }

                                                    }
                                                    
                                                    $hitSudah=$hitSudah+1;
                                                //}
                                            }else if(substr($value,-13)=="Belum lengkap" || substr($value,-5)=="Belum" || substr($value,-9)=="Masih ada" || substr($value,-5)=="Masih"){
                                                $hitLainnya=$hitLainnya+1;
                                            }
                                    }
                                    $transaction->commit();
                                    if($namaUploader!=""){
                                        $sudah= count(LPegawai::model()->findAllByAttributes(array('is_updated'=>1,'pegawai_opd'=>$model->upload_opd,'is_aktif'=>1)));
                                        $belum= count(LPegawai::model()->findAllByAttributes(array('is_updated'=>0,'pegawai_opd'=>$model->upload_opd,'is_aktif'=>1)));
                                        Yii::app()->user->setFlash('upload','Terimakasih atas partisipasinya '.$namaUploader.'|'.$sudah.'|'.$belum);
                                        $model->upload_status=1;
                                        
                                    }else{
                                        if($posVal!=null){
                                            if($hitSudah>0&&$hitLainnya==0){
                                                Yii::app()->user->setFlash('gagal1','Bukti anda sudah lengkap, nama belum ditemukan oleh sistem.|'.$model->id_upload.'|'.$mdsfile);
                                                $model->upload_status=2;
                                            }else if($hitLainnya>0){
                                                Yii::app()->user->setFlash('gagal1b','Bukti Anda masih ada yg belum lengkap.|'.$model->id_upload.'|'.$mdsfile);
                                                $model->upload_status=2;
                                            }else{
                                                Yii::app()->user->setFlash('gagal1b','Bukti Anda masih ada yg belum lengkap-.|'.$model->id_upload.'|'.$mdsfile);
                                                $model->upload_status=2;
                                            }
                                            
                                        }else{
                                            Yii::app()->user->setFlash('gagal2','File tidak valid');
                                            $model->upload_status=9;
                                        }
                                        
                                    }
                                    $model->update();
                                    
                                    $this->refresh();
                                    
                                } catch (Exception $ex) {
                                    $transaction->rollback();
                                    echo CActiveForm::validate($model);

                                }
                                
                            }
                            
                        }
				
		}
            $this->render('upload', array('model'=>$model));
        }
        
        public function actionReport($i,$m)
        {
                $this->layout='//layouts/columnBlank';
                $model= TUpload::model()->findByAttributes(array('id_upload'=>$i,'upload_md5'=>$m));
                if(isset($_POST['TUpload']))
		{
			$model->upload_ket=$_POST['TUpload']['upload_ket'];
                        $model->upload_status = 3;
			if($model->save()){
                            Yii::app()->user->setFlash('lapor','Berhasil dilaporkan. <br/>Terima Kasih sudah berperan serta pada Sensus Penduduk Online 2020.');
                            $this->redirect(array('upload'));
                        }
			
		}
                
                $this->render('uprep',array('model'=>$model));
                
                //if($model->update()){
                //    Yii::app()->user->setFlash('lapor','Berhasil dilaporkan. <br/>Terima Kasih sudah berperan serta pada Sensus Penduduk Online 2020.');
                //            $this->redirect(array('upload'));
                //}
        }
        
        public function actionReportb($i,$m)
        {
                $this->layout='//layouts/columnBlank';
                $model= TUpload::model()->findByAttributes(array('id_upload'=>$i,'upload_md5'=>$m));
                if(isset($_POST['TUpload']))
		{
			$model->upload_ket=$_POST['TUpload']['upload_ket'];
                        $model->upload_status = 8;
			if($model->save()){
                            Yii::app()->user->setFlash('lapor','Berhasil dilaporkan. <br/>Terima Kasih sudah berperan serta pada Sensus Penduduk Online 2020.');
                            $this->redirect(array('upload'));
                        }
			
		}
                
                $this->render('uprep',array('model'=>$model));

        }
        
        public function actionReportasli($i,$m)
        {
                $model= TUpload::model()->findByAttributes(array('id_upload'=>$i,'upload_md5'=>$m));
                $model->upload_status = 3;
                if($model->update()){
                    Yii::app()->user->setFlash('lapor','Berhasil dilaporkan. <br/>Terima Kasih sudah berperan serta pada Sensus Penduduk Online 2020.');
                            $this->redirect(array('upload'));
                }
        }
        
        public function actionReportbasli($i,$m)
        {
                $model= TUpload::model()->findByAttributes(array('id_upload'=>$i,'upload_md5'=>$m));
                $model->upload_status = 8;
                if($model->update()){
                    Yii::app()->user->setFlash('lapor','Berhasil dilaporkan. <br/>Terima Kasih sudah berperan serta pada Sensus Penduduk Online 2020.');
                            $this->redirect(array('upload'));
                }
        }
        
        public function actionReportdetail($i,$m)
	{
                $upload= TUpload::model()->findByAttributes(array('id_upload'=>$i,'upload_md5'=>$m));
                $model=new LPegawai('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LPegawai']))
			$model->attributes=$_GET['LPegawai'];
                

		$this->render('reportdetail',array(
			'model'=>$model,
                        'uploadfile'=>$upload
		));
	}
        
        public function actionSwitch($i){
            $upload= TUpload::model()->findByAttributes(array('id_upload'=>$i));
            if(isset($_POST['TUpload']))
		{
			$upload->upload_opd=$_POST['TUpload']['upload_opd'];
			if($upload->save()){
                            Yii::app()->user->setFlash('success','Berhasil Dipindahkan');
                            $this->redirect(array('reportdetail','i'=>$upload->id_upload,'m'=>$upload->upload_md5));
                        }
				
		}
                $this->render('uprep',array('upload'=>$upload));
        }
        
        public function actionReportdummy()
	{
                //$upload= TUpload::model()->findByAttributes(array('id_upload'=>$i,'upload_md5'=>$m));
                $nama = $_POST['csrf'];
                $model=new LPegawai('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LPegawai']))
			$model->attributes=$_GET['LPegawai'];

		$this->render('reportdummy',array(
			'model'=>$model,
                        'nama'=>$nama,
                        //'uploadfile'=>$upload
		));
	}
        
        public function actionSikat(){
            $listUpload = TUpload::model()->findAllByAttributes(array('upload_status'=>3,'upload_opd'=>14),array('with'=>array('uploadOpd'),'condition'=>'uploadOpd.opd_wil=:wil','params'=>array(':wil'=>5100)));
            $kerja =0;
            $hitproses=0;
            foreach ($listUpload as $keyup =>$varup){
                if($kerja<=30){
                    
                    $mystring = (new TesseractOCR(Yii::app()->basePath. '/../bukti/'.$varup->upload_file_loc))
                    ->whitelist(range('a', 'z'),range('A', 'Z'), range(0, 9), ' ')
                    ->psm(4)
                    //->setRectangle(1,1,100,100)
                ->run();
                $posVal=strpos($mystring, "DATA");
                $mainString = substr($mystring, $posVal + 4);
                //$model->fileVal=$mainString;
                $baris=array();
                $baris=explode("\n",$mainString);

                //doc the transaction with these variables
                $namaUploader="";
                $hitSudah=0;
                $hitLainnya=0;

                //$transaction = Yii::app()->db->beginTransaction();


                    foreach($baris as $key => $value){
                            if (substr($value,-12)=="Sudah Update" || substr($value,-5)=="Sudah" || substr($value,-11)=="SudahUpdate" || substr($value,-11)=="sudahUpdate"){
                                //if (preg_match('/\\d/', $value) > 0){
                                    if (preg_match("/ (.*?) Ada/", $value, $match) == 1 ||
                                            preg_match("/ (.*?) undefined/", $value, $match) == 1 ||
                                            preg_match("/ (.*?) Anggota/", $value, $match) == 1 ||
                                            preg_match("/ (.*?) Meninggal/", $value, $match) == 1) {
                                            //echo $match[1]."<br/>";
                                            $namaPeg;
                                            if (substr($match[1],0,1)==1){
                                                    //echo substr_replace($match[1],"I",0,1)."<br/>";
                                                    $namaPeg=substr_replace($match[1],"I",0,1);
                                                    $namaPeg=str_replace(array("1"), "I", $namaPeg); //additional mereplace 1
                                                    $model2 = new TGenerated;
                                                    //$model2->generated_nama = substr_replace($match[1],"I",0,1);
                                                    $model2->generated_nama = $namaPeg;
                                                    $model2->id_upload=$varup->id_upload;
                                            }else{
                                                    //echo $match[1]."<br/>";
                                                    $namaPeg = $match[1];
                                                    $namaPeg=str_replace(array("1"), "I", $namaPeg); //additional mereplace 1
                                                    $model2 = new TGenerated;
                                                    //$model2->generated_nama = $match[1];
                                                    $model2->generated_nama = $namaPeg;
                                                    $model2->id_upload=$varup->id_upload;
                                            }
                                            //for matching purpose - ignoring "I "
                                            $namaPegwoI;
                                            if (substr($namaPeg,0,2)=="I "){
                                                $namaPegwoI=substr_replace($namaPeg,"",0,2);
                                            }else{
                                                $namaPegwoI=$namaPeg;
                                            }

                                            //second matching query
                                            $modelPegawai= LPegawai::model()->find('(REPLACE(REPLACE(REPLACE(pegawai_nama," ",""),".",""),"\'","")=REPLACE(?," ","") OR '
                                                    . 'REPLACE(REPLACE(REPLACE(CONCAT(REPLACE(LEFT(pegawai_nama,2), "I ", ""),SUBSTRING(pegawai_nama, 2, CHAR_LENGTH(pegawai_nama)))," ",""),".",""),"\'","")=REPLACE(?," ","")) '
                                                    . 'AND pegawai_opd=?',
                                                    array($namaPeg,$namaPegwoI,$varup->upload_opd));
                                            if($modelPegawai!=null){
                                                $namaUploader.="<br/>".$modelPegawai->pegawai_nama;
                                                $modelPegawai->is_updated=1;
                                                $modelPegawai->pegawai_upload=$varup->id_upload;
                                                $modelPegawai->tgl_updated=date('Y-m-d');
                                                $modelPegawai->update();
                                                $hitproses++;
                                            }
                                            if(!$model2->save()){
                                                    throw new CException('Transaction failed: ');
                                            }else{

                                            }

                                    }

                                    $hitSudah=$hitSudah+1;
                                //}
                            }
                    }
                    if($namaUploader!=""){
                        //$sudah= count(LPegawai::model()->findAllByAttributes(array('is_updated'=>1,'pegawai_opd'=>$model->upload_opd)));
                        //$belum= count(LPegawai::model()->findAllByAttributes(array('is_updated'=>0,'pegawai_opd'=>$model->upload_opd)));
                        //Yii::app()->user->setFlash('upload','Terimakasih atas partisipasinya '.$namaUploader.'|'.$sudah.'|'.$belum);
                        $varup->upload_status=6;
                                        
                    }
                    
                    $varup->update();
                    
                    
                }
                $kerja++;
                
            }
            echo "terproses". $hitproses;
            
        }
        
        public function actionAcc($i,$m,$e){
                $model= TUpload::model()->findByAttributes(array('id_upload'=>$i,'upload_md5'=>$m));
                $pegawai = LPegawai::model()->findByPk($e);

                if($model->upload_status==3){
                    $model->upload_status = 5;
                }else if($model->upload_status==8){
                    $model->upload_status = 88;
                }
                
                $pegawai->is_updated=1;
                $pegawai->pegawai_upload=$model->id_upload;
                $pegawai->tgl_updated=$model->tgl_upload;
                if($model->update()){
                    $pegawai->update();
                    Yii::app()->user->setFlash('success','Laporan berhasil ditindaklanjuti.');
                            $this->redirect(array('reportlist'));
                }
        }
        
        public function actionRej($i,$m){
                $model= TUpload::model()->findByAttributes(array('id_upload'=>$i,'upload_md5'=>$m));
                $model->upload_status = 4;
                if($model->update()){
                    Yii::app()->user->setFlash('success','Laporan berhasil ditindaklanjuti');
                            $this->redirect(array('reportlist'));
                }
        }
        
        public function actionSetopd(){
            $id = $_GET["TUpload_id_wil"];
            $nilai=MOpd::model()->findAllByAttributes(array('opd_wil'=>$id,'is_aktif'=>1),array('order'=>'opd_nama'));
                foreach ($nilai as $i)
                {
                    
                        echo '<option value="'.$i->id_opd.'">'.$i->opd_nama.'</option>';
                    
                }
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
		$dataProvider=new CActiveDataProvider('TUpload');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TUpload('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TUpload']))
			$model->attributes=$_GET['TUpload'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionReportlist()
	{
		$model=new TUpload('report');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TUpload']))
			$model->attributes=$_GET['TUpload'];

		$this->render('reportlist',array(
			'model'=>$model,
		));
	}
        
        public function actionReportlistb()
	{
		$model=new TUpload('report');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TUpload']))
			$model->attributes=$_GET['TUpload'];

		$this->render('reportlistb',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TUpload the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TUpload::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TUpload $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tupload-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

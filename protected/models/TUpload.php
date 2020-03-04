<?php

/**
 * This is the model class for table "t_upload".
 *
 * The followings are the available columns in table 't_upload':
 * @property integer $id_upload
 * @property string $upload_md5
 * @property string $upload_file_loc
 * @property integer $upload_opd
 * @property integer $upload_status
 * @property string $tgl_upload
 * @property string $upload_ket
 *
 * The followings are the available model relations:
 * @property TGenerated[] $tGenerateds
 * @property MOpd $uploadOpd
 */
class TUpload extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $fileVal;
        public $fileEx;
        public $id_wil;
	public function tableName()
	{
		return 't_upload';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('upload_opd, tgl_upload', 'required'),
			array('upload_opd, upload_status', 'numerical', 'integerOnly'=>true),
			array('upload_md5', 'length', 'max'=>50),
			array('upload_file_loc', 'length', 'max'=>250),
                        array('fileVal', 'validateFile', 'message'=>'File tidak valid','on'=>'upload, force'),
                        array('upload_md5', 'validateDouble', 'message'=>'Anda sudah pernah mengupload data. Data Anda sudah diterima sistem. Terimakasih.','on'=>'upload'),
                        //array('fileEx', 'cekFileType', 'message'=>'Tipe file yang Anda upload tidak sesuai'),
                        array('upload_file_loc','file', 'types'=>'pdf', 'maxSize'=>1024 * 1024 * 16, 'tooLarge'=>'File tidak lebih dari 16MB','on'=>'upload, force'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_upload, upload_md5, upload_file_loc, upload_opd, tgl_upload, upload_ket', 'safe', 'on'=>'search'),
		);
	}
        
        public function cekFileType($attribute,$params){
		if($this->fileEx!='pdf'){
                    $this->addError($attribute,$params['message']);
                    return false;
                }
		
	}
        
        public function validateFile($attribute,$params){
		//if($this->fileVal!="jsPDF 1.3.1 2016-09-30T20:23:52.056Z:jameshall"){
		if($this->fileVal!="jsPDF"){
                    $this->addError($attribute,$params['message']);
                    return false;
                }
		
	}
        
        public function validateDouble($attribute,$params){
                $fileUpload= TUpload::model()->findAllByAttributes(array('upload_md5'=>$this->upload_md5,'upload_opd'=> $this->upload_opd));
                $fileUploadB= TUpload::model()->findAll(array(
                            'condition'=>'upload_md5=:md5 AND upload_opd=:opd AND (upload_status=3 OR upload_status=4 OR upload_status=5 OR upload_status=8 OR upload_status=88)',
                            'params'=>array(':md5'=>$this->upload_md5, ':opd'=>$this->upload_opd),
                        ));
		if($fileUploadB!=null){
                    $this->addError($attribute,$params['message']);
                    return false;
                }
		
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tGenerateds' => array(self::HAS_MANY, 'TGenerated', 'id_upload'),
			'uploadOpd' => array(self::BELONGS_TO, 'MOpd', 'upload_opd'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_upload' => 'Id Upload',
			'upload_md5' => 'File Upload',
			'upload_file_loc' => 'File Upload',
			'upload_opd' => 'Instansi',
			'upload_status' => 'Status', 
                        //0-belum dicek, 1-ditemukan, 2-tidak ditemukan tp tidak lapor, 3-tidak ditemukan dan lapor, 
                        //4-forced tolak, 5-forced terima ,9-file salah, 6-sikat terima, 7-force upload
                        //8-isian belum lengkap dan lapor, 88-force lapor dari isian belum lengkap
                        //97-buang, 
			'tgl_upload' => 'Tgl Upload',
			'upload_ket' => 'Keterangan Nama Pegawai',
			'id_wil' => 'Wilayah',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_upload',$this->id_upload);
		$criteria->compare('upload_md5',$this->upload_md5,true);
		$criteria->compare('upload_file_loc',$this->upload_file_loc,true);
		$criteria->compare('upload_opd',$this->upload_opd);
		$criteria->compare('upload_status',$this->upload_status);
		$criteria->compare('tgl_upload',$this->tgl_upload,true);
                $criteria->compare('upload_ket',$this->upload_ket,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function report() //for nama tidak ditemukan
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                $criteria->with=array('uploadOpd');
		$criteria->compare('id_upload',$this->id_upload);
		$criteria->compare('upload_md5',$this->upload_md5,true);
		$criteria->compare('upload_file_loc',$this->upload_file_loc,true);
		$criteria->compare('upload_opd',$this->upload_opd);
		$criteria->compare('upload_status',3);
		$criteria->compare('tgl_upload',$this->tgl_upload,true);
		$criteria->compare('upload_ket',$this->upload_ket,true);
                $criteria->compare('uploadOpd.opd_wil',Yii::app()->user->getWilayah(),true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function reportb() //for belum lengkap status
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                $criteria->with=array('uploadOpd');
		$criteria->compare('id_upload',$this->id_upload);
		$criteria->compare('upload_md5',$this->upload_md5,true);
		$criteria->compare('upload_file_loc',$this->upload_file_loc,true);
		$criteria->compare('upload_opd',$this->upload_opd);
		$criteria->compare('upload_status',8);
		$criteria->compare('tgl_upload',$this->tgl_upload,true);
                $criteria->compare('upload_ket',$this->upload_ket,true);
                $criteria->compare('uploadOpd.opd_wil',Yii::app()->user->getWilayah(),true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TUpload the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

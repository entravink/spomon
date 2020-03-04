<?php

/**
 * This is the model class for table "l_pegawai".
 *
 * The followings are the available columns in table 'l_pegawai':
 * @property integer $id_pegawai
 * @property string $pegawai_nik
 * @property string $pegawai_nama
 * @property integer $pegawai_opd
 * @property integer $pegawai_upload
 * @property integer $is_updated
 * @property string $tgl_updated
 * @property integer $is_aktif
 *
 * The followings are the available model relations:
 * @property MOpd $pegawaiOpd
 */
class LPegawai extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'l_pegawai';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pegawai_nama, pegawai_opd', 'required'),
			array('pegawai_opd, is_updated, is_aktif', 'numerical', 'integerOnly'=>true),
			array('pegawai_nik', 'length', 'max'=>25),
			array('pegawai_nama', 'length', 'max'=>100),
			array('tgl_updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pegawai, pegawai_nik, pegawai_nama, pegawai_opd, is_updated, is_aktif, tgl_updated', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'pegawaiOpd' => array(self::BELONGS_TO, 'MOpd', 'pegawai_opd'),
			'pegawaiUpload' => array(self::BELONGS_TO, 'TUpload', 'pegawai_upload'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_pegawai' => 'ID Pegawai',
			'pegawai_nik' => 'NIK',
			'pegawai_nama' => 'Nama Pegawai',
			'pegawai_opd' => 'Instansi',
			'pegawai_upload' => 'Bukti SPOnline',
			'is_updated' => 'Sudah Update?',
			'tgl_updated' => 'Tanggal Update',
			'is_aktif' => 'Masih Aktif',
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

		$criteria->compare('id_pegawai',$this->id_pegawai);
		$criteria->compare('pegawai_nik',$this->pegawai_nik,true);
		$criteria->compare('pegawai_nama',$this->pegawai_nama,true);
		$criteria->compare('pegawai_opd',$this->pegawai_opd);
		$criteria->compare('is_updated',$this->is_updated);
		$criteria->compare('is_aktif',$this->is_aktif);
		$criteria->compare('tgl_updated',$this->tgl_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function searchbyopd($opd,$status)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
                
		$criteria=new CDbCriteria;

		$criteria->compare('id_pegawai',$this->id_pegawai);
		$criteria->compare('pegawai_nik',$this->pegawai_nik,true);
		$criteria->compare('pegawai_nama',$this->pegawai_nama,true);
		$criteria->compare('pegawai_opd',$opd);
                if($status==99){
                    $criteria->compare('is_updated', $this->is_updated);
                }else{
                    $criteria->compare('is_updated',$status);
                }
		
		$criteria->compare('tgl_updated',$this->tgl_updated,true);
                $criteria->compare('is_aktif',$this->is_aktif);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function searchbywil()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                $criteria->with=array('pegawaiOpd');
		$criteria->compare('id_pegawai',$this->id_pegawai);
		$criteria->compare('pegawai_nik',$this->pegawai_nik,true);
		$criteria->compare('pegawai_nama',$this->pegawai_nama,true);
		$criteria->compare('pegawai_opd',$this->pegawai_opd);
		$criteria->compare('is_updated',$this->is_updated);
		$criteria->compare('tgl_updated',$this->tgl_updated,true);
                $criteria->compare('t.is_aktif',1);
		$criteria->compare('pegawaiOpd.opd_wil',Yii::app()->user->getWilayah(),true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function searchbyadminwil()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                $criteria->with=array('pegawaiOpd');
		$criteria->compare('id_pegawai',$this->id_pegawai);
		$criteria->compare('pegawai_nik',$this->pegawai_nik,true);
		$criteria->compare('pegawai_nama',$this->pegawai_nama,true);
		$criteria->compare('pegawai_opd',$this->pegawai_opd);
		$criteria->compare('is_updated',$this->is_updated);
		$criteria->compare('tgl_updated',$this->tgl_updated,true);
                $criteria->compare('t.is_aktif',$this->is_aktif);
		$criteria->compare('pegawaiOpd.opd_wil',Yii::app()->user->getWilayah(),true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getPercentagebyWil($wil){
            
            
            $sql="SELECT l.`pegawai_opd`, m.opd_nama, SUM(CASE WHEN l.`is_updated`=1 THEN 1 ELSE 0 END )/count(l.pegawai_opd)*100 as percentage
            FROM `l_pegawai` l, m_opd m
            WHERE l.pegawai_opd=m.id_opd AND m.opd_wil='$wil' AND m.is_aktif=1 AND l.is_aktif=1
            GROUP BY l.pegawai_opd";
            
            $rawData = Yii::app()->db->createCommand($sql); //or use ->queryAll(); in CArrayDataProvider
            $count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar(); //the count

        
        $model = new CSqlDataProvider($rawData, array( //or $model=new CArrayDataProvider($rawData, array(... //using with querAll...
                    'keyField' => 'pegawai_opd', 
                    'totalItemCount' => $count,
                    
                    
                    'sort' => array(
                        'attributes' => array(
                            'opd_nama'
                        ),
                        'defaultOrder' => array(
                            'opd_nama' => CSort::SORT_ASC, //default sort value
                        ),
                    ),
                    'pagination' => array(
                        'pageSize' => 1000,
                    ),
                ));

            return $model;
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LPegawai the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

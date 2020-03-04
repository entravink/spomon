<?php

/**
 * This is the model class for table "m_opd".
 *
 * The followings are the available columns in table 'm_opd':
 * @property integer $id_opd
 * @property string $opd_nama
 * @property string $opd_alias
 * @property string $opd_wil
 * @property integer $is_aktif
 *
 * The followings are the available model relations:
 * @property LPegawai[] $lPegawais
 * @property MWil $opdWil
 * @property TUpload[] $tUploads
 */
class MOpd extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_opd';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('opd_nama, opd_alias, opd_wil, is_aktif', 'required'),
			array('is_aktif', 'numerical', 'integerOnly'=>true),
			array('opd_nama', 'length', 'max'=>100),
			array('opd_alias', 'length', 'max'=>25),
			array('opd_wil', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_opd, opd_nama, opd_alias, opd_wil, is_aktif', 'safe', 'on'=>'search'),
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
			'lPegawais' => array(self::HAS_MANY, 'LPegawai', 'pegawai_opd'),
			'opdWil' => array(self::BELONGS_TO, 'MWil', 'opd_wil'),
			'tUploads' => array(self::HAS_MANY, 'TUpload', 'upload_opd'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_opd' => 'ID Instansi',
			'opd_nama' => 'Instansi',
			'opd_alias' => 'Opd Alias',
			'opd_wil' => 'Wilayah',
			'is_aktif' => 'Is Aktif',
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

		$criteria->compare('id_opd',$this->id_opd);
		$criteria->compare('opd_nama',$this->opd_nama,true);
		$criteria->compare('opd_alias',$this->opd_alias,true);
		$criteria->compare('opd_wil',$this->opd_wil,true);
		$criteria->compare('is_aktif',$this->is_aktif);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MOpd the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

<?php

/**
 * This is the model class for table "m_wil".
 *
 * The followings are the available columns in table 'm_wil':
 * @property string $id_wil
 * @property string $wil_nama
 * @property integer $wil_level
 *
 * The followings are the available model relations:
 * @property MOpd[] $mOpds
 */
class MWil extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_wil';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_wil, wil_nama, wil_level', 'required'),
			array('wil_level', 'numerical', 'integerOnly'=>true),
			array('id_wil', 'length', 'max'=>4),
			array('wil_nama', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_wil, wil_nama, wil_level', 'safe', 'on'=>'search'),
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
			'mOpds' => array(self::HAS_MANY, 'MOpd', 'opd_wil'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_wil' => 'Id Wil',
			'wil_nama' => 'Wil Nama',
			'wil_level' => 'Wil Level',
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

		$criteria->compare('id_wil',$this->id_wil,true);
		$criteria->compare('wil_nama',$this->wil_nama,true);
		$criteria->compare('wil_level',$this->wil_level);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MWil the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

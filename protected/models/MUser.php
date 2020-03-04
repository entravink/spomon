<?php

/**
 * This is the model class for table "m_user".
 *
 * The followings are the available columns in table 'm_user':
 * @property integer $id_user
 * @property string $username
 * @property string $password
 * @property string $salt_password
 * @property string $nama
 * @property string $avatar
 * @property integer $user_opd
 * @property string $user_wil
 * @property integer $user_level
 * @property integer $is_aktif
 *
 * The followings are the available model relations:
 * @property MLevelUser $userLevel
 * @property MOpd $userOpd
 * @property MWil $userWil
 */
class MUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, salt_password, nama, avatar, user_opd, user_wil, user_level, is_aktif', 'required'),
			array('user_opd, user_level, is_aktif', 'numerical', 'integerOnly'=>true),
			array('username, password, salt_password, avatar', 'length', 'max'=>50),
			array('nama', 'length', 'max'=>100),
			array('user_wil', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_user, username, password, salt_password, nama, avatar, user_opd, user_wil, user_level, is_aktif', 'safe', 'on'=>'search'),
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
			'userLevel' => array(self::BELONGS_TO, 'MLevelUser', 'user_level'),
			'userOpd' => array(self::BELONGS_TO, 'MOpd', 'user_opd'),
			'userWil' => array(self::BELONGS_TO, 'MWil', 'user_wil'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => 'Id User',
			'username' => 'Username',
			'password' => 'Password',
			'salt_password' => 'Salt Password',
			'nama' => 'Nama',
			'avatar' => 'Avatar',
			'user_opd' => 'User Opd',
			'user_wil' => 'User Wil',
			'user_level' => 'User Level',
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

		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt_password',$this->salt_password,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('user_opd',$this->user_opd);
		$criteria->compare('user_wil',$this->user_wil,true);
		$criteria->compare('user_level',$this->user_level);
		$criteria->compare('is_aktif',$this->is_aktif);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function validatePassword($password)
        { 
            return $this->hashPassword($password,$this->salt_password)===$this->password;

        }
        
        public function hashPassword($password,$salt)
        { 
            return md5($salt.$password);
        }


        public function generateSalt()
        { 
            return uniqid('',true);
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

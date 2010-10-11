<?php

/**
 * This is the model class for table "userdetails".
 */
class Userdetails extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'userdetails':
	 * @var integer $userid
	 * @var string $username
	 * @var string $openidurl
	 * @var string $email
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Userdetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'userdetails';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username', 'length', 'max'=>50),
			array('openidurl', 'length', 'max'=>300),
			array('email', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid, username, openidurl, email', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userid' => 'Userid',
			'username' => 'Username',
			'openidurl' => 'Openidurl',
			'email' => 'Email',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('userid',$this->userid);

		$criteria->compare('username',$this->username,true);

		$criteria->compare('openidurl',$this->openidurl,true);

		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function isOpenIdUrlFound($url){
		$results=$this::model()->count("openidurl=:openidurl",array(':openidurl'=>$url));
		
		if($results>0){
			return true;
		}else{
			return false;
		}
	}
	
	public function getUserByOpenIdUrl($url){
		$results=$this::model()->find("openidurl=:openidurl",array(":openidurl"=>$url));
		return $results;
	}
}
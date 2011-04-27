<?php

/**
 * This is the model class for table "Userdetails".
 *
 * The followings are the available columns in table 'Userdetails':
 * @property integer $userid
 * @property string $username
 * @property string $openidurl
 * @property string $email
 * @property integer $updatePref
 * @property integer $blogshopowner
 * @property integer $receiveEmail
 *
 * The followings are the available model relations:
 * @property Blogshop[] $blogshops
 * @property Post[] $posts
 * @property Preferences[] $preferences
 */
class Userdetails extends CActiveRecord
{
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
		return 'Userdetails';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('updatePref, blogshopowner, receiveEmail', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>50),
			array('openidurl', 'length', 'max'=>300),
			array('email', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid, username, openidurl, email, updatePref, blogshopowner, receiveEmail', 'safe', 'on'=>'search'),
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
			'blogshops' => array(self::HAS_MANY, 'Blogshop', 'openidurl'),
			'posts' => array(self::HAS_MANY, 'Post', 'userid'),
			'preferences' => array(self::HAS_MANY, 'Preferences', 'openidurl'),
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
			'updatePref' => 'Update Pref',
			'blogshopowner' => 'Blogshopowner',
			'receiveEmail' => 'Receive Email',
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
		$criteria->compare('updatePref',$this->updatePref);
		$criteria->compare('blogshopowner',$this->blogshopowner);
		$criteria->compare('receiveEmail',$this->receiveEmail);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function isOpenIdUrlFound($url){
		
		$results=Userdetails::model()->count("openidurl=:openidurl",array(':openidurl'=>$url));
		
		if($results>0){
			return true;
		}else{
			return false;
		}		
	}
	
	public function getUserByOpenIdUrl($url){
		$results=Userdetails::model()->find("openidurl=:openidurl",array(":openidurl"=>$url));
		return $results;
	}
}
<?php

/**
 * This is the model class for table "Preference".
 */
class Preference extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'Preference':
	 * @var integer $pref_id
	 * @var string $openidurl
	 * @var string $interested_categories
	 * @var integer $email_newsletter
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Preference the static model class
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
		return 'Preference';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pref_id, email_newsletter', 'numerical', 'integerOnly'=>true),
			array('openidurl, interested_categories', 'length', 'max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pref_id, openidurl, interested_categories, email_newsletter', 'safe', 'on'=>'search'),
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
			'pref_id' => 'Pref',
			'openidurl' => 'Openidurl',
			'interested_categories' => 'Interested Categories',
			'email_newsletter' => 'Email Newsletter',
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

		$criteria->compare('pref_id',$this->pref_id);

		$criteria->compare('openidurl',$this->openidurl,true);

		$criteria->compare('interested_categories',$this->interested_categories,true);

		$criteria->compare('email_newsletter',$this->email_newsletter);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
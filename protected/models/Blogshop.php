<?php

/**
 * This is the model class for table "blogshop".
 */
class Blogshop extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'blogshop':
	 * @var integer $id
	 * @var string $shopname
	 * @var string $url
	 * @var string $remarks
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Blogshop the static model class
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
		return 'blogshop';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shopname', 'length', 'max'=>255),
			array('url', 'length', 'max'=>100),
			array('remarks', 'length', 'max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, shopname, url, remarks', 'safe', 'on'=>'search'),
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
			'categories' => array(self::MANY_MANY, 'Category', 'blogshop_categories(blogshopid, categoryid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'shopname' => 'Shopname',
			'url' => 'Url',
			'remarks' => 'Remarks',
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

		$criteria->compare('id',$this->id);

		$criteria->compare('shopname',$this->shopname,true);

		$criteria->compare('url',$this->url,true);

		$criteria->compare('remarks',$this->remarks,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function addCategories($blogshopid,$categories){
		$connection=Yii::app()->db;
		$command=$connection->createCommand('insert into blogshop_categories values(:blogshopid,:categoryid)');
		$command->bindParam(':blogshopid',$blogshopid,PDO::PARAM_INT);

		foreach($categories as $category){
			$command->bindParam(':categoryid',$category,PDO::PARAM_INT);
			$command->execute();
		}
	}	

}
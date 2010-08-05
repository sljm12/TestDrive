<?php

/**
 * This is the model class for table "post".
 */
class Post extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'post':
	 * @var integer $id
	 * @var string $title
	 * @var string $url
	 * @var string $remarks
	 * @var integer $clicks
	 * @var string $dateUpdated
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Post the static model class
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
		return 'post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, url, remarks', 'required'),
			array('clicks', 'numerical', 'integerOnly'=>true),
			array('title, url', 'length', 'max'=>255),
			array('remarks', 'length', 'max'=>500),
			array('dateUpdated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, url, remarks, clicks, dateUpdated', 'safe', 'on'=>'search'),
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
			'categories' => array(self::MANY_MANY, 'Category', 'post_category(postid, categoryid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'url' => 'Url',
			'remarks' => 'Remarks',
			'clicks' => 'Clicks',
			'dateUpdated' => 'Date Updated',
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

		$criteria->compare('title',$this->title,true);

		$criteria->compare('url',$this->url,true);

		$criteria->compare('remarks',$this->remarks,true);

		$criteria->compare('clicks',$this->clicks);

		$criteria->compare('dateUpdated',$this->dateUpdated,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public function addCategories($postid,$categories){
		$connection=Yii::app()->db;
		$command=$connection->createCommand('insert into post_category values(:postid,:categoryid)');
		$command->bindParam(':postid',$postid,PDO::PARAM_INT);

		foreach($categories as $category){
			$command->bindParam(':categoryid',$category->id,PDO::PARAM_INT);
			$command->execute();
		}
	}

	public function getClicksDesc($limit,$offset){
		$criteria=new CDbCriteria();
		$criteria->order='clicks desc';
		
		$criteria->limit=$limit;
		$criteria->offset=$offset;

		$posts=Post::model()->findAll($criteria);
		return $posts;
	}

	public function getDateUpdatedDesc($limit,$offset){
		$criteria=new CDbCriteria();
		$criteria->order='dateUpdated desc';
		
		$criteria->limit=$limit;
		$criteria->offset=$offset;

		$posts=Post::model()->findAll($criteria);
		return $posts;
	}
}

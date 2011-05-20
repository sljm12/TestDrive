<?php

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $remarks
 * @property integer $clicks
 * @property string $dateUpdated
 * @property string $userid
 * @property string $file_hash
 * @property integer $blogid
 *
 * The followings are the available model relations:
 * @property Blogshop $blog
 * @property Userdetails $user
 * @property Category[] $categories
 */
class Post extends CActiveRecord
{
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
			array('title, url, remarks, dateUpdated', 'required'),
			array('clicks, blogid', 'numerical', 'integerOnly'=>true),
			array('title, url', 'length', 'max'=>255),
			array('remarks', 'length', 'max'=>500),
			array('userid', 'length', 'max'=>300),
			array('file_hash', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, url, remarks, clicks, dateUpdated, userid, file_hash, blogid', 'safe', 'on'=>'search'),
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
			'blog' => array(self::BELONGS_TO, 'Blogshop', 'blogid'),
			'user' => array(self::BELONGS_TO, 'Userdetails', 'userid'),
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
			'userid' => 'Userid',
			'file_hash' => 'File Hash',
			'blogid' => 'Blogid',
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
		$criteria->compare('userid',$this->userid,true);
		$criteria->compare('file_hash',$this->file_hash,true);
		$criteria->compare('blogid',$this->blogid);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function addCategories($postid,$categories){
		$connection=Yii::app()->db;
		$command=$connection->createCommand('insert into post_category values(:postid,:categoryid)');
		$command->bindParam(':postid',$postid,PDO::PARAM_INT);

		foreach($categories as $category){
			$command->bindValue(':categoryid',$category->id,PDO::PARAM_INT);
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
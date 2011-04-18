<?php

require 'screenshot.php';
require 'AbstractListPageController.php';

class PostController extends AbstractListPageController
{

	protected $global_limit=10;
	
	public function actionIndex()
	{
		$this->render('index');		
	}	

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	
	public function filters()
	{
		return array('accessControl');
	}
	
	public function accessRules()
	{
		return array(
			array('deny','actions'=>array('add'),'users'=>array('?')),
			array('allow','actions'=>array('add'),'users'=>array('@'))
		);
	}

	public function actionAdd()
	{
		$model=new Post;
		$categories=$this->getAllCategories();

		// uncomment the following code to enable ajax-based validation
		/*http://130.164.10.138/trac/newticket
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-add-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			$categories=$this->getCategoriesfromPost();
			
			$model->userid=Yii::app()->user->id;
			if($model->validate())
			{
				// form inputs are valid, do something here
				
				//$model->dateUpdated=new CDbExpression("datetime('now')"); //This is the one to use for SQl Lite
				$model->dateUpdated=new CDbExpression("now()");//THis is the one to use for MySql
				$model->clicks=1;
				//$model->categories=$categories;
				//$model->addRelatedRecord('categories',$categories,true);
				if($model->save()){
					$model->addCategories($model->id,$categories);
					$this->redirect(array('view','id'=>$model->id));
				}
				//return;
			}
		}
		$this->render('add',array('model'=>$model,'categories'=>$categories));
	}

	private function getAllCategories(){
		$criteria=new CDbCriteria();
		$criteria->order="name asc";
		$categories=Category::model()->findAll($criteria);
		return $categories;
	}

	private function getCategoriesfromPost(){
		$categories=$this->getAllCategories();
		$results=array();
		foreach($categories as $category){
			if(isset($_POST[$category->id])){
				$results[]=$category;
			}
		}
		return $results;
	}

	
	public function actionView(){
		$model==null;
		
		if(isset($_GET['id']))
				$model=Post::model()->findbyPk($_GET['id']);
		else
			throw new CHttpException(404,'The requested page does not exist.');
			
		$this->render('view',array('model'=>$model,'imageUrl'=>get_screenshot_url($model->url)));
	}
	
	public function actionClick(){
		$model==null;
		
		if(isset($_GET['id'])){
				$model=Post::model()->findbyPk($_GET['id']);
				$model->clicks=$model->clicks+1;
				if($model->save()){
					$this->render('click',array('model'=>$model));
				}else{
					throw new CHttpException(500,'Error in saving page');
				}
		}else
			throw new CHttpException(404,'The requested page does not exist.');
			
		
	}	
	
	public function actionLatest(){
		

		

		$page=0;
		if(isset($_GET['page'])){
			$page=$_GET['page'];
		}

		$limit=$this->global_limit;
		$offset=$page*$limit;		
		

		$posts=Post::model()->getDateUpdatedDesc($limit,$offset);
		
		$criteria=new CDbCriteria();
		$criteria->order='dateUpdated desc';
		$count=Post::model()->count($criteria);
		/*
		$pages=ceil($count/$limit);
		
		$num_of_pages=$pages;
	
		
		$front_limit_pages=$this->getFrontLimitPage($num_of_pages,$page,5);
		
		$back_limit_pages=$this->getBackLimitPage($num_of_pages,$page,5);
		
		$this->render('latest',array('posts'=>$posts,'page'=>$page,'count'=>$count,'pages'=>$pages,
		'back_limit'=>$back_limit_pages,'front_limit'=>$front_limit_pages));
		*/
		$viewArray=$this->getViewArray($count,$limit,$page,$limit);
		$viewArray['posts']=$posts;
		$this->render('latest',$viewArray);
		
	}
	
	protected function getFrontLimitPage($pages,$current_page,$front_limit_pages){
		
		if( ($current_page-$front_limit_pages) < 0)
		{
			//$front_limit_pages=0;
			return 0;
		}else{
			//$front_limit_pages=$current_page-$front_limit_pages;
			return $current_page-$front_limit_pages;
		}
	}
	
	protected function getBackLimitPage($pages,$current_page,$back_limit_pages){
		if( ($back_limit_pages + $page) > $pages)
		{
			return $pages;
		}else{
			return $page+$back_limit_pages;
		}
	}
	
	public function actionPopular(){
				
		$page=0;
		if(isset($_GET['page'])){
			$page=$_GET['page'];
		}

		$limit=$this->global_limit;
		$offset=$page*$limit;		
		

		$posts=Post::model()->getClicksDesc($limit,$offset);
		
		$criteria=new CDbCriteria();
		$criteria->order='clicks desc';
		$count=Post::model()->count($criteria);
		
		$viewArray=$this->getViewArray($count,$limit,$page,$limit);
		$viewArray['posts']=$posts;
		$this->render('popular',$viewArray);
	}
}

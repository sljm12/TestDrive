<?php

require 'screenshot.php';

class PostController extends Controller
{
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
	
	public function actionAdd()
	{
		$model=new Post;

		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-add-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			if($model->validate())
			{
				// form inputs are valid, do something here
				
				$model->dateUpdated=new CDbExpression("datetime('now')");
				$model->clicks=1;
				if($model->save()){
					$this->redirect(array('view','id'=>$model->id));
				}
				//return;
			}
		}
		$this->render('add',array('model'=>$model));
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
		$criteria=new CDbCriteria();
		$criteria->order='dateUpdated desc';
		$posts=Post::model()->findAll($criteria);
		$this->render('latest',array('posts'=>$posts));
	}
	
	public function actionPopular(){
		
		$criteria=new CDbCriteria();
		$criteria->order='clicks desc';
		$offset=0;
		
		if(isset($_GET['offset'])){	
			$offset=$_GET['offset'];
		}
		
		$criteria->limit=4;
		$criteria->offset=$_GET['offset'];
		$next=$offset+4;
		$posts=Post::model()->findAll($criteria);
		$count=Post::model()->count($criteria);
		$this->render('popular',array('posts'=>$posts,'count'=>$count,'next'=>$next));
	}
}
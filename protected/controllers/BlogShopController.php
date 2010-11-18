<?php

class BlogShopController extends Controller
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
	public function actionAdd(){
		$model=new Blogshop;

		if(isset($_POST['Blogshop'])){
			$model->attributes=$_POST['Blogshop'];
			if($model->validate()){
				if($model->save()){
					$this->redirect('latest');
				}
			}
		}
		$this->render('add',array('model'=>$model));
	}
	
	public function actionList(){
		$models=Blogshop::model()->findAll();
		
		$categories=Category::model()->findAll();
		
		if(isset($_GET['cat'])){
			$cat=$_GET['cat'];
			$this->render('list',array('categories'=>$categories));
			return;
		}
		
		$this->render('list',array('categories'=>$categories,'models'=>$models));
	}

}
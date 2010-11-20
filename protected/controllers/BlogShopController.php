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
		
		$categories=Category::getAllCategories();
		
		if(isset($_GET['cat'])){
			$cat=$_GET['cat'];
			$shops=Blogshop::model()->with(array('categories'=>array('condition'=>'name="'.$cat.'"')))->findAll();
			$this->render('list',array('categories'=>$categories,'shops'=>$shops));
			return;
		}
		
		$this->render('list',array('categories'=>$categories));
	}

}
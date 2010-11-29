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
	
	public function actionAdd(){
		$model=new Blogshop;
		$categories=Category::getAllCategories();

		if(isset($_POST['Blogshop'])){
			$model->attributes=$_POST['Blogshop'];
			if($model->validate()){
				$selected_categories=$_POST['category'];				
				if($model->save()){
					$this->redirect('list');
				}else{
					throw new CHttpException(500,'Error in saving Blogshop.');
				}
			}
		}
		$this->render('add',array('model'=>$model,'categories'=>$categories,'selected'=>$selected_categories));
	}
	
	public function actionList(){
		
		$categories=Category::getAllCategories();
		
		if(isset($_GET['cat'])){
			$cat=$_GET['cat'];
			//$shops=Blogshop::model()->with(array('categories'=>array('condition'=>'name="'.$cat.'"')))->findAll();
			
			$offset=0;
			if(isset($_GET['offset'])){
				$offset=$_GET['offset'];
			}
			
			$limit=1;
			
			if(isset($_GET['limit'])){
				$limit=$_GET['limit'];
			}
			
			/*
			$criteria=new CDbCriteria;			
			$criteria->with='categories';
			$criteria->condition='categories.name="photo"';
			$criteria->limit=1;
			$shops=Blogshop::model()->findAll($criteria);
			*/
			$shops_count=Blogshop::model()->countBySql('SELECT count(*) FROM blogshop, category, blogshop_categories 
			WHERE blogshop.id = blogshop_categories.blogshopid 
			AND category.id = blogshop_categories.categoryid 
			AND category.name = :cat',array(":cat"=>$cat));
			
			$shops=Blogshop::model()->findAllBySql('SELECT * FROM blogshop, category, blogshop_categories 
			WHERE blogshop.id = blogshop_categories.blogshopid 
			AND category.id = blogshop_categories.categoryid 
			AND category.name = :cat 
			limit :limit offset :offset',array(":cat"=>$cat,":limit"=>$limit,':offset'=>$offset));
			
			$this->render('list',array('categories'=>$categories,
								'shops'=>$shops,
								'limit'=>$limit,
								'offset'=>$offset,
								'shops_count'=>$shops_count));
			return;
		}
		
		$this->render('list',array('categories'=>$categories));
	}

}
<?php

require 'AbstractListPageController.php';

class BlogShopController extends AbstractListPageController
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
	
	public function actionAdd(){
		$model=new Blogshop;
		$categories=Category::getAllCategories();
		$selected_categories=array();

		if(isset($_POST['Blogshop'])){
			$model->attributes=$_POST['Blogshop'];
			$model->openidurl=YII::app()->user->id;
			if($model->validate()){
				$selected_categories=$_POST['category'];
				Yii::trace(print_r($_POST['category']),'application');				
				if($model->save()){
					$model->addCategories($model->id,$selected_categories);
					$this->redirect(array('list'));
				}else{
					throw new CHttpException(500,'Error in saving Blogshop.');
				}
			}
		}
		$this->render('add',array('model'=>$model,'categories'=>$categories,'selected'=>$selected_categories));
	}

	public function actionView(){
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$model=new Blogshop();
			$model=Blogshop::model()->find('id=:id',array('id'=>$id));

			$this->render('view',array('model'=>$model));
		}else{
			throw new CHttpException(500,'The record cannot be found');
		}
	}
	
	public function actionList(){
		
		$categories=Category::getAllCategories();
		
		if(isset($_GET['cat'])){
			$cat=$_GET['cat'];
			//$shops=Blogshop::model()->with(array('categories'=>array('condition'=>'name="'.$cat.'"')))->findAll();
			
			$page=0;
			
			if(isset($_GET['page'])){
				$page=$_GET['page'];
			}
			
			
			
			$limit=$this->global_limit;
			
			
			$offset=$page*$limit;
			
			
			$shops_count=Blogshop::model()->countBySql('SELECT count(*) FROM blogshop, category, blogshop_categories 
			WHERE blogshop.id = blogshop_categories.blogshopid 
			AND category.id = blogshop_categories.categoryid 
			AND category.name = :cat',array(":cat"=>$cat));
			
			$shops=Blogshop::model()->findAllBySql('SELECT * FROM blogshop, category, blogshop_categories 
			WHERE blogshop.id = blogshop_categories.blogshopid 
			AND category.id = blogshop_categories.categoryid 
			AND category.name = :cat 
			limit :limit offset :offset',array(":cat"=>$cat,":limit"=>(int)$limit,':offset'=>(int)$offset));
			
			/*
			$pages_count=ceil($shops_count/$limit);
			
			$front_page_limit=$this->getFrontLimitPage($pages_count,$page,5);
			$back_page_limit=$this->getBackLimitPage($pages_count,$page,5);									
			
			$this->render('list',array('categories'=>$categories,
								'shops'=>$shops,								
								'page'=>$page,								
								'front_limit_pages'=>$front_page_limit,
								'back_limit_pages'=>$back_page_limit));
			*/				
								
			$viewArray=$this->getViewArray($shops_count,$limit,$page,5);
			$viewArray['shops']=$shops;
			$viewArray['categories']=$categories;
			$this->render('list',$viewArray);
			return;
		}
		
		$this->render('list',array('categories'=>$categories,'shops'=>array(),'front_limit_pages'=>0,'back_limit_pages'=>0,'page'=>0));
	}
}

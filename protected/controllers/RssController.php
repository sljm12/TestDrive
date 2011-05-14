<?php

//require_once(YII::app()->getBasePath().'/components/SimplePieAutoloader.php');
//require_once(YII::app()->getBasePath().'/SimplePieAutoloader.php');
//require_once "rss_php.php";
//include "FeedParser.php";
//require_once(YII::app()->getBasePath().'/vendor/idn/idna_convert.class.php');
class RssController extends Controller
{
	public function actionIndex()
	{
		//$rss=new rss_php();
		//$rss->load('http://localhost/rss/stephen.xml');
		//$rss=new FeedParser();
		//$rss->parse('http://localhost/rss/rss2.xml');
		$id=1;
		$blogshop=BlogShop::model()->findByPk($id);
		$feed=new SimplePie();
		$feed->set_feed_url('http://localhost/rss/stephen.xml');
		$feed->enable_order_by_date(true);
		$feed->set_item_limit(3);
		$feed->init();
		$feed->handle_content_type();

		$items=$feed->get_items();
		$first=$items[0];
		

		$this->update_latest_time($blogshop,$first);

		$this->render('index',array('feed_items'=>$feed->get_items()));
	}

	/*
	 * $blogshop = an instance of BlogShop
	 * $first_item = an instance of SimplePie_Item
	 */
	private function update_latest_time($blogshop,$first_item){
		$last_blog_update=strtotime($blogshop->last_update);
		$first_item_date=strtotime($first_item->get_date('Y-m-d G:i:s'));
		//$first_item_date=strtotime('2011-04-28 18:00:00');

		if($blogshop->last_update== null){
			$blogshop->last_update=$first_item->get_date('Y-m-d G:i:s');
			$blogshop->update();
		}else if($first_item_date > $last_blog_update){
			$blogshop->last_update=$first_item->get_date('Y-m-d G:i:s');
			$blogshop->update();
		}
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
}

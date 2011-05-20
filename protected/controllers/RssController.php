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


		$results=$this->filter_rss_items($blogshop->last_update,$items);
		$this->write_results($id,$results);
		$this->update_latest_time($blogshop,$first);

		$this->render('index',array('feed_items'=>$results));
	}

	/* Returns only valid rss items since the last_update in the blogshop
	 */
	private function filter_rss_items($blog_last_update,$rss_items){
		$last_update=strtotime($blog_last_update);
		if($last_update==null){
			return $rss_items;
		}else{
			$results=array();
			foreach($rss_items as $item){
				if(strtotime($item->get_date()) > $last_update){
					$results[]=$item;
				}
			}
			return $results;
		}
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

	/**
	 * Persist results to disk
	 */
	private function write_results($blogshop_id,$rss_items){
		$dest_dir='c:/xampp/htdocs/testdrive/protected/sitedata';
		if(!is_dir($dest_dir)){
			mkdir($dest_dir);
		}
		foreach($rss_items as $item){
			$hash_filename=hash('sha256',$item->get_title());
			$fh=fopen($dest_dir.'/'.$hash_filename,'w+');
			fwrite($fh,$item->get_content());
			fclose($fh);
			$this->write_to_db($blogshop_id,$item,$hash_filename);
		}
	}

	private function write_to_db($blogshop_id,$rss_item,$hash_filename){
		$post=new Post();
		$post->dateUpdated=$rss_item->get_date();
		$post->title=$rss_item->get_title();
		//$post->url=$rss_item->get_link();
		$post->url='http://www.stephen.com';
		$post->remarks='Hello';
		$post->file_hash=$hash_filename;
		$post->blogid=$blogshop_id;
		if(!$post->validate(null,true)){
			$error_string='';
			throw new CHttpException(500,'Error in validation '.print_r($post->getErrors()));
		}
		if(!$post->save()){
			throw new CHttpException(500,'Error in saving');
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

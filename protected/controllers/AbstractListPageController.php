<?php

class AbstractListPageController extends Controller
{
	
	protected function getViewArray($records_count,$records_limit,$current_page,$page_limits){
		$pages_count=ceil($records_count/$records_limit);
		return array('page'=>$current_page,
					'front_limit_pages'=>$this->getFrontLimitPage($pages_count,$current_page,$page_limits),
					'back_limit_pages'=>$this->getBackLimitPage($pages_count,$current_page,$page_limits));
	}
	
	protected function getFrontLimitPage($pages_count,$current_page,$front_limit_pages){
		
		if( ($current_page-$front_limit_pages) < 0)
		{
			//$front_limit_pages=0;
			return 0;
		}else{
			//$front_limit_pages=$current_page-$front_limit_pages;
			return $current_page-$front_limit_pages;
		}
	}
	
	protected function getBackLimitPage($pages_count,$current_page,$back_limit_pages){
		if( ($back_limit_pages + $page) > $pages_count)
		{
			return $pages_count;
		}else{
			return $page+$back_limit_pages;
		}
	}

}
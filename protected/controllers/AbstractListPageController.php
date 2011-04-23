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

	/*
	 * pages_count = Total number of pages for the content
	 * current_page = Where the current page is
	 * back_limit_pages = how many pages to show from the back 
	 *
	 * Example
	 * current_page =3
	 * pages_count=10
	 * back_limit_pages=2
	 * We will show from page 3-5 
	 */	
	protected function getBackLimitPage($pages_count,$current_page,$back_limit_pages){
		if( ($back_limit_pages + $current_page) > $pages_count)
		{
			return $pages_count;
		}else{
			return $page+$back_limit_pages;
		}
	}

}

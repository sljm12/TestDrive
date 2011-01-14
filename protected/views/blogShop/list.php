<style type="text/css">
	.category_label{
		display:block;
	}
	.category_input{
		width:10px;			
		vertical-align:bottom;
	}
	
	#blogshoplist{
		padding:50px;
	}
	
	.blogshop{
		padding:5px;
	}
	
	.current_page{
	display: inline;
	padding-right: 5px;
	font-weight: bold;
	}
	
	.not_current_page{
		color: #999999;
		padding-right: 5px;
	}
	
</style>

<?php
	//echo 'limit='.$limit.'<br>';
	//echo 'offset='.$offset.'<br>';
	echo 'shops_count='.$shops_count.'<br>';
?>

<h2>Categories <?php 
	if(isset($_GET['cat'])){
		echo '- ',$_GET['cat'];
	}
?></h2>
<div id="categories">
<?php
	for($i=0;$i<sizeof($categories);$i++){
		$cat=$categories[$i];
		echo '<div class="category">'.
			'<a href=index.php?r=blogshop/list&cat='.urlencode($cat->name).'>'.$cat->name.'</a></div>';
	}
?>
</div>

<div>

<!-- <?php echo "Total size:".sizeof($shops) ?> -->
<div id="blogshoplist">
<?php
	for($i=0;$i<sizeof($shops);$i++){
		$model=$shops[$i];
		echo '<div class="blogshop">';
		echo '<div class="link"><a href="'.$model->url.'">'.$model->shopname.'</a></div>';
		echo '<div class="remarks">'.$model->remarks.'</div>';
		echo '</div>';
	}
?>
</div>

<div class="nextBar">
<?php
	$next=$offset+$limit;
	
	/*
	if($next >= $shops_count){
		echo "Last Page";
	}else{
		echo '<a href="index.php?r=blogshop/list&cat='.$cat->name.'&limit='.$limit.'&offset='.$next.
		'">Next Page</a>';
	}*/
	
	$num_of_pages=ceil($shops_count/$limit);
	
	$back_limit_pages=5;
	$front_limit_pages=5;
	
	if( ($page-$front_limit_pages) < 0)
	{
		$front_limit_pages=0;
	}else{
		$front_limit_pages=$page-$front_limit_pages;
	}
	
	if( ($back_limit_pages + $page) > $num_of_pages)
	{
		$back_limit_pages=$num_of_pages;
	}else{
		$back_limt_pages=$page+$back_limit_pages;
	}
	
	
	for($a=$front_limit_pages;$a<$back_limit_pages;$a++){
		//If its the current page
		if($a==$page){
			echo '<div class="current_page">'.($a+1).'</div>';
		}else{
			echo '<a class="not_current_page" href="index.php?r=blogshop/list&cat='.$cat->name.'&page='.$a.'">'.($a+1).'</a>';
		}
	}

	/* Debug info
	if($limit != 0){		
		echo '<br>Current Page '.$page.'<br>NUmber of pages '.$num_of_pages;
		echo '<br>Front Limit: '.$front_limit_pages.'<br>Back limit: '.$back_limit_pages;
	}*/
?>

</div>
</div><!-- form -->

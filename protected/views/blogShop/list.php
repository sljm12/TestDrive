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
</style>

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
</div><!-- form -->

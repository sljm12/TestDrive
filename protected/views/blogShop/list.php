<style type="text/css">
	.category_label{
		display:block;
	}
	.category_input{
		width:10px;			
		vertical-align:bottom;
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

<?php echo "Total size:".sizeof($shops) ?>
<?php
	for($i=0;$i<sizeof($shops);$i++){
		$model=$shops[$i];
		echo $model->shopname.'<br>';
		echo 'Categories'.sizeof($model->categories);
	}
?>

</div><!-- form -->

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
		echo '<div class="category">'.$cat->name.'</div>';
	}
?>
</div>

<div>

<?php echo sizeof($models) ?>
<?php
	for($i=0;$i<sizeof($models);$i++){
		$model=$models[$i];
		echo $model->id;
		echo sizeof($model->categories);
	}
?>

</div><!-- form -->

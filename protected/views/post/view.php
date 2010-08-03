<?php
$this->breadcrumbs=array(
	'Post',
);?>
<!--
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
-->
<p>	
	<div id="linkInfo" style="float:right;width:60%;">
		<h1><?php echo '<a href="index.php?r=post/click&id=',$model->id,'">' ?><?php echo $model->title; ?></a></h1>
		<?php echo $model->remarks; ?>
		<div id="postInfo">
			Clicks: <?php echo $model->clicks ?><br>			
		</div>
		<div class="categories">
			<?php 
				$categories=$model->categories;
				if(sizeof($categories)>0){
					echo "Category: ";
					foreach($categories as $category){
						echo "$category->name ";
					}
				}
			?>
		</div>
	</div>
	<div id="linkPicture">
		<img width="250" src=<?php echo $imageUrl ?>/>
	</div>
</p>

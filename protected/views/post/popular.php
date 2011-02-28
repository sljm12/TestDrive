<?php
$this->breadcrumbs=array(
	'Post','Popular Links'
);?>
<!--
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
-->
<p>	
	<?php
		//echo "Offset: Prev: $prev Next: $next <br>";
		//echo "Count: $count <br>";

		echo "<div id=\"links\">";
		for ($i=0;$i<sizeof($posts);$i++){
			$post=$posts[$i];
			echo '<div class="linkbox" >';
			
			$imgUrl=get_screenshot_url($post->url);			
			echo '<div class="blogImage"><img src="'.$imgUrl.'"></img></div>';
			
			echo '<div class="linkcontent">';
			echo "<div><a href=\"index.php?r=/post/view&id=$post->id\"><span class=\"link\">$post->title</span></a></div>";
			echo "<div class>Clicks: $post->clicks </div>";
			echo "<div class=\"remarks\">Remarks: $post->remarks</div>";
			echo "<div class=\"remarks\">Date Updated: $post->dateUpdated</div>";			
			echo '</div>';
			
			
			echo '</div>';
		}
		echo "</div>";

		echo '<div style="clear:both">';						
		for($a=$front_limit_pages;$a<$back_limit_pages;$a++){
			//If its the current page
			if($a==$page){
				echo '<div class="current_page">'.($a+1).'</div>';
			}else{
				echo '<a class="not_current_page" href="index.php?r=post/latest&page='.$a.'">'.($a+1).'</a>';
			}
		}
		echo '</div>';
	?>
</p>

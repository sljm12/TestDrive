<?php
$this->breadcrumbs=array(
	'Post',
);?>
<p>	
<!--
	<?php
		for ($i=0;$i<sizeof($posts);$i++){
			$post=$posts[$i];
			echo '<div>';
			echo $post->id  . '/' .  $post->title . $post->dateUpdated;
			echo '</div>';
		}
	?>
-->	
	<?php
		//echo "Offset: $next <br>";
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
			echo "<div class=\"categories\">";
				$categories=$post->categories;
				
				for($c=0;$c<sizeof($categories);$c++){
					$category=$categories[$c];
					echo $category->name;
				}
			echo "</div>";
			echo '</div>';
						
			
			
			echo '</div>';
		}
		echo "</div>";
		
		echo '<div style="clear:both">';
		if($prev >= 0){
			echo "<a href=\"index.php?r=post/latest&offset=$prev\">Prev</a>";
		}
		if($next < $count){
			echo "<a href=\"index.php?r=post/latest&offset=$next\">Next</a>";
		}else{
			echo "Last Page";
		}
		echo '</div>';
	?>
</p>

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
		echo "Offset: $next <br>";
		echo "Count: $count <br>";
		echo "Page: $page <br>";
		echo "Pages: $pages <br>";
		echo "Front: $front_limit_pages <br>";
		echo "back: $back_limit_pages <br>";
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
			echo "</div>";//close linkcontent
			echo '</div>';//close linkbox
						
			
			
			echo '</div>';
		}
		echo "</div>";//CLose links
		
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

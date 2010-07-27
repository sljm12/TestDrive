<?php
$this->breadcrumbs=array(
	'Post',
);?>
<!--
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
-->
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
		echo "<div id=\"links\">";
		for ($i=0;$i<sizeof($posts);$i++){
			$post=$posts[$i];
			echo '<div class="linkbox" >';
			
			echo '<div class="linkcontent">';
			echo "<div><a href=\"index.php?r=/post/view&id=$post->id\"><span class=\"link\">$post->title</span></a></div>";
			echo "<div class>Clicks: $post->clicks </div>";
			echo "<div class=\"remarks\">Remarks: $post->remarks</div>";
			echo '</div>';
			
			echo "<div><img src=\"http://localhost/apache_pb2.png\" width=250></img></div>";
			echo '</div>';
		}
		echo "</div>";
		
		if($next < $count){
			echo "<a href=\"index.php?r=post/popular&offset=$next\">Next</a>";
		}else{
			echo "Last Page";
		}
	?>
</p>

<?php
$this->breadcrumbs=array(
	'Rss',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<?php foreach($feed_items as $item){
	echo $item->get_title().' '.$item->get_date('Y-m-d G:i:s').'<br>';
	echo '<div class="feed_item">';
	echo $item->get_content();
	echo '</div>';
}
?>

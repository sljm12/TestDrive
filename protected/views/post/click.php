<?php
$this->breadcrumbs=array(
	'Post',
);?>

<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>	
	<script>
		window.location="<?php echo $model->url ?>";
	</script>
</p>

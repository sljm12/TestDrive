<?php
$this->breadcrumbs=array(
	'Userdetails'=>array('index'),
	$model->userid=>array('view','id'=>$model->userid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Userdetails', 'url'=>array('index')),
	array('label'=>'Create Userdetails', 'url'=>array('create')),
	array('label'=>'View Userdetails', 'url'=>array('view', 'id'=>$model->userid)),
	array('label'=>'Manage Userdetails', 'url'=>array('admin')),
);
?>

<h1>Update Userdetails <?php echo $model->userid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
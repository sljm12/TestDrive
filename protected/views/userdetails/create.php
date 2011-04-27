<?php
$this->breadcrumbs=array(
	'Userdetails'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Userdetails', 'url'=>array('index')),
	array('label'=>'Manage Userdetails', 'url'=>array('admin')),
);
?>

<h1>Create Userdetails</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
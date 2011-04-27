<?php
$this->breadcrumbs=array(
	'Userdetails'=>array('index')
);

/*
$this->menu=array(
	array('label'=>'List Userdetails', 'url'=>array('index')),
	array('label'=>'Create Userdetails', 'url'=>array('create')),
	array('label'=>'Update Userdetails', 'url'=>array('update', 'id'=>$model->userid)),
	array('label'=>'Delete Userdetails', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->userid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Userdetails', 'url'=>array('admin')),
);*/
?>

<h1>View Userdetails</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'userid',
		'username',
		'openidurl',
		'email',
		'updatePref',
		'blogshopowner',
		'receiveEmail',
	),
)); ?>

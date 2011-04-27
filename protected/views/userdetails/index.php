<?php
$this->breadcrumbs=array(
	'Userdetails',
);

$this->menu=array(
	array('label'=>'Create Userdetails', 'url'=>array('create')),
	array('label'=>'Manage Userdetails', 'url'=>array('admin')),
);
?>

<h1>Userdetails</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

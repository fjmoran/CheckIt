<?php
/* @var $this ProcessStepController */
/* @var $dataProvider CActiveDataProvider */
/*
$this->breadcrumbs=array(
	'Process Steps',
);

$this->menu=array(
	array('label'=>'Create ProcessStep', 'url'=>array('create')),
	array('label'=>'Manage ProcessStep', 'url'=>array('admin')),
);*/
?>

<h1>Process Steps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this ProcessTaskController */
/* @var $model ProcessTask */
/*
$this->breadcrumbs=array(
	'Process Tasks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProcessTask', 'url'=>array('index')),
	array('label'=>'Manage ProcessTask', 'url'=>array('admin')),
);*/
?>

<h1>Create ProcessTask</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
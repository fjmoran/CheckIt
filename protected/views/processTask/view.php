<?php
/* @var $this ProcessTaskController */
/* @var $model ProcessTask */
/*
$this->breadcrumbs=array(
	'Process Tasks'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ProcessTask', 'url'=>array('index')),
	array('label'=>'Create ProcessTask', 'url'=>array('create')),
	array('label'=>'Update ProcessTask', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProcessTask', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProcessTask', 'url'=>array('admin')),
);*/
?>

<h1>View ProcessTask #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'process_id',
	),
)); ?>

<?php
/* @var $this ProcessConnectorController */
/* @var $model ProcessConnector */
/*
$this->breadcrumbs=array(
	'Process Connectors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProcessConnector', 'url'=>array('index')),
	array('label'=>'Create ProcessConnector', 'url'=>array('create')),
	array('label'=>'Update ProcessConnector', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProcessConnector', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProcessConnector', 'url'=>array('admin')),
);*/
?>

<h1>View ProcessConnector #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'source_task_id',
		'target_task_id',
	),
)); ?>

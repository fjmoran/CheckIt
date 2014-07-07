<?php
/* @var $this ProcessStepController */
/* @var $model ProcessStep */

$this->breadcrumbs=array(
	'Process Steps'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProcessStep', 'url'=>array('index')),
	array('label'=>'Create ProcessStep', 'url'=>array('create')),
	array('label'=>'Update ProcessStep', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProcessStep', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProcessStep', 'url'=>array('admin')),
);
?>

<h1>View ProcessStep #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'process_task_id',
		'form_id',
		'position',
	),
)); ?>

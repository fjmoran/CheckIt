<?php
/* @var $this FormPropertyController */
/* @var $model FormProperty */
/*
$this->breadcrumbs=array(
	'Form Properties'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FormProperty', 'url'=>array('index')),
	array('label'=>'Create FormProperty', 'url'=>array('create')),
	array('label'=>'Update FormProperty', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FormProperty', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FormProperty', 'url'=>array('admin')),
);*/
?>

<h1>View FormProperty #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'form_id',
		'form_field_id',
		'visible',
		'required',
	),
)); ?>

<?php
/* @var $this FormFieldOptionController */
/* @var $model FormFieldOption */

$this->breadcrumbs=array(
	'Form Field Options'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List FormFieldOption', 'url'=>array('index')),
	array('label'=>'Create FormFieldOption', 'url'=>array('create')),
	array('label'=>'Update FormFieldOption', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FormFieldOption', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FormFieldOption', 'url'=>array('admin')),
);
?>

<h1>View FormFieldOption #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'form_field_id',
		'position',
	),
)); ?>

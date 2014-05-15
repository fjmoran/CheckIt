<?php
/* @var $this SubprojectController */
/* @var $model Subproject */

$this->breadcrumbs=array(
	'Subprojects'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Subproject', 'url'=>array('index')),
	array('label'=>'Create Subproject', 'url'=>array('create')),
	array('label'=>'Update Subproject', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Subproject', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Subproject', 'url'=>array('admin')),
);
?>

<h1>View Subproject #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'project_id',
	),
)); ?>

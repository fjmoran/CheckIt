<?php
/* @var $this GroupController */
/* @var $model Group */
/*
$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Group', 'url'=>array('index')),
	array('label'=>'Create Group', 'url'=>array('create')),
	array('label'=>'View Group', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Group', 'url'=>array('admin')),
);*/
?>

<h2>Editar Grupo</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
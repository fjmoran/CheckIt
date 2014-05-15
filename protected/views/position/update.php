<?php
/* @var $this PositionController */
/* @var $model Position */

$this->breadcrumbs=array(
	'Positions'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Position', 'url'=>array('index')),
	array('label'=>'Create Position', 'url'=>array('create')),
	array('label'=>'View Position', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Position', 'url'=>array('admin')),
);
?>

<h2>Editar Cargo</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
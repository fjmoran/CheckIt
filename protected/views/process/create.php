<?php
/* @var $this ProcessController */
/* @var $model Process */
/*
$this->breadcrumbs=array(
	'Processes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Process', 'url'=>array('index')),
	array('label'=>'Manage Process', 'url'=>array('admin')),
);*/
?>

<h2>Crear Flujo de Proceso</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this FormPropertyController */
/* @var $model FormProperty */

$this->breadcrumbs=array(
	'Form Properties'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FormProperty', 'url'=>array('index')),
	array('label'=>'Manage FormProperty', 'url'=>array('admin')),
);
?>

<h1>Create FormProperty</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
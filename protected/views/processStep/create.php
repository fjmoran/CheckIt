<?php
/* @var $this ProcessStepController */
/* @var $model ProcessStep */

$this->breadcrumbs=array(
	'Process Steps'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProcessStep', 'url'=>array('index')),
	array('label'=>'Manage ProcessStep', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model, 'task'=>$task)); ?>
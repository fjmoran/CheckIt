<?php
/* @var $this FormFieldController */
/* @var $model FormField */

$this->breadcrumbs=array(
	'Form Fields'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FormField', 'url'=>array('index')),
	array('label'=>'Manage FormField', 'url'=>array('admin')),
);
?>

<h1>Create FormField</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
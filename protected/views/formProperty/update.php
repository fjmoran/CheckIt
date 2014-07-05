<?php
/* @var $this FormPropertyController */
/* @var $model FormProperty */

$this->breadcrumbs=array(
	'Form Properties'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FormProperty', 'url'=>array('index')),
	array('label'=>'Create FormProperty', 'url'=>array('create')),
	array('label'=>'View FormProperty', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FormProperty', 'url'=>array('admin')),
);
?>

<h1>Update FormProperty <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
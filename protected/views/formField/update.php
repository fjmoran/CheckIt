<?php
/* @var $this FormFieldController */
/* @var $model FormField */

$this->breadcrumbs=array(
	'Form Fields'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FormField', 'url'=>array('index')),
	array('label'=>'Create FormField', 'url'=>array('create')),
	array('label'=>'View FormField', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FormField', 'url'=>array('admin')),
);
?>

<h1>Update FormField <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
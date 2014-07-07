<?php
/* @var $this ProcessStepController */
/* @var $model ProcessStep */

$this->breadcrumbs=array(
	'Process Steps'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProcessStep', 'url'=>array('index')),
	array('label'=>'Create ProcessStep', 'url'=>array('create')),
	array('label'=>'View ProcessStep', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProcessStep', 'url'=>array('admin')),
);
?>

<h1>Update ProcessStep <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
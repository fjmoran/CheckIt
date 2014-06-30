<?php
/* @var $this ProcessTaskController */
/* @var $model ProcessTask */

$this->breadcrumbs=array(
	'Process Tasks'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProcessTask', 'url'=>array('index')),
	array('label'=>'Create ProcessTask', 'url'=>array('create')),
	array('label'=>'View ProcessTask', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProcessTask', 'url'=>array('admin')),
);
?>

<h1>Update ProcessTask <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
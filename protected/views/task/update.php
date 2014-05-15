<?php
/* @var $this TaskController */
/* @var $model Task */

$this->breadcrumbs=array(
	'Tasks'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Task', 'url'=>array('index')),
	array('label'=>'Create Task', 'url'=>array('create')),
	array('label'=>'View Task', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Task', 'url'=>array('admin')),
);
?>

<h2>Editar <?php echo Yii::app()->utility->getOption('task_name'); ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
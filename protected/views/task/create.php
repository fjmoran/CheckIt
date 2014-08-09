<?php
/* @var $this TaskController */
/* @var $model Task */

/*$this->breadcrumbs=array(
	'Tasks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Task', 'url'=>array('index')),
	array('label'=>'Manage Task', 'url'=>array('admin')),
);*/
?>

<h2>Crear <?php echo Yii::app()->utility->getOption('task_name'); ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
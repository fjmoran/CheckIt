<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('index')),
	array('label'=>'Manage Project', 'url'=>array('admin')),
);
?>

<h2>Crear <?php echo Yii::app()->utility->getOption('project_name'); ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
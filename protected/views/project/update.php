<?php
/* @var $this ProjectController */
/* @var $model Project */
/*
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('index')),
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'View Project', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Project', 'url'=>array('admin')),
);*/
?>

<h2>Editar <?php echo Yii::app()->utility->getOption('project_name'); ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
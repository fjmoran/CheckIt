<?php
/* @var $this SubprojectController */
/* @var $model Subproject */

$this->breadcrumbs=array(
	'Subprojects'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Subproject', 'url'=>array('index')),
	array('label'=>'Create Subproject', 'url'=>array('create')),
	array('label'=>'View Subproject', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Subproject', 'url'=>array('admin')),
);
?>

<h1>Editar <?php echo Yii::app()->utility->getOption('subproject_name'); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
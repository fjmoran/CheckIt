<?php
/* @var $this SubprojectController */
/* @var $model Subproject */

$this->breadcrumbs=array(
	'Subprojects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Subproject', 'url'=>array('index')),
	array('label'=>'Manage Subproject', 'url'=>array('admin')),
);
?>

<h1>Crear <?php echo Yii::app()->utility->getOption('subproject_name'); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
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

<h2>Crear <?php echo Yii::app()->utility->getOption('subproject_name'); ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
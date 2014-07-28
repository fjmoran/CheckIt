<?php
/* @var $this PositionController */
/* @var $model Position */

$this->breadcrumbs=array(
	'Positions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Position', 'url'=>array('index')),
	array('label'=>'Manage Position', 'url'=>array('admin')),
);
?>

<h2>Crear <?php echo Yii::app()->utility->getOption('department_name') ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
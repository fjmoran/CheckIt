<?php
/* @var $this FormPropertyController */
/* @var $model FormProperty */
/*
$this->breadcrumbs=array(
	'Form Properties'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FormProperty', 'url'=>array('index')),
	array('label'=>'Create FormProperty', 'url'=>array('create')),
	array('label'=>'View FormProperty', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FormProperty', 'url'=>array('admin')),
);*/
?>

<h2>Proceso: <?php echo $process->name; ?></h2>

<?php echo Yii::app()->utility->getTabs(array('id'=>$process->id)); ?>

<div class="tab-content">
  <div class="tab-pane active">

  	<h3>Modificar campo en formulario <?php echo $_form->name ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'process'=>$process, '_form'=>$_form)); ?>

	</div>
</div>

<?php
/* @var $this FormFieldController */
/* @var $model FormField */
/*
$this->breadcrumbs=array(
	'Form Fields'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FormField', 'url'=>array('index')),
	array('label'=>'Create FormField', 'url'=>array('create')),
	array('label'=>'View FormField', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FormField', 'url'=>array('admin')),
);*/
?>

<h2>Proceso: <?php echo $process->name; ?></h2>

<?php echo Yii::app()->utility->getTabs(array('id'=>$process->id)); ?>

<div class="tab-content">
  <div class="tab-pane active">

  	<h3>Modificar campo</h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'process'=>$process)); ?>

	</div>
</div>
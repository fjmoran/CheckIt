<?php
/* @var $this FormFieldOptionController */
/* @var $model FormFieldOption */

$this->breadcrumbs=array(
	'Form Field Options'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FormFieldOption', 'url'=>array('index')),
	array('label'=>'Manage FormFieldOption', 'url'=>array('admin')),
);
?>

<h2>Proceso: <?php echo $process->name; ?></h2>

<?php echo Yii::app()->utility->getTabs(array('id'=>$model->id)); ?>

<div class="tab-content">
  <div class="tab-pane active">

  	<h3>Crear nuevo campo en formulario <?php echo $formField->name ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'process'=>$process, 'formField'=>$formField)); ?>

	</div>
</div>

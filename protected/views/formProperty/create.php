<?php
/* @var $this FormPropertyController */
/* @var $model FormProperty */

$this->breadcrumbs=array(
	'Form Properties'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FormProperty', 'url'=>array('index')),
	array('label'=>'Manage FormProperty', 'url'=>array('admin')),
);
?>

<h2>Proceso: <?php echo $process->name; ?></h2>

<?php echo Yii::app()->utility->getTabs(array('id'=>$process->id)); ?>

<div class="tab-content">
  <div class="tab-pane active">

  	<h3>Crear nuevo campo en formulario <?php echo $_form->name ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'process'=>$process, '_form'=>$_form)); ?>

	</div>
</div>

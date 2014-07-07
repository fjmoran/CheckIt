<?php
/* @var $this FormController */
/* @var $model Form */

$this->breadcrumbs=array(
	'Forms'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Form', 'url'=>array('index')),
	array('label'=>'Create Form', 'url'=>array('create')),
	array('label'=>'View Form', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Form', 'url'=>array('admin')),
);
?>

<h2>Proceso: <?php echo $process->name; ?></h2>

<?php echo Yii::app()->utility->getTabs(array('id'=>$process->id)); ?>

<div class="tab-content">
  <div class="tab-pane active">

  	<h3>Editar formulario</h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'process'=>$process)); ?>

	</div>
</div>
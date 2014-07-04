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

<ul class="nav nav-tabs" role="tablist">
  <li><a href="<?php echo Yii::app()->createUrl('process/view', array('id'=>$process->id))?>" role="tab">Modelador</a></li>
  <li class="active"><a href="#" role="tab">Formularios</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active">

  	<h3>Editar formulario</h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'process'=>$process)); ?>

	</div>
</div>
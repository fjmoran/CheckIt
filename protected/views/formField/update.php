<?php
/* @var $this FormFieldController */
/* @var $model FormField */

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
);
?>

<h2>Proceso: <?php echo $process->name; ?></h2>

<ul class="nav nav-tabs" role="tablist">
  <li><a href="<?php echo Yii::app()->createUrl('process/view', array('id'=>$process->id))?>" role="tab">Modelador</a></li>
  <li class="active"><a href="#" role="tab">Formularios</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active">

  	<h3>Modificar campo en formulario <?php echo $_form->name ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'process'=>$process, '_form'=>$_form)); ?>

	</div>
</div>
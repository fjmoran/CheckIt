<?php
/* @var $this ProjectController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Projects',
);

$this->menu=array(
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'Manage Project', 'url'=>array('admin')),
);
?>

<h2>Mis <?php echo Yii::app()->utility->getOption('projects_name'); ?></h2>

<?php if ($dataProvider): ?>
<div class="panel-group" id="accordion">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_myview',
)); ?>
</div>
<?php else: ?>
	<div class="alert alert-warning">Póngase en contacto con el administrador del sistema para que le asigne un cargo.</div>
<?php endif; ?>

<div class="row" style="position:absolute; bottom: 0; width: 100%;">
	<div class="col-md-12">
		<div class="well well-sm" style="font-size: 12px;">(*) Los textos en <span class="label label-warning">amarillo</span> son tareas que vencen los próximos 15 días, los textos en <span class="label label-danger">rojo</span> corresponden a tareas ya vencidas.</div>
	</div>
</div>
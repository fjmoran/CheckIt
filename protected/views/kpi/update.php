<?php
/* @var $this KpiController */
/* @var $model Kpi */

$this->breadcrumbs=array(
	'Kpis'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Kpi', 'url'=>array('index')),
	array('label'=>'Create Kpi', 'url'=>array('create')),
	array('label'=>'View Kpi', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Kpi', 'url'=>array('admin')),
);
?>

<h1>Editar KPI</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
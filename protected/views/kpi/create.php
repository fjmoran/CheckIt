<?php
/* @var $this KpiController */
/* @var $model Kpi */

$this->breadcrumbs=array(
	'Kpis'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Kpi', 'url'=>array('index')),
	array('label'=>'Manage Kpi', 'url'=>array('admin')),
);
?>

<h1>Crear KPI</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
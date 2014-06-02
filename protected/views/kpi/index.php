<?php
/* @var $this KpiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kpis',
);

$this->menu=array(
	array('label'=>'Create Kpi', 'url'=>array('create')),
	array('label'=>'Manage Kpi', 'url'=>array('admin')),
);
?>

<h1>Kpis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

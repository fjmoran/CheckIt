<?php
/* @var $this ProcessConnectorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Process Connectors',
);

$this->menu=array(
	array('label'=>'Create ProcessConnector', 'url'=>array('create')),
	array('label'=>'Manage ProcessConnector', 'url'=>array('admin')),
);
?>

<h1>Process Connectors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this ProcessTaskController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Process Tasks',
);

$this->menu=array(
	array('label'=>'Create ProcessTask', 'url'=>array('create')),
	array('label'=>'Manage ProcessTask', 'url'=>array('admin')),
);
?>

<h1>Process Tasks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

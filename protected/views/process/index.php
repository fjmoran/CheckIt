<?php
/* @var $this ProcessController */
/* @var $dataProvider CActiveDataProvider */
/*
$this->breadcrumbs=array(
	'Processes',
);

$this->menu=array(
	array('label'=>'Create Process', 'url'=>array('create')),
	array('label'=>'Manage Process', 'url'=>array('admin')),
);*/
?>

<h1>Processes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

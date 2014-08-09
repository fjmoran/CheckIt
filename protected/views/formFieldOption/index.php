<?php
/* @var $this FormFieldOptionController */
/* @var $dataProvider CActiveDataProvider */
/*
$this->breadcrumbs=array(
	'Form Field Options',
);

$this->menu=array(
	array('label'=>'Create FormFieldOption', 'url'=>array('create')),
	array('label'=>'Manage FormFieldOption', 'url'=>array('admin')),
);*/
?>

<h1>Form Field Options</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

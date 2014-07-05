<?php
/* @var $this FormPropertyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Form Properties',
);

$this->menu=array(
	array('label'=>'Create FormProperty', 'url'=>array('create')),
	array('label'=>'Manage FormProperty', 'url'=>array('admin')),
);
?>

<h1>Form Properties</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

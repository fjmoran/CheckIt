<?php
/* @var $this FormController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Forms',
);

$this->menu=array(
	array('label'=>'Create Form', 'url'=>array('create')),
	array('label'=>'Manage Form', 'url'=>array('admin')),
);
?>

<h1>Forms</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

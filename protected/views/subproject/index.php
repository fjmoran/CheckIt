<?php
/* @var $this SubprojectController */
/* @var $dataProvider CActiveDataProvider */

/*$this->breadcrumbs=array(
	'Subprojects',
);

$this->menu=array(
	array('label'=>'Create Subproject', 'url'=>array('create')),
	array('label'=>'Manage Subproject', 'url'=>array('admin')),
);*/
?>

<h1>Subprojects</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

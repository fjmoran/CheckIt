<?php
/* @var $this ProcessConnectorController */
/* @var $model ProcessConnector */
/*
$this->breadcrumbs=array(
	'Process Connectors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProcessConnector', 'url'=>array('index')),
	array('label'=>'Create ProcessConnector', 'url'=>array('create')),
	array('label'=>'View ProcessConnector', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProcessConnector', 'url'=>array('admin')),
);*/
?>

<h1>Update ProcessConnector <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this PositionController */
/* @var $model Position */

$this->breadcrumbs=array(
	'Positions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Position', 'url'=>array('index')),
	array('label'=>'Manage Position', 'url'=>array('admin')),
);
?>

<<<<<<< HEAD
<h1>Crear nuevo Cargo</h1>
=======
<h2>Crear Cargo</h2>
>>>>>>> FETCH_HEAD

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this OptionController */
/* @var $model Option */

$this->breadcrumbs=array(
	'Options'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Option', 'url'=>array('index')),
	array('label'=>'Create Option', 'url'=>array('create')),
	array('label'=>'View Option', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Option', 'url'=>array('admin')),
);
?>

<h1>Editar opción "<?php echo $model->name; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
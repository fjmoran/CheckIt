<?php
/* @var $this UserGroupController */
/* @var $model UserGroup */

$this->breadcrumbs=array(
	'User Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserGroup', 'url'=>array('index')),
	array('label'=>'Manage UserGroup', 'url'=>array('admin')),
);
?>

<h2>Agregar usuario a grupo <?php echo $group->name; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model,'group'=>$group)); ?>
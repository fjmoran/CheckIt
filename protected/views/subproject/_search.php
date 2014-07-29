<?php
/* @var $this SubprojectController */
/* @var $model Subproject */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array(
		//'enctype' => 'multipart/form-data',
		'role' => 'form',
	),
)); ?>

	<div class="form-group">
		<?php echo $form->label($model,'project_id'); ?>
		<?php $data = Project::model()->findAll(array('order' => 'name')); ?>
		<?php echo $form->dropDownList($model,'project_id', CHtml::listData($data, 'id', 'name'), array('class'=>'form-control')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
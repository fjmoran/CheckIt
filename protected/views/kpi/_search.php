<?php
/* @var $this KpiController */
/* @var $model Kpi */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subproject_id'); ?>
		<?php echo $form->textField($model,'subproject_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'frequency'); ?>
		<?php echo $form->textField($model,'frequency',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'base_date'); ?>
		<?php echo $form->textField($model,'base_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'goal_date'); ?>
		<?php echo $form->textField($model,'goal_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'base_value'); ?>
		<?php echo $form->textField($model,'base_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'goal_value'); ?>
		<?php echo $form->textField($model,'goal_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'unit'); ?>
		<?php echo $form->textField($model,'unit',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'real_value'); ?>
		<?php echo $form->textField($model,'real_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'limit_red'); ?>
		<?php echo $form->textField($model,'limit_red'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'limit_yellow'); ?>
		<?php echo $form->textField($model,'limit_yellow'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'limit_green'); ?>
		<?php echo $form->textField($model,'limit_green'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'position_id'); ?>
		<?php echo $form->textField($model,'position_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
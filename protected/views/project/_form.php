<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		//'enctype' => 'multipart/form-data',
		'role' => 'form',
		'autocomplete' => 'off',
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<?php echo $form->labelEx($model,'name'); ?>
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'position_id'); ?>
			<?php $data = Position::model()->findAll(array('order' => 'name')); ?>
			<?php echo $form->dropDownList($model,'position_id', CHtml::listData($data, 'id', 'name'), array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'position_id'); ?>
		</div>
	</div>
</div>

<div class="form-group buttons">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
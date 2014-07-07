<?php
/* @var $this FormFieldOptionController */
/* @var $model FormFieldOption */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'form-field-option-form',
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
		</div>
	</div>

	<div class="row">	
		<div class="col-md-6">
			<div class="form-group">
				<?php echo $form->labelEx($model,'position'); ?>
				<?php echo $form->textField($model,'position', array('class'=>'form-control')); ?>
				<?php echo $form->error($model,'position'); ?>
			</div>
		</div>
	</div>

	<?php echo $form->hiddenField($model,'form_field_id'); ?>

	<div class="form-group buttons">
		<a href="<?php echo Yii::app()->createUrl('formField/admin', array('formField_id'=>$formField->id));?>" class="btn btn-default">Cancelar</a>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
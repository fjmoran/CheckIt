<?php
/* @var $this FormController */
/* @var $model Form */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'form-form',
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
		<div class="col-md-6">

		</div>
	</div>

	<?php echo $form->hiddenField($model,'process_id'); ?>

	<div class="form-group buttons">
		<a href="<?php echo Yii::app()->createUrl('form/admin', array('process_id'=>$process->id));?>" class="btn btn-default">Cancelar</a>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
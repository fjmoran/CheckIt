<?php
/* @var $this ProcessTaskController */
/* @var $model ProcessTask */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-form',
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

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="myModalLabel">Modificar Actividad</h4>
</div>
<div class="modal-body">

	<?php echo $form->errorSummary($model); ?>

	<div class="row">	
		<div class="col-md-6">
			<?php echo $form->labelEx($model,'name'); ?>
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>
	</div>

</div>
<div class="modal-footer">
	<button type="button" class="btn btn-danger pull-left">Eliminar</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', array('class'=>'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>


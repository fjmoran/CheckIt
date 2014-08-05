<?php
/* @var $this TaskController */
/* @var $model Task */
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

			<?php echo $form->hiddenField($model,'id'); ?>

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Ingresar KPI</h4>
			</div>
			<div class="modal-body">

				<?php echo $form->errorSummary($model); ?>

				<div class="row">

					<div class="col-md-6">
						<p><strong>KPI:</strong> </p>
					</div>
					<div class="col-md-6">
						<p><?php echo $kpi->name; ?> </p>
					</div>

					<div class="col-md-6">
						<p><strong><?php echo Yii::app()->utility->getOption('subproject_name');?>:</strong> </p>
					</div>
					<div class="col-md-6">
						<p><?php echo $kpi->subproject->name; ?> </p>
					</div>

					<div class="col-md-6">
						<p><strong>Valor actual (<?php echo $kpi->unit; ?>):</strong> </p>
					</div>
					<div class="col-md-6">
						<p><?php echo $form->textField($model,'value',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?> </p>
					</div>

					</div>

				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<?php echo CHtml::submitButton('Modificar', array('class'=>'btn btn-primary')); ?>
			</div>

<?php $this->endWidget(); ?>

<script>
$(document).ready(function(){
	$('#myModal').on('hidden.bs.modal', function () {
		$(this).removeData();
	});
});
</script>

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
				<h4 class="modal-title" id="myModalLabel">Modificar <?php echo Yii::app()->utility->getOption('task_name'); ?></h4>
			</div>
			<div class="modal-body">

				<?php echo $form->errorSummary($model); ?>

				<div class="row">	

					<div class="col-md-4">
						<p><strong><?php echo Yii::app()->utility->getOption('task_name');?>:</strong></p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->name; ?></p>
					</div>	

					<div class="col-md-4">
						<p><strong>Estado actual:</strong></p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->statusText; ?></p>
					</div>	

				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<?php if ($model->status==0):?>
					<?php echo CHtml::submitButton('Terminar', array('class'=>'btn btn-success')); ?>
				<?php else: ?>
					<?php echo CHtml::submitButton('Abrir', array('class'=>'btn btn-danger')); ?>
				<?php endif; ?>
			</div>

<?php $this->endWidget(); ?>


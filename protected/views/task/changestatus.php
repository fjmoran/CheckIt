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

					<div class="col-md-4">
						<p><strong>Comentarios</strong> </p>
					</div>
					<div class="col-md-8">
						<p><?php echo $form->textArea($model,'comments',array('cols'=>6,'size'=>60,'maxlength'=>255,'class'=>'form-control')); ?></p>
					</div>

				</div>

				<?php 

				$show_close = 1;

				if ($model->status==0):
					$subtasks = $model->children()->findAll();
					if ($subtasks):
				?>

				<div class="row">
					<div class="col-md-12">

						<h4><?php echo Yii::app()->utility->getOption('tasks_name')?> dependientes</h4>

						<table class="table table-condensed" style="font-size:small;">
							<tr>
								<th style="width: 26%;">Nombre</th>
								<th style="width: 8%;">Fecha término</th>
								<th style="width: 10%;">Estado</th>
								<th style="width: 15%;">Responsable</th>
							</tr>

					<?php foreach ($subtasks as $stask): ?>
						<?php if ($stask->status==0) $show_close=0; ?>
							<tr>
								<td><?php echo $stask->name; ?></td>
								<td><?php echo $stask->due_date; ?></td>
								<td><?php echo $stask->statusText; ?></td>
								<td><?php echo $stask->inCharge; ?></td>
							</tr>
					<? endforeach; ?>

						</table>

					</div>
				</div>

				<?php endif; ?>
			<?php endif; ?>

			<?php

			$show_open = 1;
			if ($model->status==1) {
				if ($model->root && $model->root!=$model->id) {
					$p = Task::model()->findByPk($model->root);
					if ($p->status==1) $show_open=0;
				}
			}

			?>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<?php if ($model->status==0 && $show_close):?>
					<?php echo CHtml::submitButton('Terminar', array('class'=>'btn btn-success')); ?>
				<?php elseif ($model->status==1 && $show_open): ?>
					<?php echo CHtml::submitButton('Abrir', array('class'=>'btn btn-danger')); ?>
				<?php endif; ?>
			</div>

<?php $this->endWidget(); ?>


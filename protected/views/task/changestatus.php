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
				if ($model->status==0):
					$subtask = $task->children()->findAll();
					if ($subtask):
				?>

				<div class="row">
					<div class="col-md-12">

						<h4>KPI dependientes</h4>

						<table class="table table-condensed" style="font-size:small;">
							<tr>
								<th style="width: 26%;">KPI</th>
								<th style="width: 8%;">Último ingreso</th>
								<th style="width: 10%;">Valor</th>
								<th style="width: 15%;">Peso</th>
								<th style="width: 15%;">Responsable</th>
							</tr>

					<?php foreach ($subkpi as $skpi): 
						//obtenemos el ultimo dato
						$kpidatas = $skpi->kpiDatas;
						$date = '-';
						$value = '-';
						if ($kpidatas) {
							$kpidata = $kpidatas[0];
							$date = $kpidata->created;
							$value = $kpidata->value;
						}
					?>
							<tr>
								<td><?php echo $skpi->name; ?></td>
								<td><?php echo $date; ?></td>
								<td><?php echo $value; ?></td>
								<td><?php echo $skpi->weight; ?></td>
								<td><?php echo $skpi->inCharge; ?></td>
							</tr>
					<? endforeach; ?>

						</table>

					</div>
				</div>

				<?php endif; ?>
			<?php endif; ?>

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


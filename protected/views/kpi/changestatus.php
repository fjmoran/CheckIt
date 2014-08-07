<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $form CActiveForm */
?>

<?php 
$no_value = 0; 
if (!$model->value && !$model->isNewRecord) {
	$no_value = 1;
} 
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
		'validateOnSubmit'=>true,
		'afterValidate'=>'js:$.yii.fix.ajaxSubmit.afterValidate',
	),
)); ?>

			<?php echo $form->hiddenField($model,'id'); ?>

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">KPI - <?php echo $kpi->name; ?></h4>
			</div>
			<div class="modal-body">

				<?php echo $form->errorSummary($model); ?>

				<div class="row">
					<div class="col-md-4">
						<p><strong>Forma de Cálculo</strong> </p>
					</div>
					<div class="col-md-8">
						<div class="panel panel-default">
						  <div class="panel-body">
						    <?php echo $kpi->calculation; ?>
						  </div>
						</div>
					</div>					

					<div class="col-md-4">
						<p><strong>Valor (<?php echo $kpi->unit; ?>) *</strong> </p>
					</div>
					<div class="col-md-8">
						<p><?php echo $form->textField($model,'value',array('size'=>60,'maxlength'=>255,'class'=>'form-control','style'=>$no_value?'background-color:#aaa;':'','readonly'=>$no_value?true:false)); ?></p>
						<p><input type="checkbox" name="KpiData[no_value]" id="KpiData_no_value" <?php echo $no_value?'checked':''?>> No considerar</p>
					</div>

					<div class="col-md-4">
						<p><strong>Comentarios</strong> </p>
					</div>
					<div class="col-md-8">
						<p><?php echo $form->textArea($model,'comments',array('rows'=>5,'size'=>60,'maxlength'=>255,'class'=>'form-control')); ?></p>
					</div>

				</div>

				<?php 
				if ($model->isNewRecord):
					$subkpi = $kpi->children()->findAll();
					if ($subkpi):
				?>

				<div class="row">
					<div class="col-md-12">

						<h4>KPI dependientes</h4>

						<table class="table table-condensed" style="font-size:small;">
							<tr>
								<th style="width: 35%;">KPI</th>
								<th style="width: 17%;">Último ingreso</th>
								<th style="width: 12%;">Valor</th>
								<th style="width: 12%;">Peso</th>
								<th style="width: 24%;">Responsable</th>
							</tr>

					<?php foreach ($subkpi as $skpi): 
						//obtenemos el ultimo dato
						$kpidatas = $skpi->kpiDatas;
						$date = '-';
						$value = '-';
						if ($kpidatas) {
							$kpidata = $kpidatas[0];
							$date = $kpidata->period_end;
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
				<?php echo CHtml::submitButton($model->isNewRecord?'Ingresar':'Modificar', array('class'=>'btn btn-primary')); ?>
			</div>

<?php $this->endWidget(); ?>

<script>
$("#task-form").submit(function(event){
	if (! $("#KpiData_no_value").is(":checked")) {
		if (! $("#KpiData_value").val()) {
			event.preventDefault();
			alert('Error: debe ingresar un valor.');
		}
		else {
			var intRegex = /^\d+$/;
			var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
			//var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
			if(!intRegex.test($("#KpiData_value").val()) && !floatRegex.test($("#KpiData_value").val())) {
				event.preventDefault();
				alert('Error: valor debe ser un número.');
			}
		}
	}
});
$("#KpiData_no_value").click(function () {
	if ($("#KpiData_no_value").is(":checked")) {
		$("#KpiData_value")
			.attr("disabled", "disabled")
			.css("background-color", "#ccc");
		$("#referido").val("");
	}
	else {
		$("#KpiData_value")
			.removeAttr("disabled")
			.css("background-color", "white");
	}
});
</script>
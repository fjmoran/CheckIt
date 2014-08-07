

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">KPI - <?php echo $model->name; ?></h4>
			</div>
			<div class="modal-body">


				<div class="row">
					<div class="col-md-4">
						<p><strong>Forma de Cálculo</strong> </p>
					</div>
					<div class="col-md-8">
						    <?php echo $model->calculation; ?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<p><strong>Valor actual (<?php echo $model->unit; ?>) *</strong> </p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->lastDataValue; ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<p><strong>Fecha Base / Meta</strong> </p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->base_date; ?> / <?php echo $model->goal_date; ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<p><strong>Valor Base / Meta</strong> </p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->base_value; ?> / <?php echo $model->goal_value; ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<p><strong>Responsable</strong> </p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->inCharge; ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<p><strong>Frecuencia de Actualización</strong> </p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->updateFrequencyText; ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<p><strong>Frecuencia de Revisión</strong> </p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->reviewFrequencyText; ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<p><strong>Forma de Medición</strong> </p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->measuringText; ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<p><strong>Función de Cálculo</strong> </p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->functionText; ?></p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<p><strong>Peso</strong> </p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->weight; ?></p>
					</div>
				</div>				

				<div class="row">
					<div class="col-md-4">
						<p><strong>Próximo Vencimiento</strong> </p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->next_due_date; ?></p>
					</div>
				</div>

				<?php 
					$subkpi = $model->children()->findAll();
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

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>


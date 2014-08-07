			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><?php echo Yii::app()->utility->getOption('task_name'); ?> - <?php echo $model->name; ?></h4>
			</div>
			<div class="modal-body">

				<div class="row">	
					<div class="col-md-4">
						<p><strong>Estado actual</strong></p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->statusText; ?></p>
					</div>	
				</div>

				<div class="row">	
					<div class="col-md-4">
						<p><strong>Fecha Inicio</strong></p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->start_date; ?></p>
					</div>	
				</div>

				<div class="row">	
					<div class="col-md-4">
						<p><strong>Fecha Término</strong></p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->due_date; ?></p>
					</div>	
				</div>

				<div class="row">	
					<div class="col-md-4">
						<p><strong>Fecha Finalizada</strong></p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->end_date; ?></p>
					</div>	
				</div>

				<div class="row">	
					<div class="col-md-4">
						<p><strong>Responsable</strong></p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->inCharge; ?></p>
					</div>	
				</div>

				<div class="row">	
					<div class="col-md-4">
						<p><strong>Comentarios</strong> </p>
					</div>
					<div class="col-md-8">
						<p><?php echo $model->comments; ?></p>
					</div>
				</div>

				<?php 

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

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
<?php if ($kpis):?>

<h2>KPI por Hacer</h2>

			<table class="table table-condensed" style="font-size:small;">
				<tr>
					<th style="width: 26%;">KPI</th>
					<th style="width: 26%;">Objetivo Estratégico</th>
					<th style="width: 8%;">Meta</th>
					<th style="width: 17%;">Responsable</th>
					<th style="width: 10%;">Periodicidad</th>
					<th style="width: 15%;">Fecha</th>
					<th style="width: 7%; text-align: center;">Acciones</th>
				</tr>

	<?php foreach ($kpis as $kpi):?>

				<tr>
					<td>
						<a title="Editar" data-toggle="modal" data-target="#myModal" style="color: #333;" 
						href="<?php echo Yii::app()->createUrl('kpi/changestatus',array('id'=>$kpi->id)); ?>">					
						<?php echo $kpi->name; ?>
						</a>
					</td>
					<td><?php echo $kpi->subproject->name?></td>
					<td><?php echo $kpi->goal_value?></td>
					<td><?php echo $kpi->inCharge?></td>
					<td><?php echo $kpi->updateFrequencyText?></td>
					<td <?php if (strtotime($kpi->next_due_date) < time()) {echo 'style="color: red;"';} else {echo 'style="color: green;"';}?>><?php echo $kpi->next_due_date?></td>
					<td>
						<a title="Editar" data-toggle="modal" data-target="#myModal" 
						href="<?php echo Yii::app()->createUrl('kpi/changestatus',array('id'=>$kpi->id)); ?>">
							<i class="fa fa-edit grid-icon"></i>
						</a>
					</td>
				</tr>

	<?php endforeach;?>

			</table>

<?php endif;?>


<?php if ($tasks):?>

<h2><?php echo Yii::app()->utility->getOption('tasks_name'); ?> por Hacer</h2>

			<table class="table table-condensed" style="font-size:small;">
				<tr>
					<th style="width: 26%;">Tarea</th>
					<th style="width: 26%;">Objetivo Estratégico</th>
					<th style="width: 17%;">Responsable</th>
					<th style="width: 15%;">Fecha Inicio</th>
					<th style="width: 15%;">Fecha Término</th>
					<th style="width: 7%; text-align: center;">Acciones</th>
				</tr>

	<?php foreach ($tasks as $task):?>

				<tr>
					<td>
						<a title="Editar" data-toggle="modal" data-target="#myModal" style="color: #333;" 
						href="<?php echo Yii::app()->createUrl('task/changestatus',array('id'=>$task->id)); ?>">					
						<?php echo $task->name; ?>
						</a>
					</td>
					<td><?php echo $task->subproject->name?></td>
					<td><?php echo $task->inCharge?></td>
					<td><?php echo $task->start_date?></td>
					<td <?php if (strtotime($task->due_date) < time()) {echo 'style="color: red;"';}?>><?php echo $task->due_date?></td>
					<td>
						<a title="Editar" data-toggle="modal" data-target="#myModal" 
						href="<?php echo Yii::app()->createUrl('task/changestatus',array('id'=>$task->id)); ?>">
						<i class="fa fa-edit grid-icon"></i>
						</a>
					</td>
				</tr>

	<?php endforeach;?>

			</table>

<?php endif;?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>


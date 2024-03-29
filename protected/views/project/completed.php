<?php if ($kpidata):?>

<h2>Últimos KPI terminados</h2><br>

			<table class="table table-condensed" style="font-size:small;">
				<tr>
					<th style="width: 26%;">KPI</th>
					<th style="width: 26%;"><?php echo Yii::app()->utility->getOption('subproject_name'); ?></th>
					<th style="width: 8%;">Meta</th>
					<th style="width: 10%;">Periodicidad</th>
					<th style="width: 15%;">Fecha</th>
					<th style="width: 15%;">Valor</th>
					<th style="width: 7%; text-align: center;">Acciones</th>
				</tr>

	<?php foreach ($kpidata as $kdata):?>

		<?php $kpi = $kdata->kpi; ?>
				<tr>
					<td>
						<a title="Editar" data-toggle="modal" data-target="#myModal" style="color: #333;" 
						href="<?php echo Yii::app()->createUrl('kpi/changestatus',array('id'=>$kdata->id)); ?>">					
						<?php echo $kpi->name; ?>
						</a>
					</td>
					<td><?php echo $kpi->subproject->name?></td>
					<td><?php echo $kpi->goal_value?></td>
					<td><?php echo $kpi->updateFrequencyText?></td>
					<td><?php echo $kdata->period_end; ?></td>
					<td><?php echo $kdata->value?$kdata->value:'-'; ?></td>
					<td>
						<a title="Editar" data-toggle="modal" data-target="#myModal" 
						href="<?php echo Yii::app()->createUrl('kpi/changestatus',array('id'=>$kdata->id)); ?>">
							<i class="fa fa-edit grid-icon"></i>
						</a>
					</td>
				</tr>

	<?php endforeach;?>

			</table>

<?php endif;?>


<?php if ($tasks):?>

<h2>Últimos <?php echo Yii::app()->utility->getOption('tasks_name'); ?> terminados</h2><br>

			<table class="table table-condensed" style="font-size:small;">
				<tr>
					<th style="width: 26%;"><?php echo Yii::app()->utility->getOption('task_name'); ?></th>
					<th style="width: 26%;"><?php echo Yii::app()->utility->getOption('subproject_name'); ?></th>
					<th style="width: 17%;">Responsable</th>
					<th style="width: 15%;">Fecha Inicio</th>
					<th style="width: 15%;">Fecha Término</th>
					<th style="width: 7%; text-align: center;">Acciones</th>
				</tr>

	<?php foreach ($tasks as $task):?>

				<tr>
					<td>
						<a title="Editar" data-toggle="modal" data-target="#myModal" style="color: #333;" 
						href="<?php echo Yii::app()->createUrl('task/changestatus',array('id'=>$task->id, 'page'=>'1')); ?>">					
						<?php echo $task->name; ?>
						</a>
					</td>
					<td><?php echo $task->subproject->name?></td>
					<td><?php echo $task->inCharge?></td>
					<td><?php echo $task->start_date?></td>
					<td><?php echo $task->due_date?></td>
					<td>
						<a title="Editar" data-toggle="modal" data-target="#myModal" 
						href="<?php echo Yii::app()->createUrl('task/changestatus',array('id'=>$task->id, 'page'=>'1')); ?>">
						<i class="fa fa-edit grid-icon"></i>
						</a>
					</td>
				</tr>

	<?php endforeach;?>

			</table>

<?php endif;?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
	</div>
</div>

<?php
Yii::app()->clientScript->registerScript('clear_modal','
	$("body").on("hidden.bs.modal", "#myModal", function () {
		$(this).removeData();
	});
', CClientScript::POS_READY);
?>
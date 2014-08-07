<?php
/* @var $this ProjectController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Projects',
);

$this->menu=array(
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'Manage Project', 'url'=>array('admin')),
);
?>

<h2>Mi Equipo</h2>

<?php foreach ($projects as $project):?>
<h3 style="padding-bottom:20px;"><?php echo $project->name; ?></h3>

	<!--  KPI  -->

	<?php $i=0; foreach($project->subprojects as $subproject): ?>

		<?php if (in_array($subproject->id, $subproject_kpi_ids)): ?>

		<?php if ($i==0):?>
			<table class="table table-condensed" style="font-size:small;">
				<tr>
					<th style="width: 26%;">Objetivo Estratégico</th>
					<th style="width: 26%;">KPI</th>
					<th style="width: 8%;">Meta</th>
					<th style="width: 8%;">Actual</th>
					<th style="width: 17%;">Responsable</th>
					<th style="width: 8%;">Estado</th>
					<th style="width: 7%; text-align: center;">Ver</th>
				</tr>
		<?php endif;?>

			<?php 
			/*$j=0;
			foreach ($kpis[$subproject->id] as $kpi):
				$j++;
				foreach ($kpi->children()->findAll() as $subkpi):
					$j++;
				endforeach;		
			endforeach;*/ ?>

		<tr>
			<td rowspan="<?php echo count($kpis[$subproject->id])+1;?>"><?php echo $subproject->name?></td>
		</tr>

			<?php foreach ($kpis[$subproject->id] as $kpi):?>

				<?php display_kpi($kpi);?>

				<?php /*foreach ($kpi->children()->findAll() as $subkpi):?>
					<?php display_kpi($subkpi, 1); ?>
				<?php endforeach;*/?>
		
			<?php endforeach; ?>

		<?php endif;?>
	<?php $i++; endforeach;?>

	<?php if ($i>0):?>
		</table>
	<?php endif;?>

	<!--  TASKS  -->

	<?php $i=0; foreach($project->subprojects as $subproject): ?>

		<?php if (in_array($subproject->id, $subproject_task_ids)): ?>

		<?php if ($i==0):?>
			<table class="table table-condensed" style="font-size:small;">
				<tr>
					<th style="width: 23%;">Objetivo Estratégico</th>
					<th style="width: 23%;"><?php echo Yii::app()->utility->getOption('task_name'); ?></th>
					<th style="width: 12%;">Fecha inicio</th>
					<th style="width: 12%;">Fecha término</th>
					<th style="width: 15%;">Responsable</th>				
					<th style="width: 8%;">Estado</th>
					<th style="width: 7%; text-align: center;">Ver</th>
				</tr>
		<?php endif;?>

		<tr>
			<td rowspan="<?php echo count($tasks[$subproject->id])+1;?>"><?php echo $subproject->name?></td>
		</tr>

			<?php foreach ($tasks[$subproject->id] as $task):?>

				<?php display_task($task);?>

			<?php endforeach; ?>

		<?php endif;?>
	<?php $i++; endforeach;?>

	<?php if ($i>0):?>
		</table>
	<?php endif;?>

<? endforeach;?>


<?php function display_kpi($kpi, $ischild=0) {?>
			<tr <?php if ($ischild) echo "class='info'"; ?>>
				<td>
					<?php /*if (!$ischild): ?>
						<a title="Editar" data-toggle="modal" data-target="#myModal" style="color: #333;" 
						href="<?php echo Yii::app()->createUrl('kpi/changestatus',array('id'=>$kpi->id)); ?>">					
						<?php echo $kpi->name; ?>
						</a>
					<?php else:*/ ?>
						<?php echo $kpi->name; ?>
					<?php //endif; ?>
				</td>
				<!--td><?php echo $kpi->base_value; ?></td-->
				<td>
					<?php echo $kpi->goal_value; ?>
				</td>
				<td>
					<?php
						$lastdata = $kpi->lastDataValue; 
						echo $lastdata?$lastdata:'-'; ?>
				</td>
				<td>
					<?php echo $kpi->inCharge; ?>
				</td>				
				<td>
					<?php 
						$color = $kpi->statusColor;
						if ($color == 1) echo '<span class="label label-danger">Rojo</span>';
						if ($color == 2) echo '<span class="label label-warning">Amarillo</span>';
						if ($color == 3) echo '<span class="label label-success">Verde</span>';
					?>
				</td>
				<td style="text-align: center;">
					<?php /*if (!$ischild): */?>
					<a title="Editar" data-toggle="modal" data-target="#myModal" 
					href="<?php echo Yii::app()->createUrl('kpi/view',array('id'=>$kpi->id)); ?>">
						<i class="fa fa-eye grid-icon"></i>
					</a>
					<?php /* else: ?>
						<i class="fa fa-ban grid-icon" style="color:#ccc;"></i>					
					<?php endif;*/ ?>
				</td>
			</tr>		
<?php }?>

<?php function display_task($task) {?>
			<tr>
				<td>
					<?php /*if ($task->department_id == $department_id): ?>
						<a title="Editar" data-toggle="modal" data-target="#myModal" style="color: #333;" 
						href="<?php echo Yii::app()->createUrl('task/changestatus',array('id'=>$task->id)); ?>">					
						<?php echo $task->name; ?>
						</a>
					<?php else:*/ ?>
						<?php echo $task->name; ?>
					<?php //endif; ?>
				</td>
				<td><?php echo $task->start_date; ?></td>
				<td>
					<?php echo $task->due_date; ?>
				</td>
				<td>
					<?php echo $task->inCharge; ?>
				</td>				
				<td>
					<?php 
						$interval = date_diff(new Datetime(date('Y-m-d')), new Datetime($task->due_date)); 
						$datediff = (int)$interval->format("%R%a");
					?>
					<?php if ($task->status == 1):?>
						<span class="label label-success">Terminado</span>
					<?php elseif ($datediff < 0): ?>
						<span class="label label-danger">Vencido</span>
					<?php elseif ($datediff < 16): ?>
						<span class="label label-warning">Vence en <?=$datediff?> días</span>
					<?php else: ?>
						<span class="label label-info">Pendiente</span>
					<?php endif; ?>
				</td>
				<td style="text-align: center;">
					<?php /*if ($task->department_id == $department_id):*/ ?>
					<a title="Ver" data-toggle="modal" data-target="#myModal" 
					href="<?php echo Yii::app()->createUrl('task/view',array('id'=>$task->id)); ?>">
						<i class="fa fa-eye grid-icon"></i>
					</a>
					<?php /*else: ?>
						<i class="fa fa-ban grid-icon" style="color:#ccc;"></i>					
					<?php endif; */?>
				</td>
			</tr>	
<?php } ?>

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

<?php /*if ($dataProvider): ?>
<div class="panel-group" id="accordion">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_myview',
)); ?>
</div>
<?php else: ?>
	<div class="alert alert-warning">Póngase en contacto con el administrador del sistema para que le asigne responsabilidades.</div>
<?php endif; ?>

<div class="row" style="position:absolute; bottom: 0; width: 100%;">
	<div class="col-md-12">
		<div class="well well-sm" style="font-size: 12px;">(*) Los textos en <span class="label label-warning">amarillo</span> son tareas que vencen los próximos 15 días, los textos en <span class="label label-danger">rojo</span> corresponden a tareas ya vencidas, los KPI son medidos según los limites definidos para cada uno.</div>
	</div>
</div>
<?php */ ?>
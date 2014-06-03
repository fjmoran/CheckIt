<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('index')),
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'Update Project', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Project', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Project', 'url'=>array('admin')),
);
?>

<h2 style="padding-bottom:20px;"><?php echo Yii::app()->utility->getOption('project_name').": ".$model->name; ?></h2>

<?php 

$position_id = User::model()->find('id='.Yii::app()->user->id)->position_id;

foreach ($model->subprojects as $subproject) { 
?>

	<div class="panel panel-default">

		<div class="panel-heading">
			<h2 class="panel-title"><? echo Yii::app()->utility->getOption('subproject_name'); ?> - <?php echo $subproject->name;?></h2>
		</div>

		<div class="panel-body">

		</div>

		<?php if ($subproject->kpis): ?>
		<table class="table table-condensed">
			<tr>
				<th style="width: 24%;">KPI</th>
				<th style="width: 12%;">Base</th>
				<th style="width: 12%;">Meta</th>
				<th style="width: 12%;">Actual</th>
				<th style="width: 15%;">Responsable</th>
				<th style="width: 15%;">Estado</th>
				<th style="width: 10%; text-align: center;">Acciones</th>
			</tr>
		<?php foreach ($subproject->kpis as $kpi) { ?>
			<tr>
				<td>
					<a title="Editar" data-toggle="modal" data-target="#myModal" style="color: #333;" 
					href="<?php echo Yii::app()->createUrl('kpi/changestatus',array('id'=>$kpi->id)); ?>">					
					<?php echo $kpi->name; ?>
					</a>
				</td>
				<td><?php echo $kpi->base_value; ?></td>
				<td>
					<?php echo $kpi->goal_value; ?>
				</td>
				<td>
					<?php echo $kpi->real_value; ?>
				</td>
				<td>
					<?php if ($kpi->position) echo $kpi->position->name; ?>
				</td>				
				<td>
					<?php if ($kpi->base_value < $kpi->goal_value) {
						switch($kpi->real_value){
							case ($kpi->real_value >= $kpi->limit_green): ?>
								<span class="label label-success">Verde</span>
								<?php break;
							case ($kpi->real_value >= $kpi->limit_yellow): ?>
								<span class="label label-warning">Amarillo</span>
								<?php break;
							default: ?>
								<span class="label label-danger">Rojo</span>
								<?php break;
						}
					 } else {
						switch($kpi->real_value){
							case ($kpi->real_value <= $kpi->limit_green): ?>
								<span class="label label-success">Verde</span>
								<?php break;
							case ($kpi->real_value <= $kpi->limit_yellow): ?>
								<span class="label label-warning">Amarillo</span>
								<?php break;
							default: ?>
								<span class="label label-danger">Rojo</span>
								<?php break;
						}
					} ?>
				</td>
				<td style="text-align: center;">
					<?php if ($kpi->position_id == $position_id): ?>
					<a title="Editar" data-toggle="modal" data-target="#myModal" 
					href="<?php echo Yii::app()->createUrl('kpi/changestatus',array('id'=>$kpi->id)); ?>">
						<i class="fa fa-edit grid-icon"></i>
					</a>
					<?php endif; ?>
				</td>
			</tr>		<? } ?>
		</table>
		<?php endif; ?>	
		<?php if($subproject->tasks && $subproject->kpis){ ?>
			<br><br>
		<?php } ?>

		<?php if ($subproject->tasks): ?>
		<table class="table table-condensed">
			<tr>
				<th style="width: 32%;"><?php echo Yii::app()->utility->getOption('task_name'); ?></th>
				<th style="width: 14%;">Fecha inicio</th>
				<th style="width: 14%;">Fecha término</th>
				<th style="width: 15%;">Responsable</th>				
				<th style="width: 15%;">Estado</th>
				<th style="width: 10%; text-align: center;">Accciones</th>
			</tr>
		<?php foreach ($subproject->tasks as $task) { ?>
			<tr>
				<td>
					<a title="Editar" data-toggle="modal" data-target="#myModal" style="color: #333;" 
					href="<?php echo Yii::app()->createUrl('task/changestatus',array('id'=>$task->id)); ?>">					
					<?php echo $task->name; ?>
					</a>
				</td>
				<td><?php echo $task->start_date; ?></td>
				<td>
					<?php echo $task->due_date; ?>
				</td>
				<td>
					<?php if ($task->position) echo $task->position->name; ?>
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
					<?php if ($task->position_id == $position_id): ?>
					<a title="Editar" data-toggle="modal" data-target="#myModal" 
					href="<?php echo Yii::app()->createUrl('task/changestatus',array('id'=>$task->id)); ?>">
						<i class="fa fa-edit grid-icon"></i>
					</a>
					<?php else: ?>
						<i class="fa fa-ban grid-icon" style="color:#ccc;"></i>					
					<?php endif; ?>
				</td>
			</tr>
		<? } ?>
		</table>
		<?php endif; ?>	
	</div>
	
<? } ?>

	<div class="row">
		<div class="col-md-12" style="padding-bottom:15px;">
			<a href="javascript:history.back()" class="btn btn-default pull-right" role="button">Volver</a>
		</div>
	</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>

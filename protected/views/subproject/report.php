<?php
$this->breadcrumbs=array(
	'Reportes'=>array('site/report'),
	Yii::app()->utility->getOption('project_name').': '.$model->project->name => array('project/report', 'id'=>$model->project->id),
	Yii::app()->utility->getOption('subproject_name').': '.$model->name,
);

// menu
$this->menu[] = array('label'=>'<i class="fa fa-chevron-left fa-lg fa-fw"></i> '.Yii::app()->utility->getOption('project_name').': '.$model->project->name, 'url'=>array('/project/report', 'id'=>$model->project->id));
$this->menu[] = array('label'=>'<i class="fa fa-file fa-lg fa-fw"></i> '.Yii::app()->utility->getOption('subproject_name').': '.$model->name, 'url'=>array('/subproject/report', 'id'=>$model->id));
//perspectivas
/*$sps = Subproject::model()->findAllByAttributes(array('project_id'=>$model->id));
foreach ($sps as $sp) {
	$this->menu[] = array('label'=>'<i class="fa fa-chevron-right fa-lg fa-fw"></i> '.$sp->name, 'url'=>array('/subproject/report', 'id'=>$sp->id));
}*/
?>

<div class="row">
	<div class="col-md-11">
		<h2><?php echo Yii::app()->utility->getOption('subproject_name');?>: <?php echo $model->name?></h2>
	</div>
	<!-- div class="col-md-1" style="padding-top: 20px;">
		<a href="<?php echo Yii::app()->createUrl('project/report', array('id'=>$model->project->id)); ?>" class="btn btn-primary btn-sm pull-right"><i class="fa fa-arrow-left"></i> Volver</a>
	</div -->
</div>
<br>

<?php if ($kpis) :?>

<div class="row">
	<div class="col-md-12">

		<h3>KPI</h3>

			<table class="table table-condensed" style="font-size:small;">
				<tr>
					<th style="width: 33%;">KPI</th>
					<th style="width: 8%;">Meta</th>
					<th style="width: 8%;">Actual</th>
					<th style="width: 8%;">Peso</th>
					<th style="width: 17%;">Responsable</th>
					<th style="width: 8%;">Estado</th>
				</tr>			

<?php foreach ($kpis as $kpi) : ?>

	<?php display_kpi($kpi);?>

<?php endforeach; ?>

		</table>

	</div>	
</div>

<?php endif;?>

<?php if ($tasks): ?>

		<h3><?php echo Yii::app()->utility->getOption('tasks_name'); ?></h3>

			<table class="table table-condensed" style="font-size:small;">
				<tr>
					<th style="width: 23%;"><?php echo Yii::app()->utility->getOption('task_name'); ?></th>
					<th style="width: 12%;">Fecha inicio</th>
					<th style="width: 12%;">Fecha término</th>
					<th style="width: 15%;">Responsable</th>				
					<th style="width: 8%;">Estado</th>
				</tr>

	<?php foreach ($tasks as $task):?>

	<?php display_task($task);?>

	<?php endforeach; ?>

			</table>

<?php endif; ?>


<?php function display_kpi($kpi, $ischild=0) { ?>
			<tr>
				<td>
					<?php echo str_repeat('&nbsp;&nbsp;', $ischild); ?>
					<i class="fa fa-circle<?php echo ($ischild%2 == 1)?'-o':''?>" style="font-size:8px"></i> <?php echo $kpi->name; ?>
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
					<?php echo $kpi->weight; ?>
				</td>				
				<td>
					<?php echo $kpi->inCharge; ?>
				</td>				
				<td>
					<?php 
						$compliance = round($kpi->compliance);
						$color = Yii::app()->utility->getStatusColor($compliance);
						if ($color == 1) echo '<span class="label label-danger">'.$compliance.' %</span>';
						if ($color == 2) echo '<span class="label label-warning">'.$compliance.' %</span>';
						if ($color == 3) echo '<span class="label label-success">'.$compliance.' %</span>';
					?>
				</td>
			</tr>

		<?php foreach ($kpi->children()->findAll() as $subkpi):?>
			<?php display_kpi($subkpi, $ischild+1); ?>
		<?php endforeach;?>

<?php  } ?>

<?php function display_task($task, $ischild=0) {?>
			<tr>
				<td>
					<?php echo str_repeat('&nbsp;&nbsp;', $ischild); ?>
					<i class="fa fa-circle<?php echo ($ischild%2 == 1)?'-o':''?>" style="font-size:8px"></i> <?php echo $task->name; ?>
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
			</tr>	

		<?php foreach ($task->children()->findAll() as $subtask):?>
			<?php display_task($subtask, $ischild+1); ?>
		<?php endforeach;?>

<?php } ?>
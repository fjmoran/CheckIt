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

<h2><?php echo Yii::app()->utility->getOption('project_name').": ".$model->name; ?></h2>

<?php foreach ($model->subprojects as $subproject) { ?>

	<div class="panel panel-default">

		<div class="panel-heading">
			<h3 class="panel-title"><? echo Yii::app()->utility->getOption('subproject_name'); ?></h3>
		</div>

		<div class="panel-body">
			<p><?php echo $subproject->name;?></p>
		</div>

		<table class="table table-condensed">
			<tr>
				<th><?php echo Yii::app()->utility->getOption('task_name'); ?></th>
				<th>Fecha inicio</th>
				<th>Fecha término</th>
				<th style="width: 150px;"></th>
			</tr>
		<?php foreach ($subproject->tasks as $task) { ?>
			<tr>
				<td><?php echo $task->name; ?></td>
				<td><?php echo $task->start_date; ?></td>
				<td><?php echo $task->due_date; ?></td>
				<td class="button-column" style="text-align: right;">
					<a title="Editar" data-toggle="modal" data-target="#myModal"
					data-remote="<?php echo Yii::app()->createUrl('task/changestatus',array('id'=>$task->id)); ?>">
						<i class="fa fa-edit grid-icon"></i>
					<?php 
						$interval = date_diff(new Datetime(date('Y-m-d')), new Datetime($task->due_date)); 
						$datediff = (int)$interval->format("%R%a");
					?>
					<?php if ($task->status == 1):?>
						<span class="label label-success">Terminado</span>
					<?php elseif ($datediff < 0): ?>
						<span class="label label-danger">Vencido</span>
					<?php elseif ($datediff < 16): ?>
						<span class="label label-warning"><i class="fa fa-arrow-right"></i> Vence en <?=$datediff?> días</span>
					<?php else: ?>
						<span class="label label-info">Pendiente</span>
					<?php endif; ?>
					</a>
				</td>
			</tr>
		<? } ?>
		</table>

	</div>
	
<? } ?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>

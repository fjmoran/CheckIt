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

<h2>Mis <?php echo Yii::app()->utility->getOption('projects_name'); ?></h2>

<?php foreach ($projects as $project):?>
<h3 style="padding-bottom:20px;"><?php echo Yii::app()->utility->getOption('project_name').": ".$project->name; ?></h3>

	<table class="table table-condensed">
		<tr>
			<th style="width: 24%;">Objetivo Estratégico</th>
			<th style="width: 12%;">KPI</th>
			<th style="width: 12%;">Meta</th>
			<th style="width: 12%;">Actual</th>
			<th style="width: 15%;">Responsable</th>
			<th style="width: 15%;">Estado</th>
			<th style="width: 10%; text-align: center;">Acciones</th>
		</tr>

	<?php foreach($project->subprojects AS $subproject): ?>
		<?php if (in_array($subproject->id, $subproject_ids)) :?>

		<tr>
			<td><?php echo $subproject->name?></td>

			<?php foreach ($kpis[$subproject->id] as $kpi):?>
			<tr>
				<td>
					<?php // if ($kpi->department_id == $department_id): ?>
						<a title="Editar" data-toggle="modal" data-target="#myModal" style="color: #333;" 
						href="<?php echo Yii::app()->createUrl('kpi/changestatus',array('id'=>$kpi->id)); ?>">					
						<?php echo $kpi->name; ?>
						</a>
					<?php //else: ?>
						<?php //echo $kpi->name; ?>
					<?php //endif; ?>
				</td>
				<td><?php echo $kpi->base_value; ?></td>
				<td>
					<?php echo $kpi->goal_value; ?>
				</td>
				<td>
					<?php //echo $kpi->real_value; ?>
				</td>
				<td>
					<?php if ($kpi->department) echo $kpi->department->name; ?>
				</td>				
				<td>
					<?php if ($kpi->base_value < $kpi->goal_value) {
						/*switch($kpi->real_value){
							case ($kpi->real_value >= $kpi->limit_green): ?>
								<span class="label label-success">Verde</span>
								<?php break;
							case ($kpi->real_value >= $kpi->limit_yellow): ?>
								<span class="label label-warning">Amarillo</span>
								<?php break;
							default: ?>
								<span class="label label-danger">Rojo</span>
								<?php break;
						}*/
					 } else {
						/*switch($kpi->real_value){
							case ($kpi->real_value <= $kpi->limit_green): ?>
								<span class="label label-success">Verde</span>
								<?php break;
							case ($kpi->real_value <= $kpi->limit_yellow): ?>
								<span class="label label-warning">Amarillo</span>
								<?php break;
							default: ?>
								<span class="label label-danger">Rojo</span>
								<?php break;
						}*/
					} ?>
				</td>
				<td style="text-align: center;">
					<?php //if ($kpi->department_id == $department_id): ?>
					<a title="Editar" data-toggle="modal" data-target="#myModal" 
					href="<?php echo Yii::app()->createUrl('kpi/changestatus',array('id'=>$kpi->id)); ?>">
						<i class="fa fa-edit grid-icon"></i>
					</a>
					<?php /*else: ?>
						<i class="fa fa-ban grid-icon" style="color:#ccc;"></i>					
					<?php endif; */?>
				</td>
			</tr>				
			<?php endforeach; ?>

		<tr>

		<?php endif;?>
	<?php endforeach;?>

	</table>

<? endforeach;?>

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
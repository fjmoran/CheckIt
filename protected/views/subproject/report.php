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
<div class="row">
	<div class="col-md-12">

		<h3>KPI</h3>

			<table class="table table-condensed" style="font-size:small;">
				<tr>
					<th style="width: 26%;">KPI</th>
					<th style="width: 8%;">Meta</th>
					<th style="width: 8%;">Actual</th>
					<th style="width: 8%;">Peso</th>
					<th style="width: 17%;">Responsable</th>
					<th style="width: 8%;">Estado</th>
					<th style="width: 7%; text-align: center;">Acción</th>
				</tr>			

<?php foreach ($kpis as $kpi) : ?>

			<tr>
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

<?php endforeach; ?>

		</table>

	</div>	
</div>
<?php
$this->breadcrumbs=array(
	'Reportes'=>array('site/report'),
	Yii::app()->utility->getOption('project_name').': '.$model->name,
);

// menu
$this->menu[] = array('label'=>'<i class="fa fa-chevron-left fa-lg fa-fw"></i> Reportes Estratégicos', 'url'=>array('/site/report'));
$this->menu[] = array('label'=>'<i class="fa fa-file fa-lg fa-fw"></i> '.Yii::app()->utility->getOption('project_name').': '.$model->name, 'url'=>array('/project/report', 'id'=>$model->id));
//perspectivas
$sps = Subproject::model()->findAllByAttributes(array('project_id'=>$model->id));
foreach ($sps as $sp) {
	$this->menu[] = array('label'=>'<i class="fa fa-chevron-right fa-lg fa-fw"></i> '.$sp->name, 'url'=>array('/subproject/report', 'id'=>$sp->id));
}

?>

<div class="row">
	<div class="col-md-11">
		<h2><?php echo Yii::app()->utility->getOption('project_name');?>: <?php echo $model->name?></h2>
	</div>
	<!-- div class="col-md-1" style="padding-top: 20px;">
		<a href="<?php echo Yii::app()->createUrl('site/report'); ?>" class="btn btn-primary btn-sm pull-right"><i class="fa fa-arrow-left"></i> Volver</a>
	</div -->
</div>
<br>
<div class="row">

<?php $i=0; foreach ($subprojects as $subproject) : ?>

	<?php if ($i%4 == 0):?>
		</div>
		<div class="row">
	<?php endif;?>

	<div class="col-md-3">
		<div class="row text-center">
			<p class="gaugeText"><?php echo $subproject->name ?></p>
		</div>

	<?php $this->Widget('ext.justgage.JustGage', array(
		'options'=>array(
			'value' => $subproject->compliance,
			'valueText' => round($subproject->compliance).'%',
			'min' => 0,
			'max' => 100,
			'title' => '',
			'levelColorsGradient' => false,
			'fixedProgress' => true,
			'progressValues' => array($red, $yellow, 1),
			'levelColors' => array("#c9302c", "#f7f43a", "#449d44"),
			'titleFontColor' => '#666',
		),
		'htmlOptions'=> array(
			'style'=>'width:250px; height:150px; margin: 0 auto;',
		),
	));?>

	<?php /* $this->Widget('ext.highcharts.HighchartsWidget', array(
		'scripts' => array(
			'highcharts-more',   // enables supplementary chart types (gauge, arearange, columnrange, etc.)
			'modules/solid-gauge',
			//'modules/exporting', // adds Exporting button/menu to chart
		),
		'options'=>array(
			'credits' => array('enabled' => false),
			'chart' => array('type' => 'solidgauge'),
			'title' => array('text' => $d['title']),
			//'title' => null,
			'pane' => array(
				'center' => array('50%', '50%'),
				'size' => '100%',
				'startAngle' => -90,
				'endAngle' => 90,
				'background' => array(
					'backgroundColor' => '#EEE',
					'innerRadius' => '60%',
					'outerRadius' => '100%',
					'shape' => 'arc',
				),
			),
			'tooltip' => array(
				'enabled' => false,
			),
			'yAxis' => array(
				'min' => 0,
				'max' => 100,
				'stops' => array(
					array(0, '#c9302c'), //red
					array($red - 0.001, '#c9302c'), //red
					array($red, '#ffff33'), //yellow
					array($yellow - 0.001, '#ffff33'), //yellow
					array($yellow, '#449d44'), //green
					array(1, '#449d44'), //green
				),
				'lineWidth' => 0,
				'minorTickInterval' => 20,
				'tickPixelInterval' => 100,
				'tickWidth' => 0,
				//'title' => array(
				//	'y' => -70,
				//	'text' => 'Speed',
				//),
				'labels' => array(
					'y' => 16,
				),
			),
			'plotOptions' => array(
				'solidgauge' => array(
					'dataLabels' => array(
						'y' => 5,
						'borderWidth' => 0,
						'useHTML' => true,
					),
				),
			),
			'series' => array(
				array(
					'name' => 'Perspectiva',
					'data' => array($d['compliance']),
					'dataLabels' => array(
						'format' => '<div style="text-align:center"><span style="font-size:25px;color:black;">{y} %</span></div>',
					),
					'tooltip' => array(
						'valueSuffix' => ' %',
					),
				),
			),
		)
	));*/	?>

	<br>
	<?php if ($subproject->kpis): ?>
	<table class="table table-condensed" style="font-size:small;">
		<tr>
			<th style="width: ;">KPI</th>
			<th style="width: ;">Estado</th>
		</tr>			

	<?php foreach ($subproject->kpis as $kpi):?>
		<tr>
			<td><a class="report-link" href="<?php echo Yii::app()->createUrl('subproject/report', array('id'=>$subproject->id))?>"><?php echo $kpi->name; ?></a></td>
			<td class="text-center"><?php 
				$compliance = $kpi->compliance;
				$color = Yii::app()->utility->getStatusColor($compliance); 
				if ($color == 1) echo '<span class="label label-danger">'.round($compliance).'%</span>';
				if ($color == 2) echo '<span class="label label-warning">'.round($compliance).'%</span>';
				if ($color == 3) echo '<span class="label label-success">'.round($compliance).'%</span>';
			?></td>
		</tr>
	<?php endforeach;?>
	</table>
	<?php endif;?>

	<?php if ($subproject->tasks): ?>
	<table class="table table-condensed" style="font-size:small;">
		<tr>
			<th style="width: ;"><?php echo Yii::app()->utility->getOption('task_name');?></th>
			<th style="width: ;">Estado</th>
		</tr>			

	<?php foreach ($subproject->tasks as $task):?>
		<tr>
			<td><a class="report-link" href="<?php echo Yii::app()->createUrl('subproject/report', array('id'=>$subproject->id))?>"><?php echo $task->name; ?></a></td>
			<td class="text-center">
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
	<?php endforeach;?>
	</table>
	<?php endif;?>

	</div>	

<?php $i++; endforeach; ?>

</div>
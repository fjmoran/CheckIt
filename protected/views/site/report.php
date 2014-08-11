<?php
/*$this->breadcrumbs=array(
	'Reportes',
);*/

// menu
$this->menu[] = array('label'=>'<i class="fa fa-file fa-lg fa-fw"></i> Reportes Estratégicos', 'url'=>array('/site/report'));
//perspectivas
$ps = Project::model()->findAll();
foreach ($ps as $p) {
	$this->menu[] = array('label'=>'<i class="fa fa-chevron-right fa-lg fa-fw"></i> '.$p->name, 'url'=>array('/project/report', 'id'=>$p->id));
}
?>

<div class="row">
	<div class="col-md-12">
		<h2><?php echo Yii::app()->utility->getOption('projects_name');?></h2><br>
	</div>
</div>
<div class="row">

<?php $i=0; foreach ($projects as $project) : ?>

	<?php if ($i%4 == 0):?>
		</div>
		<div class="row">
	<?php endif;?>

	<div class="col-md-3">

	<?php $this->Widget('ext.justgage.JustGage', array(
		'options'=>array(
			'value' => round($project->compliance),
			'label' => 'por ciento (%)',
			'min' => 0,
			'max' => 100,
			'title' => $project->name,
			'levelColorsGradient' => false,
			'levelColors' => array("#c9302c", "#f7f43a", "#449d44"),
		),
		'htmlOptions'=> array(
			'style'=>'width:200px; height:160px; margin: 0 auto;',
		),
	));?>

	<?php /*$this->Widget('ext.highcharts.HighchartsWidget', array(
		'scripts' => array(
			'highcharts-more',   // enables supplementary chart types (gauge, arearange, columnrange, etc.)
			'modules/solid-gauge',
			//'modules/exporting', // adds Exporting button/menu to chart
		),
		'options'=>array(
			'credits' => array('enabled' => false),
			'chart' => array(
				'type' => 'solidgauge',
				'borderColor' => '#aaa',
				//'borderWidth' => '1',
				'borderRadius' => '15px',
				),
			'title' => array('text' => $project->name),
			//'title' => null,
			'pane' => array(
				'center' => array('50%', '50%'),
				'size' => '100%',
				'startAngle' => -140,
				'endAngle' => 140,
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
					array($red - 0.00001, '#c9302c'), //red
					array($red, '#f7f43a'), //yellow
					array($yellow - 0.00001, '#f7f43a'), //yellow
					array($yellow, '#449d44'), //green
					array(1, '#449d44'), //green
				),
				'lineWidth' => 0,
				'minorTickInterval' => 20,
				'tickPixelInterval' => 100,
				'tickWidth' => 0,
				//'title' => array(
				//	'y' => -70,
				//	'text' => $d['title'],
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
					'data' => array(round($project->compliance,1)),
					'dataLabels' => array(
						'format' => '<div style="text-align:center"><span style="font-size:26px;color:black;">{y} %</span><br></div><br>',
					),
					'tooltip' => array(
						'valueSuffix' => ' %',
					),
				),
			),
		)
	));*/	?>

	<table class="table table-condensed" style="font-size:small;">
		<tr>
			<th style="width: ;"><?php echo Yii::app()->utility->getOption('subproject_name');?></th>
			<th style="width: ;">Estado</th>
		</tr>			

	<?php foreach ($project->subprojects as $subproject):?>
		<tr>
			<td><?php echo $subproject->name; ?></td>
			<td><?php 
				$color = Yii::app()->utility->getStatusColor($subproject->compliance); 
				if ($color == 1) echo '<span class="label label-danger">Rojo</span>';
				if ($color == 2) echo '<span class="label label-warning">Amarillo</span>';
				if ($color == 3) echo '<span class="label label-success">Verde</span>';
			?></td>
		</tr>
	<?php endforeach;?>
	</table>

	<br>
	</div>	

<?php $i++; endforeach; ?>

</div>
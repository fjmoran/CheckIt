<?php
$this->breadcrumbs=array(
	'Reportes'=>array('site/report'),
	Yii::app()->utility->getOption('project_name').': '.$model->name,
);

// menu
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
	<div class="col-md-1" style="padding-top: 20px;">
		<a href="<?php echo Yii::app()->createUrl('site/report'); ?>" class="btn btn-primary btn-sm pull-right"><i class="fa fa-arrow-left"></i> Volver</a>
	</div>
</div>
<br>
<div class="row">

<?php foreach ($subprojects as $subproject) : ?>

	<div class="col-md-4 text-center">
		
				<p class="gaugeText"><?php echo $subproject->name ?></p>

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
			'style'=>'width:300px; height:240px; margin: 0 auto;',
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

	</div>	

<?php endforeach; ?>

</div>
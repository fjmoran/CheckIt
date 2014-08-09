<?php
$this->breadcrumbs=array(
	'Reportes',
);

// menu
$this->menu[] = array('label'=>'<i class="fa fa-file fa-lg fa-fw"></i> Reportes Estratégicos', 'url'=>array('/site/report'));
//perspectivas
$ps = Project::model()->findAll();
foreach ($ps as $p) {
	$this->menu[] = array('label'=>'<i class="fa fa-user fa-lg fa-fw"></i> '.$p->name, 'url'=>array('/project/report', 'id'=>$p->id));
}
?>

<div class="row">
	<div class="col-md-12">
		<h2><?php echo Yii::app()->utility->getOption('projects_name');?></h2><br>
	</div>
</div>
<div class="row">

<?php foreach ($detail as $d) : ?>

	<div class="col-md-3">

	<?php $this->Widget('ext.highcharts.HighchartsWidget', array(
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
			'title' => array('text' => $d['title']),
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
					array($red - 0.001, '#c9302c'), //red
					array($red, '#f7f43a'), //yellow
					array($yellow - 0.001, '#f7f43a'), //yellow
					array($yellow, '#449d44'), //green
					array(1, '#449d44'), //green
				),
				'lineWidth' => 0,
				'minorTickInterval' => 20,
				'tickPixelInterval' => 100,
				'tickWidth' => 0,
				/*'title' => array(
					'y' => -70,
					'text' => 'Speed',
				),*/

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
	));	?>
	<br>
	</div>	

<?php endforeach; ?>

</div>
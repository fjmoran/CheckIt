<?php
$this->breadcrumbs=array(
	'Reportes',
);

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

<?php foreach ($detail as $d) : ?>

	<div class="col-md-3">

	<?php $this->Widget('ext.highcharts.HighchartsWidget', array(
		'options'=>array(
			'colors' => array(
				'#c9302c', '#ccc', '#ffff33', '#449d44', '#fff'
			),
			'credits' => array('enabled' => false),
			'chart' => array(
				'plotBackgroundColor' => null,
				'plotBorderWidth' => 0,
				'plotShadow' => false,
			),
			'title' => array(
				'text' => $d['title'],
				'align' => 'center',
				'verticalAlign' => 'middle',
				'y' => 50,
			),
			'tooltip' => array(
				'pointFormat' => '{series.name}: <b>{point.percentage:.1f}%</b>'
			),
			'plotOptions' => array(
				'pie' => array(
					'dataLabels' => array(
						'enabled' => true,
						'distance' => -50,
						'style' => array(
							'fontWeight' => 'bold',
							'color' => 'white',
							'textShadow' => '0px 1px 2px black',
						),
					),
					'startAngle' => -90,
					'endAngle' => 90,
					'center' => array('50%', '75%'),
				),
			),
			'series' => array(
				array(
					'type' => 'pie',
					'name' => 'Perspectiva',
					'innerSize' => '50%',
					'data' => array(
						array('Cumplimiento', $d['compliance']),
						array(
							'name' => '', 
							'y' => 100 - $d['compliance'],
							'dataLabels' => array(
								'enabled' => false,
							),
						),
					),
				),
			),
		)
	));	?>


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
				/*'height' => '200',
				'width' => '450',*/
			),
			//'title' => array('text' => $d['title']),
			'title' => null,
			'pane' => array(
				'center' => array('50%', '85%'),
				'size' => '140%',
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
				/*'title' => array(
					'y' => -70,
					'text' => $d['title'],
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
						'format' => '<div style="text-align:center"><span style="font-size:35px;color:black;">{y} %</span><br><span style="font-size:18px;color:black">'.$d['title'].'</span></div><br>',
					),
					'tooltip' => array(
						'valueSuffix' => ' %',
					),
				),
			),
		)
	));	?>

	</div>	

<?php endforeach; ?>

</div>
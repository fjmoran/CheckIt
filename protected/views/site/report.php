<div class="row">
	<div class="col-md-12">
		<h2><?php echo Yii::app()->utility->getOption('projects_name');?></h2><br>
	</div>
</div>
<div class="row">

<?php foreach ($detail as $d) : ?>

	<div class="col-md-6">

	<?php $this->Widget('ext.highcharts.HighchartsWidget', array(
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

	</div>	

<?php endforeach; ?>


<?php 
/*$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
	   	'credits' => array('enabled' => false),
		'chart' => array('type' => 'column'),
		'title' => array('text' => 'Pendientes por '.Yii::app()->utility->getOption('project_name')),
		'xAxis' => array(
			'categories' => $detail2['categories']
		),
		'yAxis' => array(
			'min' => 0,
			'title' => array('text' => 'Cumplimiento (%)')
		),
		'tooltip' => array(
			'pointformat' => '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
			'shared' => true
		),
		'plotOptions' => array(
			'column' => array('stacking' => 'percent')
		),
		'series' => array(
			array('name' => 'Atrasadas', 'data' => $detail2['overdueTasks'], 'color'=>'#d9534f'),
			array('name' => 'Próximas', 'data' => $detail2['nextTasks'], 'color' => '#f0ad4e'),
			array('name' => 'Pendientes', 'data' => $detail2['pendingTasks'], 'color' => '#5bc0de'),
		)
   )
));*/
?>		

	<div class="col-md-6">
<?php

/*$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
	   	'credits' => array('enabled' => false),
		'chart' => array('type' => 'column'),
		'title' => array('text' => 'KPI por '.Yii::app()->utility->getOption('project_name')),
		'xAxis' => array(
			'categories' => $detail3['categories']
		),
		'yAxis' => array(
			'min' => 0,
			'title' => array('text' => 'Cumplimiento (%)')
		),
		'tooltip' => array(
			'pointformat' => '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
			'shared' => true
		),
		'plotOptions' => array(
			'column' => array('stacking' => 'percent')
		),
		'series' => array(
			array('name' => 'KPI en rojo', 'data' => $detail3['redKpis'], 'color'=>'#d9534f'),
			array('name' => 'KPI en amarillo', 'data' => $detail3['yellowKpis'], 'color' => '#f0ad4e'),
			array('name' => 'KPI en verde', 'data' => $detail3['greenKpis'], 'color' => '#5cb85c'),
		)
   )
));*/
?>	
	</div>


<!--
	<div class="col-md-6">
<?php
/*
$this->Widget('ext.highcharts.HighchartsWidget', array(
	'options'=>array(
		'credits' => array('enabled' => false),
		'chart' => array('type' => 'column'),
		'title' => array('text' => 'Responsables de Perspectivas'),
		'xAxis' => array(
			'categories' => $detail['categories']
		),
		'yAxis' => array(
			'min' => 0,
			'title' => array('text' => 'Cumplimiento (%)')
		),
		'tooltip' => array(
			'pointformat' => '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
			'shared' => true
		),
		'plotOptions' => array(
			'column' => array('stacking' => 'percent')
		),
		'series' => array(
			array('name' => 'Atrasadas', 'data' => $detail['overdueTasks'], 'color'=>'#D2322D'),
			array('name' => 'Próximas', 'data' => $detail['nextTasks'], 'color' => '#F0AD4E'),
			array('name' => 'Pendientes', 'data' => $detail['pendingTasks'], 'color' => '#5BC0DE'),
		)
	)
));*/
?>	
	</div> -->




	<div class="col-md-6">
<?php
/*$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
      'title' => array('text' => 'Fruit Consumption'),
      'xAxis' => array(
         'categories' => array('Apples', 'Bananas', 'Oranges')
      ),
      'yAxis' => array(
         'title' => array('text' => 'Fruit eaten')
      ),
      'series' => array(
         array('name' => 'Jane', 'data' => array(1, 0, 4)),
         array('name' => 'John', 'data' => array(5, 7, 3))
      )
   )
));*/
?>		
	</div>



</div>
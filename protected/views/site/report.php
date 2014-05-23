<div class="row">
	<div class="col-md-12">
		<h3>Cumplimiento de planificación</h3>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
<?php
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
	   	'credits' => array('enabled' => false),
		'chart' => array('type' => 'column'),
		'title' => array('text' => 'Pendientes por '.Yii::app()->utility->getOption('project_name')),
		'xAxis' => array(
			'categories' => $detail2['categories']
		),
		'yAxis' => array(
			'min' => 0,
			'title' => array('text' => 'Cumplimiento')
		),
		'tooltip' => array(
			'pointformat' => '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
			'shared' => true
		),
		'plotOptions' => array(
			'column' => array('stacking' => 'percent')
		),
		'series' => array(
			array('name' => 'Atrasadas', 'data' => $detail2['overdueTasks'], 'color'=>'#D2322D'),
			array('name' => 'Próximas', 'data' => $detail2['nextTasks'], 'color' => '#F0AD4E'),
			array('name' => 'Pendientes', 'data' => $detail2['pendingTasks'], 'color' => '#5BC0DE'),
		)
   )
));
?>		
	</div>
	<div class="col-md-6">
<?php

$this->Widget('ext.highcharts.HighchartsWidget', array(
	'options'=>array(
		'credits' => array('enabled' => false),
		'chart' => array('type' => 'column'),
		'title' => array('text' => 'Pendientes por áreas de negocio'),
		'xAxis' => array(
			'categories' => $detail['categories']
		),
		'yAxis' => array(
			'min' => 0,
			'title' => array('text' => 'Cumplimiento')
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
));
?>	
	</div>

<!--	<div class="col-md-6">
<?php
$this->Widget('ext.highcharts.HighchartsWidget', array(
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
));
?>		
	</div>
-->


</div>
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

		<div class="row text-center">
			<a class="gaugeText" href="<?php echo Yii::app()->createUrl('project/report', array('id'=>$project->id))?>"><?php echo $project->name ?></a>
		</div>

	<?php $this->Widget('ext.justgage.JustGage', array(
		'options'=>array(
			'value' => $project->compliance,
			'valueText' => round($project->compliance).'%',
			'min' => 0,
			'max' => 100,
			//'title' => $project->name,
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
	
	<br>
	<table class="table table-condensed" style="font-size:small;">
		<tr>
			<th style="width: ;"><?php echo Yii::app()->utility->getOption('subproject_name');?></th>
			<th style="width: ;">Estado</th>
		</tr>			

	<?php foreach ($project->subprojects as $subproject):?>
		<tr>
			<td><a class="report-link" href="<?php echo Yii::app()->createUrl('subproject/report', array('id'=>$subproject->id))?>"><?php echo $subproject->name; ?></a></td>
			<td class="text-center"><?php 
				$compliance = $subproject->compliance;
				$color = Yii::app()->utility->getStatusColor($compliance); 
				if ($color == 1) echo '<span class="label label-danger">'.round($compliance).'%</span>';
				if ($color == 2) echo '<span class="label label-warning">'.round($compliance).'%</span>';
				if ($color == 3) echo '<span class="label label-success">'.round($compliance).'%</span>';
			?></td>
		</tr>
	<?php endforeach;?>
	</table>

	<br>
	</div>	

<?php $i++; endforeach; ?>

</div>

<?php ?>

<div class="row">
	<div class="col-md-12">

	<?php
$min = 1357009201; // 01/01/2013
$max = 1388545201; // 01/01/2014
$dif = $max-$min;
$data1 = array();
$j=0;
for ($i=0; $i < 20; $i++) { 
	$time = $min+($dif/20)*$i;
//	$data1[] = array( 'js:Date.UTC('.gmdate("Y, m, d", $time).')', round( (float)rand()/(float)getrandmax() , 2 ) ) ;
	$j =  ( round( (float)rand()/(float)getrandmax()/5 , 2 ) )*100 -8 + $j ;
	if ($j<0) $j=$j*-1;
	$data1[] = array( $time*1000 , $j ) ;
}
sort($data1);
$data2 = array();
$j=0;
for ($i=0; $i < 20; $i++) { 
	$time = $min+($dif/20)*$i;
//	$data1[] = array( 'js:Date.UTC('.gmdate("Y, m, d", $time).')', round( (float)rand()/(float)getrandmax() , 2 ) ) ;
	$j =  ( round( (float)rand()/(float)getrandmax()/5 , 2 ) )*100 -8 + $j ;
	if ($j<0) $j=$j*-1;
	$data2[] = array( $time*1000 , $j ) ;
}
sort($data2);
$data3 = array();
$j=0;
for ($i=0; $i < 20; $i++) { 
	$time = $min+($dif/20)*$i;
//	$data1[] = array( 'js:Date.UTC('.gmdate("Y, m, d", $time).')', round( (float)rand()/(float)getrandmax() , 2 ) ) ;
	$j =  ( round( (float)rand()/(float)getrandmax()/5 , 2 ) )*100 -8 + $j ;
	if ($j<0) $j=$j*-1;
	$data3[] = array( $time*1000 , $j ) ;
}
sort($data3);
$data4 = array();
$j=0;
for ($i=0; $i < 20; $i++) { 
	$time = $min+($dif/20)*$i;
//	$data1[] = array( 'js:Date.UTC('.gmdate("Y, m, d", $time).')', round( (float)rand()/(float)getrandmax() , 2 ) ) ;
	$j =  ( round( (float)rand()/(float)getrandmax()/5 , 2 ) )*100 -8 + $j ;
	if ($j<0) $j=$j*-1;
	$data4[] = array( $time*1000 , $j ) ;
}
sort($data4);

//print_r($data);
	?>

	<?php $this->Widget('ext.highcharts.HighchartsWidget', array(
		'options'=>array(
			'credits' => array('enabled' => false),
			'chart'=>array(
				'type'=>'spline',
			),
			'title'=> array(
				'text'=> Yii::app()->utility->getOption('projects_name'),
			),
			'subtitle'=>array(
				'text'=>'Evolución histórica',
			),
			'xAxis'=>array(
				'type'=>'datetime',
				'dateTimeLabelFormats'=>array(
					'month'=>'%e. %b',
					'year'=>'%b',
				),
				'title'=>array(
					'text'=>'Date',
				),
			),
			'yAxis'=>array(
				'title'=>array(
					'text'=>'% cumplimiento',
				),
				'min'=>0,
				'max'=>100,
			),
			'tooltip'=>array(
				'headerFormat'=>'<b>{series.name}</b><br>',
				'pointFormat'=>'{point.x:%e. %b}: {point.y:.2f}%',
			),
			'series'=>array(
				array(
					'name'=>'Financiera',
					'data'=>$data1,
				),
				array(
					'name'=>'Clientes',
					'data'=>$data2,
				),
				array(
					'name'=>'Procesos internos',
					'data'=>$data3,
				),
				array(
					'name'=>'Aprendizaje y desarrollo',
					'data'=>$data4,
				),				
			),
		),
	)); ?>

	</div>
</div>

<?php ?>

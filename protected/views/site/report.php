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
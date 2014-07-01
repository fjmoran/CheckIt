<?php
/* @var $this ProcessController */
/* @var $model Process */

Yii::app()->clientScript->registerCoreScript('jquery.ui');
//Yii::app()->clientScript->registerScriptFile(Yii::app()->createUrl('site/js'),CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/resources/js/jquery.jsPlumb.min.js',CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->createUrl('process/js', array('process_id'=>$model->id)),CClientScript::POS_HEAD);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/resources/js/jsPlumb_conf.js',CClientScript::POS_HEAD);

$this->breadcrumbs=array(
	'Processes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Process', 'url'=>array('index')),
	array('label'=>'Create Process', 'url'=>array('create')),
	array('label'=>'Update Process', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Process', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Process', 'url'=>array('admin')),
);
?>

<style>
.item {
	position: absolute;        
	border: 3px solid;
	border-color: #999;
	width: 150px;
	font-size: 80%;
    background-color:#eee;
	text-align: center;
	border-radius: 7px;
}

.decision{
	border: 3px solid;
	border-color: #999;	
    background-color: #eee;
    height: 86px;
    width: 86px;
    transform:rotate(-45deg) skew(15deg, 15deg);
	-ms-transform:rotate(-45deg) skew(15deg, 15deg);
    -webkit-transform: rotate(-45deg) skew(15deg, 15deg);
    position: absolute;
	text-align: center;
	border-radius: 5px;    
}

.title {
	padding: 10px;
	cursor: move;
	font-weight: bold;
	font-size: 120%;	
}

.connect {
	width: 100%;
	height: 20px;
	cursor: pointer;
	background-color: #40B3DF;
}

</style>

<h2>Proceso: <?php echo $model->name; ?></h2>

<div id="flowchart-edit">
	<div class="btn-group" style="padding: 10px;">
  		<a id="option-add-task" class="btn btn-default"><i class="fa fa-tasks"></i> Tarea</a>
  		<a id="option-add-start" class="btn btn-default"><i class="fa fa-play"></i> Inicio</a>
  		<a id="option-add-end" class="btn btn-default"><i class="fa fa-stop"></i> Final</a>  		
  		<a id="option-add-decision" class="btn btn-default"><i class="fa fa-cubes"></i> Decisión</a>
  		<a id="option-add-task2" class="btn btn-default"><i class="fa fa-share-alt"></i> Dividir</a>
  		<a id="option-add-task3" class="btn btn-default"><i class="fa fa-link"></i> Reunir</a>
	</div>
	<div class="decision"></div>
</div>


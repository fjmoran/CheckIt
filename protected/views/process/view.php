<?php
/* @var $this ProcessController */
/* @var $model Process */

Yii::app()->clientScript->registerCoreScript('jquery.ui');
//Yii::app()->clientScript->registerScriptFile(Yii::app()->createUrl('site/js'),CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/resources/js/jquery.jsPlumb.min.js',CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->createUrl('process/js'),CClientScript::POS_HEAD);
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
	border: 1px solid black;
	width: 150px;
	font-size: 80%;
    background-color:#FFFFFF;
	text-align: center;
	-moz-box-shadow: 2px 2px 3px 1px #AAA;
	-webkit-box-shadow: 2px 2px 3px 1px #AAA;
	box-shadow: 2px 2px 3px 1px #AAA;
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

#flowchart-options {
/*	border: 1px solid #ddd;*/
	width: 80px;
/*	height: 400px;*/
	position: absolute;
	top:10px;
	left: 10px;
}

#flowchart-options .top {
	background-color: #222;
	color: white;
	text-align: center;
	padding: 5px;
}
</style>

<h2>Proceso: <?php echo $model->name; ?></h2>

<div id="flowchart-edit">
	<div id="flowchart-options">
		<!--div class="top">Opciones</div-->
		<div class="content">
			<a id="option-add-task" class="btn btn-primary btn-sm btn-block" style="margin: 5px 0;">Nueva Tarea</a>
		</div>
	</div>
</div>
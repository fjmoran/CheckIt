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

<h2>Proceso: <?php echo $model->name; ?></h2>



<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#modeler" role="tab" data-toggle="tab">Modelador</a></li>
  <li><a href="#forms" role="tab" data-toggle="tab">Formularios</a></li>
</ul>


<div class="tab-content">
  <div class="tab-pane active" id="modeler">
	<div id="flowchart-edit">
		<div class="btn-group">
	  		<a id="option-add-task" class="btn btn-default"><i class="fa fa-tasks"></i> Actividad</a>
	  		<a id="option-add-start" class="btn btn-default"><i class="fa fa-play"></i> Actividad Inicial</a>
	  		<a id="option-add-end" class="btn btn-default"><i class="fa fa-stop"></i> Actividad Final</a>	
	  		<a id="option-add-decision" class="btn btn-default"><i class="fa fa-cubes"></i> Decisión</a>
	  		<a id="option-add-report" class="btn btn-default"><i class="fa fa-copy"></i> Reporte</a>
	  		<!-- <a id="option-add-divide" class="btn btn-default"><i class="fa fa-share-alt"></i> Dividir</a>
	  		<a id="option-add-join" class="btn btn-default"><i class="fa fa-link"></i> Reunir</a>  -->
		</div>
	</div>  	
  </div> <!-- fin pane -->
  <div class="tab-pane" id="forms"> 
  	Forms acá
  </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>

<div class="modal fade" id="myModal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
	</div>
</div>


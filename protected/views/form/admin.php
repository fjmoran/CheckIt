<?php
/* @var $this FormController */
/* @var $model Form */

$this->breadcrumbs=array(
	'Forms'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Form', 'url'=>array('index')),
	array('label'=>'Create Form', 'url'=>array('create')),
);

/*Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#form-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h2>Proceso: <?php echo $process->name; ?></h2>

<?php echo Yii::app()->utility->getTabs(array('id'=>$process->id)); ?>

<div class="tab-content">
  <div class="tab-pane active">

  		<h3>Formularios</h3>

		<div class="row">
<!--			<div class="col-md-10">

			  	<ol class="breadcrumb">
				  	<li><a href="#">Home</a></li>
			  		<li><a href="#">Library</a></li>
			  		<li class="active">Data</li>
				</ol>

			</div>	
-->			<div class="col-md-12">
				<a href="<?php echo Yii::app()->createUrl('form/create', array('process_id'=>$process->id)); ?>" class="btn btn-success btn-sm pull-right" style="margin-top: 10px; margin-bottom: 10px;"><i class="fa fa-plus-circle"></i> Nuevo</a>
			</div>
		</div>

<?php /* echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php */ ?>

<?php 

function showFields($data) {
	$list = array();
	foreach ($data->formProperties as $prop) {
		$list[] = $prop->formField->name;
	}
	if (count($list) > 0) {
		echo '<a href="'.Yii::app()->createUrl("formProperty/admin", array("form_id"=>$data->id)).'">';
		echo join("<br>", $list);		
		echo '</a>';
	}
	else {
		echo '<a class="label label-warning" style="font-weight: normal;" href="'.Yii::app()->createUrl("formProperty/admin", array("form_id"=>$data->id)).'">Haga click aquí para agregar campos al formulario</a>';
	}
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'form-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'itemsCssClass' => 'table table-condensed table-hover table-striped',
	'cssFile'=>false,
	'template'=>'{items} <div style="clear:both;">{pager}</div> <div class="pull-right">{summary}</div>',
	'columns'=>array(
		array(
			'name'=>'name',
			'header' => 'Nombre',
			'htmlOptions' => array('style' => 'width: 25%;'),
			'value'=>'$data->name',			
		),
		array(
			'name'=>'Campos',
			'header' => 'Campos',
			'htmlOptions' => array('style' => 'width: 68%;'),			
			'value'=>'showFields($data)',
		),
		array(
			'class'=>'CButtonColumn',
			'header' => 'Opciones',
			'htmlOptions' => array('style' => 'width: 7%;'),
			'template'=>'{view} {update} {delete}',
			'buttons'=>array (
				'update'=> array(
					'label' => '<i class="fa fa-edit grid-icon"></i>',
					'options'=>array('title'=>'Editar'),
					'imageUrl' => false,
				),
				'view'=>array(
					'url' => 'Yii::app()->createUrl("formProperty/admin", array("form_id"=>$data->id))',
					'label' => '<i class="fa fa-search grid-icon"></i>',
					'options'=>array('title'=>'Ver'),
					'imageUrl' => false,
				),
				'delete'=>array(
					'label' => '<i class="fa fa-trash-o grid-icon"></i>',
					'options'=>array('title'=>'Eliminar'),
					'imageUrl' => false,
				),
			),
		),
	),
)); ?>

	</div>
</div>

<?php
/* @var $this PositionController */
/* @var $model Position */

/*$this->breadcrumbs=array(
	'Positions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Position', 'url'=>array('index')),
	array('label'=>'Create Position', 'url'=>array('create')),
);*/

/*
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#position-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h2>Gestión de <?php echo Yii::app()->utility->getOption('departments_name') ?></h2>

<div class="row">
	<div class="col-md-12">
		<a href="<?php echo Yii::app()->createUrl('department/create'); ?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-circle"></i> Nuevo</a>
	</div>
</div></br>

<?php /*echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php */ ?>

<div class="row">
	<div class="col-md-12">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'position-grid',
	'dataProvider'=>$model->searchTree(),
	//'filter'=>$model,
	'itemsCssClass' => 'table table-condensed table-hover table-striped',
	'cssFile'=>false,
	'template'=>'{items} <div style="clear:both;">{pager}</div> <div class="pull-right">{summary}</div>',
	'columns'=>array(
		array(
			'htmlOptions' => array('style' => 'width: 50%;'),			
			'header'=>Yii::app()->utility->getOption('department_name'),
			'type'=>'html',
			'name'=>'name',
		),		
		array(
			'htmlOptions' => array('style' => 'width: 30%;'),				
			'header'=>Yii::app()->utility->getOption('manager_name'),
			'type'=>'html',
			'value'=>'$data->managerName?$data->managerName:"<span class=\"label label-danger\">Sin Encargado</span>"',
		),
		array(
			'htmlOptions' => array('style' => 'width: 13%;'),				
			'header'=>'Usuarios',
			//'name'=>'user.id',
			'value'=>'count($data->userNames)',
		),
		array(
			'htmlOptions' => array('style' => 'width: 7%;'),
			'class'=>'CButtonColumn',
			'template'=>'{view} {update} {delete}',
			'header' => 'Opciones',			
			'buttons'=>array (
				'update'=> array(
					'label' => '<i class="fa fa-edit grid-icon"></i>',
					'options'=>array('title'=>'Editar'),
					'imageUrl' => false,
				),
				'view'=>array(
					'url' => 'Yii::app()->createUrl("department/users", array("department_id"=>$data->id))',
					'label' => '<i class="fa fa-wrench grid-icon"></i>',
					'options'=>array('title'=>'Configurar'),
					'imageUrl' => false,
				),
				'delete'=>array(
					'label' => '<i class="fa fa-trash-o grid-icon"></i>',
					'options'=>array('title'=>'Eliminar'),
					'imageUrl' => false,
					'visible' => '$data->lft!=1',
				),
			),
		),
	),
	'pager'=>array(
		'htmlOptions'=>array('class'=>'pagination-sm'),
		'header' => '',
		'hiddenPageCssClass' => 'disabled',
		'maxButtonCount' => 10,
		'cssFile' => false,
		//'prevPageLabel' => '<i class="icon-chevron-left"><</i>',
		//'nextPageLabel' => '<i class="icon-chevron-right">></i>',
	),
)); ?>
	</div>
</div>

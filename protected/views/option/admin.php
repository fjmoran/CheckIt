<?php
/* @var $this OptionController */
/* @var $model Option */

$this->breadcrumbs=array(
	'Options'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Option', 'url'=>array('index')),
	array('label'=>'Create Option', 'url'=>array('create')),
);

/*
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#option-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h2>Parámetros de Sistema</h2>

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
	'id'=>'option-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'itemsCssClass' => 'table table-condensed table-hover table-striped',
	'cssFile'=>false,
	'template'=>'{items} <div style="clear:both;">{pager}</div> <div class="pull-right">{summary}</div>',
	'columns'=>array(
		array(
			'htmlOptions' => array('style' => 'width: 50%;'),			
			'header'=>'Nombre del parámetro',
			'name'=>'name',
		),	
		array(
			'htmlOptions' => array('style' => 'width: 43%;'),			
			'header'=>'Valor',
			'name'=>'value',
		),			
		array(
			'class'=>'CButtonColumn',
			'header'=> 'Opciones',			
			'htmlOptions' => array('style' => 'width: 7%;'),			
			'template'=>'{update}',
			'buttons'=>array (
				'update'=> array(
					'label' => '<i class="fa fa-edit grid-icon"></i>',
					'options'=>array('title'=>'Editar'),
					'imageUrl' => false,
				),
				'view'=>array(
					'label' => '<i class="fa fa-search grid-icon"></i>',
					'options'=>array('title'=>'Ver'),
					'imageUrl' => false,
				),
				'delete'=>array(
					'label' => '<i class="fa fa-trash-o grid-icon"></i>',
					'options'=>array('title'=>'Eliminar'),
					'imageUrl' => false,
					'visible' => 'Yii::app()->user->id != $data->id',
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

<?php
/* @var $this SubprojectController */
/* @var $model Subproject */

$this->breadcrumbs=array(
	'Subprojects'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Subproject', 'url'=>array('index')),
	array('label'=>'Create Subproject', 'url'=>array('create')),
);

/*Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#subproject-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h2>Gestión de <?php echo Yii::app()->utility->getOption('subprojects_name'); ?></h2>

<div class="row">
	<div class="col-md-12">
		<a href="<?php echo Yii::app()->createUrl('subproject/create'); ?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-circle"></i> Nuevo</a>
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
	'id'=>'subproject-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'itemsCssClass' => 'table table-condensed table-hover table-striped',
	'cssFile'=>false,
	'template'=>'{items} <div style="clear:both;">{pager}</div> <div class="pull-right">{summary}</div>',
	'columns'=>array(
		array(
			'htmlOptions' => array('style' => 'width: 75%;'),			
			'header'=>'Nombre del objetivo',
			'name'=>'name',
		),		
		array(
			'htmlOptions' => array('style' => 'width: 18%;'),			
			'header'=>Yii::app()->utility->getOption('project_name'),
			'name'=>'project.name',
		),
		array(
			'header'=> 'Opciones',
			'class'=>'CButtonColumn',
			'template'=>'{update} {delete}',
			'htmlOptions' => array('style' => 'width: 7%;'),				
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


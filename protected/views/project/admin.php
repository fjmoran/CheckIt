<?php
/* @var $this ProjectController */
/* @var $model Project */
/*
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('index')),
	array('label'=>'Create Project', 'url'=>array('create')),
);*/

/*
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#project-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h2>Gestión de <?php echo Yii::app()->utility->getOption('projects_name'); ?></h2>

<div class="row">
	<div class="col-md-12">
		<a href="<?php echo Yii::app()->createUrl('project/create'); ?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-circle"></i> Nuevo</a>
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
	'id'=>'project-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'itemsCssClass' => 'table table-condensed table-hover table-striped',
	'cssFile'=>false,
	'template'=>'{items} <div style="clear:both;">{pager}</div> <div class="pull-right">{summary}</div>',
	'columns'=>array(
		array(
			'htmlOptions' => array('style' => 'width: 47%;'),			
			'header'=>'Nombre',
			'name'=>'name',
		),
		array(
			'htmlOptions' => array('style' => 'width: 23%;'),			
			'header'=>Yii::app()->utility->getOption('department_name').' Responsable',
			'name'=>'department.name',
		),
		array(
			'htmlOptions' => array('style' => 'width: 23%;'),			
			'header'=>Yii::app()->utility->getOption('manager_name').' de '.Yii::app()->utility->getOption('department_name'),
			'name'=>'department.managerName',
		),
		array(
			'class'=>'CButtonColumn',
			'htmlOptions' => array('style' => 'width: 7%;'),			
			'header'=>'Opciones',			
			'template'=>'{update} {delete}',
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


<?php
/* @var $this TaskController */
/* @var $model Task */

$this->breadcrumbs=array(
	'Tasks'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Task', 'url'=>array('index')),
	array('label'=>'Create Task', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.select-level').change(function(){
	if ($(this).val()) {
		$('#task-grid').yiiGridView('update', {
			data: $('.search-form form').serialize()
		});		
	}
});
", CClientScript::POS_LOAD);
?>

<h2>Gestión de <?php echo Yii::app()->utility->getOption('tasks_name'); ?></h2>

<div class="row">
	<div class="col-md-4">
		<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
		<div class="search-form">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>
		</div><!-- search-form -->
	</div>
	<div class="col-md-8">
		<a href="<?php echo Yii::app()->createUrl('task/create'); ?>" style="margin-top:64px;" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-circle"></i> Nuevo</a>
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
	'id'=>'task-grid',
	'dataProvider'=>$model->searchTree(),
	//'filter'=>$model,
	'itemsCssClass' => 'table table-condensed table-hover table-striped',
	'cssFile'=>false,
	'template'=>'{items} <div style="clear:both;">{pager}</div> <div class="pull-right">{summary}</div>',
	'columns'=>array(
		array(
			'htmlOptions' => array('style' => 'width: 38%;'),			
			'header'=> 'Nombre',
			'type'=>'html',
			'name'=> 'name',
		),
/*		array(
			'htmlOptions' => array('style' => 'width: 25%;'),
			'header'=>Yii::app()->utility->getOption('subproject_name'),
			'name'=>'subproject.name',
		),
		array(
			'htmlOptions' => array('style' => 'width: 12%;'),			
			'header'=>Yii::app()->utility->getOption('project_name'),
			'name'=>'subproject.project.name',
		),*/
		array(
			'htmlOptions' => array('style' => 'width: 25%;'),			
			'header'=> 'Responsable',
			'name' => 'inCharge',
			//'name'=>'department.nameWithManager',
		),
		array(
			'htmlOptions' => array('style' => 'width: 15%;'),
			'header'=> 'Inicio',
			'name'=> 'start_date',
		),
		array(
			'htmlOptions' => array('style' => 'width: 15%;'),			
			'header'=> 'Fin',
			'name'=> 'due_date',
		),				
		array(
			'class'=>'CButtonColumn',
			'header' => 'Opciones',
			'htmlOptions' => array('style' => 'width: 7%;'),
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


<?php
/* @var $this KpiController */
/* @var $model Kpi */
/*
$this->breadcrumbs=array(
	'Kpis'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Kpi', 'url'=>array('index')),
	array('label'=>'Create Kpi', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
/*function init_tree(filter) {
	$('#treeviewkpi').empty();
	$('#treeviewkpi').treeview({
		url: '".Yii::app()->createUrl('kpi/ajaxFillTree')."',
		ajax: {
			data: {
				'subproject_id': filter,
			},
			type: 'post'
		},
	});
}*/
$('.select-level').change(function(){
	if ($(this).val()) {
//		init_tree($(this).val());
		$('#kpi-grid').yiiGridView('update', {
			data: $('.search-form form').serialize()
		});		
	}
});
", CClientScript::POS_LOAD);
?>

<h2>Gestión de KPI</h2>

<?php if (count($subprojects) == 0):?>

<div class="alert alert-warning" role="alert">Se debe especificar previamente <a href="<?php echo Yii::app()->createUrl('subproject/admin'); ?>"><?php echo Yii::app()->utility->getOption('subprojects_name'); ?></a> para poder definir KPIs.</div>

<?php else: ?>

<div class="row">
	<div class="col-md-4">
		<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
		<div class="search-form">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
			'subprojects'=>$subprojects,
		)); ?>
		</div><!-- search-form -->
	</div>
	<div class="col-md-8">
		<a href="<?php echo Yii::app()->createUrl('kpi/create'); ?>" style="margin-top:64px;"  class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-circle"></i> Nuevo</a>
	</div>
</div></br>

<?php /*echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php */ ?>

<?php
//$this->widget('CTreeView',array(
		//'url'=>array('ajaxFillTree'),
//		'htmlOptions'=>array(
//			'id'=>'treeviewkpi',
//			'class'=>'treeview-gray',
//		),
		/*'ajax'=>array(
			'data'=>array(
				'subproject_id'=>$subproject_id,
			),
			'type'=>'post',
		),*/
        /*'data'=>$model->search(),
        'htmlOptions'=>array(
					'id'=>'treeview-categ',
                'class'=>'treeview-red',//there are some classes that ready to use
        ),*/
//));
?>

<?php  $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'kpi-grid',
	'dataProvider'=>$model->searchTree(),
	//'filter'=>$model,
	'itemsCssClass' => 'table table-condensed table-hover table-striped',
	'cssFile'=>false,
	'template'=>'{items} <div style="clear:both;">{pager}</div> <div class="pull-right">{summary}</div>',
	'columns'=>array(
		array(
			'htmlOptions' => array('style' => 'width: 50%;'),
			'header'=>'KPI',
			'type'=>'html',
			'name'=>'name',
		),
		array(
			'htmlOptions' => array('style' => 'width: 28%;'),			
			'header'=>'Responsable',
			'type'=>'html',
			'name'=>'inCharge',
			//'name'=>'department.nameWithManager',
		),
		array(
			'htmlOptions' => array('style' => 'width: 15%;'),			
			'header'=> 'Fecha Meta',
			'name'=>'goal_date',
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

<?php endif; ?>


<?php
/* @var $this KpiController */
/* @var $model Kpi */

$this->breadcrumbs=array(
	'Kpis'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Kpi', 'url'=>array('index')),
	array('label'=>'Create Kpi', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.select-level').change(function(){
	if ($(this).val()) {
		$('#kpi-grid').yiiGridView('update', {
			data: $('.search-form form').serialize()
		});
	}
});
", CClientScript::POS_LOAD);
?>

<h2>Gestión de KPI</h2>

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

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'kpi-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'itemsCssClass' => 'table table-condensed table-hover table-striped',
	'cssFile'=>false,
	'template'=>'{items} <div style="clear:both;">{pager}</div> <div class="pull-right">{summary}</div>',
	'columns'=>array(
		array(
			'htmlOptions' => array('style' => 'width: 50%;'),
			'header'=>'KPI',
			'name'=>'name',
		),
		/*array(
			'htmlOptions' => array('style' => 'width: 34%;'),
			'header'=>Yii::app()->utility->getOption('subproject_name'),
			'name'=>'subproject.name',
		),*/
		array(
			'htmlOptions' => array('style' => 'width: 28%;'),			
			'header'=>Yii::app()->utility->getOption('department_name').' Responsable',
			'name'=>'department.name',
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

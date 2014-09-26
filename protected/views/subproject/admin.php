<?php
/* @var $this SubprojectController */
/* @var $model Subproject */

/*$this->breadcrumbs=array(
	'Subprojects'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Subproject', 'url'=>array('index')),
	array('label'=>'Create Subproject', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('#Subproject_project_id').change(function(){
	$('#subproject-grid').yiiGridView('update', {
		data: $('.search-form form').serialize()
	});
});
", CClientScript::POS_LOAD);
?>

<h2>Gestión de <?php echo Yii::app()->utility->getOption('subprojects_name'); ?></h2>

<?php if (count($projects) == 0):?>

<div class="alert alert-warning" role="alert">Se debe especificar previamente <a href="<?php echo Yii::app()->createUrl('project/admin'); ?>"><?php echo Yii::app()->utility->getOption('projects_name'); ?></a> para poder definir <?php echo Yii::app()->utility->getOption('subprojects_name'); ?>.</div>

<?php else: ?>

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
		<a href="<?php echo Yii::app()->createUrl('subproject/create'); ?>" style="margin-top:28px;" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-circle"></i> Nuevo</a>
	</div>
</div></br>

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
			'htmlOptions' => array('style' => 'width: 42%;'),			
			'header'=>'Nombre',
			'name'=>'name',
		),		
		array(
			'htmlOptions' => array('style' => 'width: 36%;'),			
			'header'=>Yii::app()->utility->getOption('department_name').' Responsable',
			'type'=>'html',
			'name'=>'department.nameWithManager',
		),
		/*array(
			'htmlOptions' => array('style' => 'width: 18%;'),			
			'header'=>Yii::app()->utility->getOption('manager_name').' de '.Yii::app()->utility->getOption('department_name'),
			'name'=>'department.managerName',
		),*/
		'weight',
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

<?php endif; ?>

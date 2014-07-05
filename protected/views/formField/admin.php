<?php
/* @var $this FormFieldController */
/* @var $model FormField */

$this->breadcrumbs=array(
	'Form Fields'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List FormField', 'url'=>array('index')),
	array('label'=>'Create FormField', 'url'=>array('create')),
);

/*Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#form-field-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h2>Proceso: <?php echo $process->name; ?></h2>

<ul class="nav nav-tabs" role="tablist">
  <li><a href="<?php echo Yii::app()->createUrl('process/view', array('id'=>$process->id))?>" role="tab">Modelador</a></li>
  <li class="active"><a href="#" role="tab">Formularios</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active">

  	<h3>Lista de Campos formulario <?php echo $form->name?></h3>

		<div class="row">
			<div class="col-md-12">
				<a href="<?php echo Yii::app()->createUrl('formField/create', array('form_id'=>$form->id)); ?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-circle"></i> Nuevo</a>
			</div>
		</div></br>

<?php /* echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php */ ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'form-field-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'itemsCssClass' => 'table table-condensed table-hover table-striped',
	'cssFile'=>false,
	'template'=>'{items} <div style="clear:both;">{pager}</div> <div class="pull-right">{summary}</div>',
	'columns'=>array(
		'name',
		'code',
		array(
			'name'=>'required',
			'value'=>'$data->requiredValue',
		),
		array(
			'name'=>'type',
			'value'=>'$data->typeValue',
		),
		'position',
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
					'url' => 'Yii::app()->createUrl("formField/admin", array("form_id"=>$data->id))',
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

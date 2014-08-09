<?php
/* @var $this FormPropertyController */
/* @var $model FormProperty */
/*
$this->breadcrumbs=array(
	'Form Properties'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List FormProperty', 'url'=>array('index')),
	array('label'=>'Create FormProperty', 'url'=>array('create')),
);*/

/*Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#form-property-grid').yiiGridView('update', {
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

  	<h3>Lista de campos formulario <?php echo $form->name?></h3>

		<div class="row">
			<div class="col-md-12">
				<a href="<?php echo Yii::app()->createUrl('formProperty/create', array('form_id'=>$form->id)); ?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-circle"></i> Nuevo</a>
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
	'id'=>'form-property-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'itemsCssClass' => 'table table-condensed table-hover table-striped',
	'cssFile'=>false,
	'template'=>'{items} <div style="clear:both;">{pager}</div> <div class="pull-right">{summary}</div>',
	'enableSorting' => false,
	'columns'=>array(
		array(
			'header' => 'Campo',
			'htmlOptions' => array('style' => 'width: 40%;'),			
			'name'=>'form_field_id',
			'value'=>'$data->formField->name',
		),
		array(
			'header' => 'Es editable',
			'htmlOptions' => array('style' => 'width: 20%;'),			
			'name'=>'visible',
			'value'=>'$data->visibleValue',
		),
		array(
			'header' => 'Es obligatorio',
			'htmlOptions' => array('style' => 'width: 20%;'),			
			'name'=>'required',
			'value'=>'$data->requiredValue',
		),
		array(
			'header' => 'Posición',
			'htmlOptions' => array('style' => 'width: 13%;'),			
			'name'=>'position',
			'value'=>'$data->position',
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
)); ?>

	</div>
</div>
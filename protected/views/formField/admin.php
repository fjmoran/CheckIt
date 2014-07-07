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

<?php echo Yii::app()->utility->getTabs(array('id'=>$process->id)); ?>

<div class="tab-content">
  <div class="tab-pane active">

  	<h3>Lista de campos</h3>

		<div class="row">
			<div class="col-md-12">
				<a href="<?php echo Yii::app()->createUrl('formField/create', array('process_id'=>$process->id)); ?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-circle"></i> Nuevo</a>
			</div>
		</div></br>

<?php /* echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php */ ?>

<?php 

function showFields($data) {
	if ($data->type == '3' || $data->type == '4') {
		$list = array();
		foreach ($data->formFieldOptions as $opt) {
			$list[] = $opt->name;
		}
		if (count($list) > 0) {
			echo '<a href="'.Yii::app()->createUrl("formFieldOption/admin", array("form_field_id"=>$data->id)).'">';
			echo join(", ", $list);		
			echo '</a>';
		}
		else {
			echo '<a class="label label-warning" style="font-weight: normal;" href="'.Yii::app()->createUrl("formFieldOption/admin", array("form_field_id"=>$data->id)).'">Haga click aquí para agregar opciones</a>';
		}
	}
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'form-field-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'itemsCssClass' => 'table table-condensed table-hover table-striped',
	'cssFile'=>false,
	'template'=>'{items} <div style="clear:both;">{pager}</div> <div class="pull-right">{summary}</div>',
	'columns'=>array(
		array(
			'name'=>'name',
			'header' => 'Nombre',
			'htmlOptions' => array('style' => 'width: 24%;'),
			'value'=>'$data->name',			
		),
		array(
			'name'=>'code',
			'header' => 'ID / código de referencia',
			'htmlOptions' => array('style' => 'width: 24%;'),
			'value'=>'$data->code',			
		),
		array(
			'name'=>'type',
			'header' => 'Tipo',
			'htmlOptions' => array('style' => 'width: 20%;'),			
			'value'=>'$data->typeValue',
		),
		array(
			'name'=>'Campos',
			'header' => 'Campos',
			'htmlOptions' => array('style' => 'width: 25%;'),			
			'value'=>'showFields($data)',
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

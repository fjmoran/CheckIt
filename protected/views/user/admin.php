<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
);

/*
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
*/
?>

<h2>Gestión de usuarios</h2>

<div class="row">
	<div class="col-md-12">
		<a href="<?php echo Yii::app()->createUrl('user/create'); ?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-circle"></i> Nuevo</a>
	</div>
</div></br>

<?php /* echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php */ ?>

<div class="row">
	<div class="col-md-12">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'itemsCssClass' => 'table table-condensed table-hover table-striped',
	'cssFile'=>false,
	'template'=>'{items} <div style="clear:both;">{pager}</div> <div class="pull-right">{summary}</div>',
	'columns'=>array(
		array(
			'htmlOptions' => array('style' => 'width: 24%;'),			
			'header'=>'Correo electrónico',
			'name'=>'email',
		),		
		array(
			'htmlOptions' => array('style' => 'width: 16%;'),			
			'header'=>'Nombre',
			'name'=>'firstname',
		),			
		array(
			'htmlOptions' => array('style' => 'width: 16%;'),			
			'header'=>'Apellido',
			'name'=>'lastname',
		),		
		array(
			'htmlOptions' => array('style' => 'width: 18%;'),			
			'header'=>'Cargo',
			'name'=>'position.name',
		),
		array(
			'htmlOptions' => array('style' => 'width: 7%;'),			
			'name'=>'status',
			'type'=>'html',
			'value'=>'User::model()->statusOptions[$data->status]',
		),
		/* array(
			'header'=>'Roles',
			'name'=>'roles.id',
			'type'=>'raw',
			'value'=>'implode(", ",$data->roleNames)',
		), */
		array(
			'htmlOptions' => array('style' => 'width: 12%;'),			
			'name'=>'lastvisit',
			'value'=>'strtotime($data->lastvisit)>0?date("d-m-Y h:i", strtotime($data->lastvisit)):\'\'',
		),
		array(
			'class'=>'CButtonColumn',
			'htmlOptions' => array('style' => 'width: 7%;'),
			'template'=>'{update} {delete}',
			'header' => 'Opciones',	
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
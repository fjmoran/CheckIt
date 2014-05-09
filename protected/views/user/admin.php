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
?>
<h1>Usuarios</h1>

<div id="inner-sidebar"><a href="<?php echo Yii::app()->createUrl('user/create'); ?>" class="btn btn-success"><i class="fa fa-plus-circle"></i> Nuevo</a></div>

<?php /* echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php */ ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'itemsCssClass' => 'table table-condensed table-hover',
	'cssFile'=>false,
	'template'=>'{items} <div class="pull-right">{summary}</div> {pager}',
	'columns'=>array(
		'email',
		'firstname',
		'lastname',
		array(
			'name'=>'status',
			'type'=>'html',
			'value'=>'User::model()->statusOptions[$data->status]',
		),
		array(
			'name'=>'created',
//			'value'=>'strtotime($data->created)?date("j-M-Y", $data->created):\'\'',
		),
		'lastvisit',
		array(
			'class'=>'CButtonColumn',
	        'template'=>'{update} {delete}',
	        'buttons'=>array (
	            'update'=> array(
	                'label' => '<i class="fa fa-edit"></i>',
	                                'imageUrl' => false,
	            ),
	            'view'=>array(
	                'label' => '<i class="fa fa-search"></i>',
	                                'imageUrl' => false,
	            ),
	            'delete'=>array(
	                'label' => '<i class="fa fa-trash-o"></i>',
	                                'imageUrl' => false,
		        ),
	        ),
		),
	),
)); ?>

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

<div class"col-md-12"><a href="<?php echo Yii::app()->createUrl('user/create'); ?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-circle"></i> Nuevo</a></div>

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
	'template'=>'{items} <div style="clear:both;">{pager}</div> <div class="pull-right">{summary}</div>',
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
			'value'=>'strtotime($data->created)>0?date("d-m-Y h:i", strtotime($data->created)):\'\'',
		),
		array(
			'name'=>'lastvisit',
			'value'=>'strtotime($data->lastvisit)>0?date("d-m-Y h:i", strtotime($data->lastvisit)):\'\'',
		),
		array(
			'class'=>'CButtonColumn',
	        'template'=>'{update} {delete}',
	        'buttons'=>array (
	            'update'=> array(
	                'label' => '<i class="fa fa-edit grid-icon"></i>',
	                'imageUrl' => false,
	            ),
	            'view'=>array(
	                'label' => '<i class="fa fa-search grid-icon"></i>',
	                'imageUrl' => false,
	            ),
	            'delete'=>array(
	                'label' => '<i class="fa fa-trash-o grid-icon"></i>',
	                'imageUrl' => false,
	                'visible' => 'Yii::app()->user->id != $data->id',
		        ),
	        ),
		),
	),
    'pager'=>array(
    	'htmlOptions'=>array('class'=>'pagination'),
        'header' => '',
        'hiddenPageCssClass' => 'disabled',
        'maxButtonCount' => 10,
        'cssFile' => false,
        'prevPageLabel' => '<i class="icon-chevron-left"><</i>',
        'nextPageLabel' => '<i class="icon-chevron-right">></i>',
//        'class' => 'pagination',
//        'prevPageLabel' => '<i class="fa fa-chevron-left fa-5x" style="position:absolute; top:610px; left:-50px; color: #ccc;"></i>',
//        'nextPageLabel' => '<i class="fa fa-chevron-right fa-5x" style="position:absolute; top:610px; right:-50px; color: #ccc;"></i>',
    ),
)); ?>

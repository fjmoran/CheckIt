<?php
/* @var $this ProcessTaskController */
/* @var $model ProcessTask */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		//'enctype' => 'multipart/form-data',
		'role' => 'form',
		'autocomplete' => 'off',
	),
)); ?>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="myModalLabel">Modificar Actividad</h4>
</div>
<div class="modal-body">

	<ul class="nav nav-tabs" role="tablist">
		<li class="active"><a href="#data" role="tab" data-toggle="tab">Datos</a></li>
		<li><a href="#form" role="tab" data-toggle="tab">Formularios</a></li>
	</ul>

	<div class="tab-content" style="padding: 10px;">

		<div class="tab-pane active" id="data">

			<?php echo $form->errorSummary($model); ?>

			<div class="row">	
				<div class="col-md-6">
					<?php echo $form->labelEx($model,'name'); ?>
					<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
					<?php echo $form->error($model,'name'); ?>
				</div>
				<div class="col-md-6">
					<!-- segunda col -->
				</div>
			</div>

		</div>

		<div class="tab-pane" id="form">

			<div class="row">
				<div class="col-md-12">
					<a data-toggle="modal" data-target="#myModal2" href="<?php echo Yii::app()->createUrl('processStep/create', array('process_task_id'=>$model->id)); ?>" class="btn btn-success btn-sm pull-right" style="margin-top: 10px; margin-bottom: 10px;"><i class="fa fa-plus-circle"></i> Nuevo</a>
				</div>
			</div><br />

			<div class="row">
				<div class="col-md-12">
					<?php $this->widget('zii.widgets.grid.CGridView', array(
						'id'=>'process-step-grid',
						'dataProvider'=>$step->search(),
						//'filter'=>$step,
						'itemsCssClass' => 'table table-condensed table-hover table-striped',
						'cssFile'=>false,
						'template'=>'{items} <div style="clear:both;">{pager}</div> <div class="pull-right">{summary}</div>',
						'columns'=>array(
							'form_id',
							'position',
							array(
								'class'=>'CButtonColumn',
								'header' => 'Opciones',
								'htmlOptions' => array('style' => 'width: 7%;'),
								'template'=>'{view} {update} {delete}',
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

		</div>

	</div>

</div>
<div class="modal-footer">
	<?php echo CHtml::link(
		'Eliminar',
		'#',
		array(
			'submit' => array('processTask/delete','id'=>$model->id),
			'class' => 'btn btn-danger btn-sm pull-left',
			//'confirm' => '¿Esta seguro?'
		)
	); ?>
	<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', array('class'=>'btn btn-primary btn-sm')); ?>
</div>

<?php $this->endWidget(); ?>

<script>
$('#myModal2').on('hidden.bs.modal', function () {
	$('#process-step-grid').yiiGridView.update('process-step-grid');
})
</script>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
<!--            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Modal title</h4>

            </div>
            <div class="modal-body"><div class="te"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div> --> 
    </div> 
</div>
<!-- /.modal -->
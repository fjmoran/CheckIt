<?php
/* @var $this ProcessStepController */
/* @var $model ProcessStep */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'process-step-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		//'enctype' => 'multipart/form-data',
		'role' => 'form',
		'autocomplete' => 'off',
		'onsubmit'=>"return false;",
		'onkeypress'=>" if(event.keyCode == 13){ send(); } ", /* Do ajax call when user presses enter key */
	),
)); ?>

<div class="modal-header">
	<button type="button" class="close" aria-hidden="true" onclick="$('#myModal2').modal('hide')">&times;</button>
	<h4 class="modal-title" id="myModalLabel">Crear paso</h4>
</div>
<div class="modal-body">

	<div id="error-msg" class="alert alert-danger" role="alert" style="display:none;"></div>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">	
		<div class="col-md-6">
			<?php echo $form->labelEx($model,'form_id'); ?>
			<?php
				$actual_fields = ProcessStep::model()->findAllByAttributes(array('process_task_id'=>$model->process_task_id));
				$fields = array();
				foreach ($actual_fields as $field) {
					if ($field->form_id != $model->form_id)
						$fields[] = $field->form_id;
				}
				$fields = join(",", $fields);
				if ($fields)
					$data = Form::model()->findAll('process_id='.$task->process_id.' AND id NOT in ('.$fields.')',array('order' => 'name')); 
				else
					$data = Form::model()->findAll('process_id='.$task->process_id, array('order' => 'name')); 
			?>
			<?php echo $form->dropDownList($model,'form_id', CHtml::listData($data, 'id', 'name'), array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'form_id'); ?>
		</div>
	</div>

	<div class="row">	
		<div class="col-md-6">
			<?php echo $form->labelEx($model,'position'); ?>
			<?php echo $form->textField($model,'position',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'position'); ?>
		</div>
	</div>

	<?php echo $form->hiddenField($model,'process_task_id'); ?>

	</div><!-- form -->

</div>
<div class="modal-footer">
	<?php if (!$model->isNewRecord) echo CHtml::link(
		'Eliminar',
		'#',
		array(
			'submit' => array('processTask/delete','id'=>$model->id),
			'class' => 'btn btn-danger btn-sm pull-left',
			//'confirm' => '¿Esta seguro?'
		)
	); ?>
	<button type="button" class="btn btn-default btn-sm" onclick="$('#myModal2').modal('hide')">Cancelar</button>
	<?php echo CHtml::Button($model->isNewRecord ? 'Crear' : 'Modificar', array('class'=>'btn btn-primary btn-sm','onclick'=>'send();')); ?>
</div>

<script type="text/javascript"> 
function send() {
	var data=$("#process-step-form").serialize();
	$.ajax({
		type: 'POST',
		dataType: "json",
		url: '<?php echo Yii::app()->createUrl("processStep/create", array("process_task_id"=>$model->process_task_id)); ?>',
		data:data,
		success:function(data){
			data = $.parseJSON( data );
			if (data['success']) {
				$('#myModal2').modal('hide');
			}
			else {
				$('#error-msg').text("Se han encontrado los siguientes errores:");
				$('#error-msg').append('<button type="button" class="close" aria-hidden="true" onclick="$(\'#error-msg\').hide()">&times;</button>'); 
				var items = [];
				$.each( data['errors'], function( key, val ) {
					items.push( "<li id='" + key + "'>" + val + "</li>" );
				});
				$( "<ul/>", {
					//"class": "",
					html: items.join( "" )
				}).appendTo( "#error-msg" );
				$('#error-msg').show();
			}
 		},
		error: function(data) { // if error occured
			alert("Error!!");
		},
		dataType:'html'
	});
}
</script>

<?php $this->endWidget(); ?>

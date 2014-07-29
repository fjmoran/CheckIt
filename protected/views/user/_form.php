<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
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

	<?php echo $form->errorSummary($model); ?>
<div class="row">
	  	<input type='text' style='display: none'> <!-- previene el autocomplete -->
  		<input type='password' style='display: none'>  <!-- previene el autocomplete -->
	<div class="col-md-6">
		<div class="form-group">
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'email'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'firstname'); ?>
			<?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'firstname'); ?>
		</div>
		<div class="form-group">
			<?php echo $form->labelEx($model,'lastname'); ?>
			<?php echo $form->textField($model,'lastname',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'lastname'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'position'); ?>
			<?php echo $form->textField($model,'position',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'position'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'department_id'); ?>
			<?php $data = Department::model()->findAll(array('order' => 'name')); ?>
			<?php echo $form->dropDownList($model,'department_id', CHtml::listData($data, 'id', 'name'), array('empty'=>'Sin área','class'=>'form-control')); ?>
			<?php echo $form->error($model,'department_id'); ?>
		</div>		

		<div class="form-group">
			<?php echo $form->labelEx($model,'status'); ?>
			<?php echo $form->dropDownList($model,'status', User::model()->statusOptions, array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'status'); ?>
		</div>		

		<div class="form-group">
			<?php echo $form->labelEx($model,'roles'); ?><br />
			<?php 

				Yii::app()->clientScript->registerScript('tooltip', '$(".showtooltip").tooltip(); ', CClientScript::POS_READY);

				$data = Role::model()->findAll(array('order'=>'pos ASC'));
				$list = Array();
				foreach ($data as $d) {
					$list[$d->id] = $d->friendly_name.' &nbsp;&nbsp;<a style="text-decoration:none;" class="fa fa-question-circle showtooltip" data-toggle="tooltip" data-placement="right" title="'.$d->description.'"></a>';
					//$list[$d->id] = $d->friendly_name.' <i class="tooltip" data-toggle="tooltip" data-placement="right" title="'.$d->description.'" class="fa fa-question"></i>';
				}
				echo CHtml::activeCheckBoxList(
					$model, 
					'roleIDs', 
					$list,
					array(
						'template'=>'{input} &nbsp;&nbsp;{label}',
						'separator' =>'<br />',
						'class'=>'categoryFilter',
						'checkAll'=>'Todos',
					)
				);  ?>
			<?php echo $form->error($model,'roles'); ?>
		</div>		

	</div>

	<div class="col-md-6">
		<!-- nada -->
	</div>
</div>	

<div class="form-group buttons">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
$(window).load(function() { // can also try on document ready
    $('input').removeAttr('autocomplete');
});
</script>
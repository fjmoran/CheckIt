<?php
/* @var $this FormPropertyController */
/* @var $model FormProperty */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'form-property-form',
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
		<div class="col-md-6">
			<?php echo $form->labelEx($model,'form_field_id'); ?>
			<?php
				$actual_fields = FormProperty::model()->findAllByAttributes(array('form_id'=>$_form->id));
				$fields = array();
				foreach ($actual_fields as $field) {
					if ($field->form_field_id != $model->form_field_id)
						$fields[] = $field->form_field_id;
				}
				$fields = join(",", $fields);
				if ($fields)
					$data = FormField::model()->findAll('process_id='.$process->id.' AND id NOT in ('.$fields.')',array('order' => 'name')); 
				else
					$data = FormField::model()->findAll('process_id='.$process->id,array('order' => 'name')); 
			?>
			<?php echo $form->dropDownList($model,'form_field_id', CHtml::listData($data, 'id', 'name'), array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'form_field_id'); ?>
		</div>
	</div>

	<div class="row">	
		<div class="col-md-6">
			<?php echo $form->labelEx($model,'visible'); ?>
			<?php echo $form->dropDownList($model,'visible', $model->visibleOptions, array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'visible'); ?>
		</div>
	</div>

	<div class="row">	
		<div class="col-md-6">
			<?php echo $form->labelEx($model,'required'); ?>
			<?php echo $form->dropDownList($model,'required', $model->requiredOptions, array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'required'); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?php echo $form->labelEx($model,'position'); ?>
			<?php echo $form->textField($model,'position',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'position'); ?>
		</div>
	</div>

	<?php echo $form->hiddenField($model,'form_id'); ?>

	<div class="form-group buttons">
		<a href="<?php echo Yii::app()->createUrl('formProperty/admin', array('form_id'=>$_form->id));?>" class="btn btn-default">Cancelar</a>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
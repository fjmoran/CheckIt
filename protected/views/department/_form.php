<?php
/* @var $this PositionController */
/* @var $model Position */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'department-form',
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
		<div class="form-group">
			<?php echo $form->labelEx($model,'name'); ?>
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'parent_id'); ?>
			<?php 
			if ($model->id) 
				$data = Department::model()->findAll('id<>'.$model->id,array('order' => 'name'));
			else
				$data = Department::model()->findAll(array('order' => 'name'));
			?>
			<?php echo $form->dropDownList($model,'parent_id', CHtml::listData($data, 'id', 'name'), array('empty'=>'Sin superior','class'=>'form-control')); ?>
			<?php echo $form->error($model,'parent_id'); ?>
		</div>

<?php if (!$model->isNewRecord): ?>
		<div class="form-group">
			<?php echo CHtml::label(Yii::app()->utility->getOption('manager_name'), 'user'); ?>
			<?php 
				$data = User::model()->findAll('department_id='.$model->id, array('empty'=>'Seleccione', 'order' => 'firstname, lastname'));
			?>
			<?php echo CHtml::dropDownList('user', $manager?$manager->id:'', CHtml::listData($data, 'id', 'fullname'), array('class'=>'form-control')); ?>
		</div>
<?php endif; ?>

	</div>
</div>

<div class="form-group buttons">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
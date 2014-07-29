<h2>Agregar usuario a <?php echo $department->name ?></h2>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'createuser-form',
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

<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<?php echo CHtml::label('Usuario', 'user'); ?>
			<?php 
				$data = User::model()->findAll('department_id!='.$department->id.' OR department_id IS NULL', array('order' => 'firstname, lastname'));
			?>
			<?php echo CHtml::dropDownList('user', '', CHtml::listData($data, 'id', 'fullname'), array('class'=>'form-control')); ?>
		</div>
	</div>
</div>

<div class="form-group buttons">
	<?php echo CHtml::submitButton('Agregar', array('class'=>'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
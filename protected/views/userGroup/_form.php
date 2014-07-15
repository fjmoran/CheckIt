<?php
/* @var $this UserGroupController */
/* @var $model UserGroup */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-group-form',
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
				<?php echo $form->labelEx($model,'user_id'); ?>
				<?php
					$actual_fields = UserGroup::model()->findAllByAttributes(array('group_id'=>$group->id));
					$fields = array();
					foreach ($actual_fields as $field) {
						if ($field->user_id != $model->user_id)
							$fields[] = $field->user_id;
					}
					$fields = join(",", $fields);
					if ($fields)
						$data = User::model()->findAll('id NOT in ('.$fields.')',array('order' => 'firstname ASC, lastname ASC')); 
					else
						$data = User::model()->findAll(array('order' => 'firstname ASC, lastname ASC')); 
				?>
				<?php echo $form->dropDownList($model,'user_id', CHtml::listData($data, 'id', 'fullname'), array('class'=>'form-control')); ?>
				<?php echo $form->error($model,'user_id'); ?>
			</div>
		</div>
	</div>

	<?php echo $form->hiddenField($model,'group_id'); ?>

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
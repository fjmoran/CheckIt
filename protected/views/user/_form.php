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
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<?php echo $form->labelEx($model,'department_id'); ?>
			<?php $data = Department::model()->findAll(array('order' => 'name')); ?>
			<?php echo $form->dropDownList($model,'department_id', CHtml::listData($data, 'id', 'name'), array('empty'=>'Seleccione una opción','class'=>'form-control')); ?>
			<?php echo $form->error($model,'department_id'); ?>
		</div>		

		<div class="form-group">
			<?php echo $form->labelEx($model,'status'); ?>
			<?php echo $form->dropDownList($model,'status', User::model()->statusOptions, array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'status'); ?>
		</div>		

		<div class="form-group">

			<div class="panel panel-info">
				<div class="panel-heading">Roles</div>
				<?php //echo $form->labelEx($model,'roles'); ?>
				<div class="panel-body">

					<?php ?>
					<span id="User_roleIDs">

					<?php 
					$User_roleIDs=0;
					Yii::app()->clientScript->registerScript('tooltip', '$(".showtooltip").tooltip(); ', CClientScript::POS_READY);
					$data = Role::model()->findAll(array('order'=>'pos ASC', 'condition'=>'type=0'));
					foreach ($data as $d):?>
						<input class="categoryFilter" id="User_roleIDs_<?php echo $User_roleIDs; ?>" value="<?php echo $d->id ?>" type="checkbox" name="User[roleIDs][]" <?php if (in_array($d->id, $model->roleIDs)):?>checked="checked"<?php endif;?>> 
							&nbsp;&nbsp;
							<label for="User_roleIDs_0">
								<?php echo $d->friendly_name.' &nbsp;&nbsp;<a style="text-decoration:none;" class="fa fa-question-circle showtooltip" data-toggle="tooltip" data-placement="right" title="'.$d->description.'"></a>'; ?>
							</label>
							<br />
					<?php $User_roleIDs++; endforeach; ?>

					</span>
					<?php  ?>

					<?php /*
					Yii::app()->clientScript->registerScript('tooltip', '$(".showtooltip").tooltip(); ', CClientScript::POS_READY);

					$data = Role::model()->findAll(array('order'=>'pos ASC', 'condition'=>'type=0'));
					$list = Array();
					foreach ($data as $d) {
						$list[$d->id] = $d->friendly_name.' &nbsp;&nbsp;<a style="text-decoration:none;" class="fa fa-question-circle showtooltip" data-toggle="tooltip" data-placement="right" title="'.$d->description.'"></a>';
					}
					echo CHtml::activeCheckBoxList(
						$model, 
						'roleIDs0', 
						$list,
						array(
							'template'=>'{input} &nbsp;&nbsp;{label}',
							'separator' =>'<br />',
							'class'=>'categoryFilter',
							//'checkAll'=>'Todos',
						)
					); */?>

					<a href="javascript:void(0);" onclick="$('#moreroles').toggle();">otros roles</a>
					<div id="moreroles" style="display: none;">

					<?php ?>
					<span id="User_roleIDs">

					<?php 
					$data = Role::model()->findAll(array('order'=>'pos ASC', 'condition'=>'type=1'));
					foreach ($data as $d):?>
						<input class="categoryFilter" id="User_roleIDs_<?php echo $User_roleIDs; ?>" value="<?php echo $d->id ?>" type="checkbox" name="User[roleIDs][]" <?php if (in_array($d->id, $model->roleIDs)):?>checked="checked"<?php endif;?>> 
							&nbsp;&nbsp;
							<label for="User_roleIDs_0">
								<?php echo $d->friendly_name.' &nbsp;&nbsp;<a style="text-decoration:none;" class="fa fa-question-circle showtooltip" data-toggle="tooltip" data-placement="right" title="'.$d->description.'"></a>'; ?>
							</label>
							<br />
					<?php $User_roleIDs++; endforeach; ?>

					</span>
					<?php  ?>

					<?php 
						/*$data = Role::model()->findAll(array('order'=>'pos ASC', 'condition'=>'type=1'));
						$list = Array();
						foreach ($data as $d) {
							$list[$d->id] = $d->friendly_name.' &nbsp;&nbsp;<a style="text-decoration:none;" class="fa fa-question-circle showtooltip" data-toggle="tooltip" data-placement="right" title="'.$d->description.'"></a>';
						}
						echo CHtml::activeCheckBoxList(
							$model, 
							'roleIDs1', 
							$list,
							array(
								'template'=>'{input} &nbsp;&nbsp;{label}',
								'separator' =>'<br />',
								'class'=>'categoryFilter',
								//'checkAll'=>'Todos',
							)
						);*/  ?>
					</div>
				</div>
			</div>

			<?php echo $form->error($model,'roles'); ?>
		</div>		
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
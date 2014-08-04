<?php if(Yii::app()->user->hasFlash('success')):?>
<div class="row">
	<div class="col-md-12 col-md-offset-0">
		<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<strong><?php echo Yii::app()->user->getFlash('success'); ?></strong>
		</div>
	</div>
</div>
<?php endif; ?>

<h2>Editar datos estratégicos</h2>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'option-form',
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

	<?php //echo $form->errorSummary($model); ?>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label for="Option_mision" class="control-label">Misión</label>
			<textarea rows="6" name="Option[mision]" id="Option_mision" class="form-control"><?php echo $data['mision']?></textarea>
		</div>
		<div class="form-group">
			<label for="Option_vision" class="control-label">Visión</label>
			<textarea rows="6" name="Option[vision]" id="Option_vision" class="form-control"><?php echo $data['vision']?></textarea>
		</div>
	</div>
</div>

<div class="form-group buttons">
	<?php echo CHtml::submitButton('Guardar', array('class'=>'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
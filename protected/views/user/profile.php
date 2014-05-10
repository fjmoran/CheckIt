<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h2>Mi perfil</h2>

<?php if (Yii::app()->user->hasFlash('message')):?>
    <div class="alert alert-success"><?php echo Yii::app()->user->getFlash('message');?></div>
<?php endif;?>

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

	<?php echo $form->errorSummary($model,'Por favor corrija los siguientes errores:','',array('class'=>'alert alert-danger')); ?>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'email'); ?>
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
			<?php echo $form->labelEx($model,'status'); ?>
			<?php echo $form->dropDownList($model,'status', User::model()->statusOptions, array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'status'); ?>
		</div>		

<h2>Cambiar password</h2>

		<div class="form-group">
			<?php echo $form->labelEx($model,'current_password'); ?>
			<?php echo $form->passwordField($model,'current_password',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'current_password'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'repeat_password'); ?>
			<?php echo $form->passwordField($model,'repeat_password',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'repeat_password'); ?>
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

<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Forgot Password';
$this->breadcrumbs=array(
	'Forgot Password',
);
?>

<div class="ck-login">
<?php if (Yii::app()->user->hasFlash('error')):?>
    <div class="alert alert-danger"><?php echo Yii::app()->user->getFlash('error');?></div>
<?php else: ?>

<?php if (Yii::app()->user->hasFlash('message')):?>
    <div class="alert alert-success"><?php echo Yii::app()->user->getFlash('message');?></div>
<?php else:?>
	<div class="row form-signin">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changepassword-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array(
        //'enctype' => 'multipart/form-data',
    	'role' => 'form',
		'autocomplete' => 'off',
    ),
)); ?>
        <h2 class="form-signin-heading">Cambiar contraseña</h2>
        <p>Ingrese su nueva contraseña.</p> 
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

	<div class="form-group buttons text-center">
		<?php echo CHtml::submitButton('Enviar', array('class'=>'btn btn-primary btn-block')); ?>
	</div>
    <?php $this->endWidget(); ?>
	</div>
<?php endif;?>
<?php endif;?>	
</div>

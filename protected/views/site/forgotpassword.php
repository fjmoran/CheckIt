<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Forgot Password';
$this->breadcrumbs=array(
	'Forgot Password',
);
?>

<div class="row">
	<div class="col-md-4 col-md-offset-4" id="login">

<h2>Recuperar contraseña</h2>

<?php if (Yii::app()->user->hasFlash('message')):?>
    <div class="alert alert-success"><?php echo Yii::app()->user->getFlash('message');?></div>
<?php endif;?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'forgotpassword-form',
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

	<div class="form-group">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="form-group buttons text-center">
		<?php echo CHtml::submitButton('Enviar', array('class'=>'btn btn-primary ')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

	</div>
</div>

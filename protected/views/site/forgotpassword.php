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
	<?php if (Yii::app()->user->hasFlash('message')):?>
    <div class="alert alert-success"><?php echo Yii::app()->user->getFlash('message');?></div>
<?php endif;?>
	<div class="row form-signin">

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
        <h2 class="form-signin-heading">Recuperar contraseña</h2>
        <p>Instrucciones para recuperar su contraseña serán enviadas a su correo electrónico.</p> 
	<div class="form-group">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="form-group buttons text-center">
		<?php echo CHtml::submitButton('Enviar', array('class'=>'btn btn-primary btn-block')); ?>
	</div>
    <?php $this->endWidget(); ?>
	</div>
</div>


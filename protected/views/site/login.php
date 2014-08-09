<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
/*$this->breadcrumbs=array(
	'Login',
);*/
?>

<div class="ck-login">
	<div class="row form-signin">

		<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
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
        <h2 class="form-signin-heading">Login</h2>
			<div class="form-group">
				<?php echo $form->labelEx($model,'username'); ?>
				<?php echo $form->textField($model,'username', array('class'=>'form-control')); ?>
				<?php echo $form->error($model,'username'); ?>
			</div>

			<div class="form-group">
				<?php echo $form->labelEx($model,'password'); ?>
				<?php echo $form->passwordField($model,'password', array('class'=>'form-control')); ?>
				<?php echo $form->error($model,'password'); ?>
			</div>

<?php if($model->scenario == 'captchaRequired'): ?>
			<div class="form-group">
				<?php echo CHtml::activeLabelEx($model,'verifyCode'); ?>
				<div>
				<?php $this->widget('CCaptcha'); ?>
				<?php echo CHtml::activeTextField($model,'verifyCode'); ?>
				</div>
				<div class="hint">Ingrese las letras de la imagen anterior.
				<br/>Respete mayúsculas y minúsculas.</div>
			</div>
<?php endif; ?>

			<div class="form-group rememberMe">
				<?php echo $form->checkBox($model,'rememberMe'); ?>
				<?php echo $form->label($model,'rememberMe'); ?>
				<?php echo $form->error($model,'rememberMe'); ?>
			</div>
        	<div class="form-group buttons text-center">
				<?php echo CHtml::submitButton('Ingresar', array('class'=>'btn btn-primary btn-block')); ?>
			</div>
        <a href="<?php echo Yii::app()->createUrl('site/forgotpassword') ?>">Recuperar contraseña</a> 
    <?php $this->endWidget(); ?>
	</div>
</div>

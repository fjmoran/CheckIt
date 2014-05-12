<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<<<<<<< HEAD

<div class="row">
	<div class="col-md-4 col-md-offset-4" id="login">

<h2>Login</h2>

<p></p>

<div class="form">
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

	<a href="<?php echo Yii::app()->createUrl('site/forgotpassword') ?>" class="pull-right">¿Olvidaste tu contraseña?</a>

	<div class="form-group rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="form-group buttons text-center">
		<?php echo CHtml::submitButton('Acceso', array('class'=>'btn btn-primary ')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

=======
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

			<div class="form-group rememberMe">
				<?php echo $form->checkBox($model,'rememberMe'); ?>
				<?php echo $form->label($model,'rememberMe'); ?>
				<?php echo $form->error($model,'rememberMe'); ?>
			</div>
        	<div class="form-group buttons text-center">
				<?php echo CHtml::submitButton('Ingresar', array('class'=>'btn btn-primary btn-block')); ?>
			</div>
        <a href="#recuperar">Recuperar contraseña</a> 
    <?php $this->endWidget(); ?>
>>>>>>> FETCH_HEAD
	</div>
</div>

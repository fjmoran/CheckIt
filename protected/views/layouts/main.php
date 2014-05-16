<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="language" content="es" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Gestión Estratégica y Cuadros de Mando Integrales">
	<meta name="author" content="Check!It">
	<link rel="shortcut icon" href="">

	<!-- Bootstrap core CSS -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/resources/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/checkit.css" rel="stylesheet">
	<!-- Fonts -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/fonts/fonts.css" rel="stylesheet" type="text/css">    

	<?php //if($this->route=='site/login') echo "<style>#inner-content {background: url('".Yii::app()->request->baseUrl."/images/3849.jpg'); background-size: 100%;}</style>";?>

	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<!-- <script src="<?php echo Yii::app()->request->baseUrl; ?>/resources/jquery/1.11.1/jquery.min.js"></script> -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/resources/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container-fluid" id="page">

		<div class="navbar navbar-inverse navbar-fixed-top bg-color" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo Yii::app()->createUrl('site/index')?>"><?php echo Yii::app()->utility->setTitle(); ?></a>
				</div>

	<?php if (!Yii::app()->user->isGuest) { ?>
				<div class="collapse navbar-collapse pull-right">
					<div class="btn-group btn-group-sm" id="btn-gr-login">
						<button type="button" class="btn dropdown-toggle" id="btn-login" data-toggle="dropdown">
							<?php echo Yii::app()->user->firstname." ".Yii::app()->user->lastname ?>
							&nbsp<i class="fa fa-chevron-down"></i>
						</button>
		<?php $this->widget('zii.widgets.CMenu',array(
			'htmlOptions'=>array(
				'id'=>'user-menu',
				'class'=>'dropdown-menu',
				'role'=>'menu',
			),
			'encodeLabel'=>false,
			'items'=>array(
				array('label'=>'Mi Perfil', 'url'=>array('/user/profile')),
				array('label'=>'', 'itemOptions'=>array('class'=>'divider')),
				array('label'=>'Logout', 'url'=>array('/site/logout')),
			),
		)); ?>
					</div>
				</div>
	<?php } ?>

				<div class="collapse navbar-collapse pull-right">
		<?php $this->widget('zii.widgets.CMenu',array(
			'htmlOptions'=>array(
				'class'=>'nav navbar-nav',
			),
			'encodeLabel'=>false,
			'items'=>array(
				array('label'=>'<i class="fa fa-dashboard fa-lg fa-fw"></i> Cuadro de Mando', 'url'=>array('/site/index'), 'visible'=>Yii::app()->user->checkAccess('dashboard'), 'active'=>Yii::app()->utility->isActiveMenu('dashboard')),
				array('label'=>'<i class="fa fa-inbox fa-lg fa-fw"></i> Flujos de Proceso', 'url'=>array('/site/page', 'view'=>'about'), 'visible'=>Yii::app()->user->checkAccess('process'), 'active'=>Yii::app()->utility->isActiveMenu('process')),
				array('label'=>'<i class="fa fa-briefcase fa-lg fa-fw"></i> Gestión Estratégica', 'url'=>array('/project/myprojects'), 'visible'=>Yii::app()->user->checkAccess('strategy'), 'active'=>Yii::app()->utility->isActiveMenu('strategy')),
				array('label'=>'<i class="fa fa-cogs fa-lg fa-fw"></i> Administración', 'url'=>array('/user/admin'), 'visible'=>Yii::app()->user->checkAccess('admin'), 'active'=>Yii::app()->utility->isActiveMenu('admin')),
			),
		)); ?>
				</div><!--/.nav-collapse -->
		</div>

	<?php /*if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif*/ ?>

			<div class="row bg-color" id="contenido">
				<?php echo $content; ?>
			</div>

		<div class="row" id="footer"> 
			<div class="col-md-12 bg-color">
				<p class="text-muted credit pull-right" style="padding-top: 10px;">
					<i class="fa fa-facebook-square"></i>
					&nbsp
					<i class="fa fa-twitter"></i>
					 | 2014 Check!It</p>
			</div>
		</div><!-- footer -->   

</div><!-- page -->

</body>
</html>

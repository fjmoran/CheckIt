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
    <!-- Custom styles for this template -->
    <link href="" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/resources/font-awesome/css/font-awesome.min.css">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Cuadro de Mando', 'url'=>array('/site/index'), 'visible'=>Yii::app()->user->checkAccess('dashboard')),
				array('label'=>'Flujos de Proceso', 'url'=>array('/site/page', 'view'=>'about'), 'visible'=>Yii::app()->user->checkAccess('process')),
				array('label'=>'Gestión Estratégica', 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->checkAccess('strategy')),
				array('label'=>'Administración', 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->checkAccess('admin')),
				//array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				//array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>

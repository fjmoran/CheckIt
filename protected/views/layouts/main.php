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

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
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
          <a class="navbar-brand" href="#">Check!It</a>
        </div>
        <div class="collapse navbar-collapse pull-right">
		<?php $this->widget('zii.widgets.CMenu',array(
			'htmlOptions'=>array(
				'class'=>'nav navbar-nav',
			),
			'encodeLabel'=>false,
			'items'=>array(
				array('label'=>'<i class="icon-dashboard icon-large icon-fixed-width"></i> Cuadro de Mando', 'url'=>array('/site/index'), 'visible'=>Yii::app()->user->checkAccess('dashboard')),
				array('label'=>'<i class="icon-inbox icon-large icon-fixed-width"></i> Flujos de Proceso', 'url'=>array('/site/page', 'view'=>'about'), 'visible'=>Yii::app()->user->checkAccess('process')),
				array('label'=>'<i class="icon-briefcase icon-large icon-fixed-width"></i> Gestión Estratégica', 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->checkAccess('strategy')),
				array('label'=>'<i class="icon-cogs icon-large icon-fixed-width"></i> Administración', 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->checkAccess('admin')),
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
        <p class="text-muted credit text-center">Aquí va el footer.</p>
      </div>
    </div><!-- footer -->   

</div><!-- page -->

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/resources/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/resources/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>

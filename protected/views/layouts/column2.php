<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
        <div id="sidebar-fixed">
		    <div class="sidebar-nav">
		      <div class="navbar navbar-default" role="navigation">
		        <div class="navbar-header">
		          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          <span class="visible-xs navbar-brand">Sidebar menu</span>
		        </div>
		        <div class="navbar-collapse collapse sidebar-navbar-collapse">
		<?php $this->widget('zii.widgets.CMenu',array(
			'htmlOptions'=>array(
				'class'=>'nav navbar-nav',
			),
			'encodeLabel'=>false,
			'items'=>array(
				array('label'=>'<i class="icon-dashboard icon-large icon-fixed-width"></i> Usuarios', 'url'=>array('/user/admin')),
				array('label'=>'<i class="icon-inbox icon-large icon-fixed-width"></i> Flujos de Proceso<span class="badge badge-red pull-right">42</span>', 'url'=>array('/site/page', 'view'=>'about'), 'visible'=>Yii::app()->user->checkAccess('process')),
				array('label'=>'<i class="icon-briefcase icon-large icon-fixed-width"></i> Gestión Estratégica', 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->checkAccess('strategy')),
				array('label'=>'<i class="icon-cogs icon-large icon-fixed-width"></i> Administración', 'url'=>array('/site/contact'), 'visible'=>Yii::app()->user->checkAccess('admin')),
			),
		)); ?>
		        </div><!--/.nav-collapse -->
		      </div>
		    </div>
        </div>
        <div class="col-md-offset-2 col-md-10 bg-colorlight" id="inner-content">
			<?php echo $content; ?>
        </div>


	<?php /*
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget(); */
	?>

<?php $this->endContent(); ?>
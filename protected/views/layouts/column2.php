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
		          <ul class="nav navbar-nav">
		            <li class="active"><a href="#"><i class="icon-dashboard icon-large icon-fixed-width"></i> Usuarios</a></li>
		            <li><a href="#"><i class="icon-inbox icon-large icon-fixed-width"></i> Procesos<span class="badge badge-red pull-right">42</span></a></li>
		            <li><a href="#"><i class="icon-briefcase icon-large icon-fixed-width"></i> Gestión Estratégica</a></li>
		            <li><a href="#"><i class="icon-cogs icon-large icon-fixed-width"></i> Administación</a></li>
		            <li><a href="#">Reviews <span class="badge pull-right badge-red">30</span></a></li>
		          </ul>
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
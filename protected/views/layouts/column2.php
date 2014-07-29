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
<?php 
if (Yii::app()->utility->isActiveMenu('admin')) {
	$this->widget('zii.widgets.CMenu',array(
		'htmlOptions'=>array(
			'class'=>'nav navbar-nav',
		),
		'encodeLabel'=>false,
		'items'=>array(
			array('label'=>'<i class="fa fa-user fa-lg fa-fw"></i> Usuarios', 'url'=>array('/user/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('user')),
			array('label'=>'<i class="fa fa-sitemap fa-lg fa-fw"></i> '.Yii::app()->utility->getOption('departments_name'), 'url'=>array('/department/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('department')),
			array('label'=>'<i class="fa fa-users fa-lg fa-fw"></i> Grupos', 'url'=>array('/group/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('group')),			
			array('label'=>'<i class="fa fa-list-ul fa-lg fa-fw"></i> '.Yii::app()->utility->getOption('projects_name'), 'url'=>array('/project/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('project')),
			array('label'=>'<i class="fa fa-clipboard fa-lg fa-fw"></i> '.Yii::app()->utility->getOption('subprojects_name'), 'url'=>array('/subproject/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('subproject')),
			array('label'=>'<i class="fa fa-tasks fa-lg fa-fw"></i> '.Yii::app()->utility->getOption('tasks_name'), 'url'=>array('/task/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('task')),
			array('label'=>'<i class="fa fa-sliders fa-lg fa-fw"></i> KPI', 'url'=>array('/kpi/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('kpi')),
			array('label'=>'<i class="fa fa-inbox fa-lg fa-fw"></i> Flujos de Proceso', 'url'=>array('/process/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('process')),
			array('label'=>'<i class="fa fa-code fa-lg fa-fw"></i> Parámetros', 'url'=>array('/option/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('option')),
		),
	)); 
}?>

<?php 
if (Yii::app()->utility->isActiveMenu('strategy')) {

	$alert_tasks = User::model()->find('id='.Yii::app()->user->id)->alertTasks;
	if ($alert_tasks==0) $alert_tasks='';

	$this->widget('zii.widgets.CMenu',array(
		'htmlOptions'=>array(
			'class'=>'nav navbar-nav',
		),
		'encodeLabel'=>false,
		'items'=>array(
			array('label'=>'<i class="fa fa-list-ul fa-lg fa-fw"></i> Mis '.Yii::app()->utility->getOption('projects_name').'<span class="badge badge-red pull-right">'.$alert_tasks.'</span>', 'url'=>array('/project/myprojects'), 'active'=>Yii::app()->utility->isActiveSubMenu('myprojects')),
		),
	)); 
}?>

<?php 
if (Yii::app()->utility->isActiveMenu('dashboard')) {

	//$alert_tasks = User::model()->find('id='.Yii::app()->user->id)->alertTasks;
	//if ($alert_tasks==0) $alert_tasks='';

	$this->widget('zii.widgets.CMenu',array(
		'htmlOptions'=>array(
			'class'=>'nav navbar-nav',
		),
		'encodeLabel'=>false,
		'items'=>array(
			array('label'=>'<i class="fa fa-user fa-lg fa-fw"></i> Reportes Estratégicos', 'url'=>array('/site/report'), 'active'=>Yii::app()->utility->isActiveSubMenu('sitereport')),
		),
	)); 
}?>

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
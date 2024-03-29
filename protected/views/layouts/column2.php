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

$is_manager = 0;
if (Yii::app()->user) {
	$user = User::model()->findByPk(Yii::app()->user->id);
	if ($user->manager) $is_manager = 1;
}

if (Yii::app()->utility->isActiveMenu('admin')) {
	$this->widget('zii.widgets.CMenu',array(
		'htmlOptions'=>array(
			'class'=>'nav navbar-nav',
		),
		'encodeLabel'=>false,
		'items'=>array(
			array('label'=>'<i class="fa fa-user fa-lg fa-fw"></i> Usuarios', 'url'=>array('/user/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('user'), 'visible'=>Yii::app()->user->checkAccess('admin,system_admin')),
			array('label'=>'<i class="fa fa-sitemap fa-lg fa-fw"></i> '.Yii::app()->utility->getOption('departments_name'), 'url'=>array('/department/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('department'), 'visible'=>Yii::app()->user->checkAccess('admin, system_admin')),
			array('label'=>'<i class="fa fa-users fa-lg fa-fw"></i> Grupos', 'url'=>array('/group/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('group'), 'visible'=>Yii::app()->user->checkAccess('admin, system_admin, workflow_admin')),
			array('label'=>'<i class="fa fa-university fa-lg fa-fw"></i> Misión y Visión', 'url'=>array('/option/strategydata'), 'active'=>Yii::app()->utility->isActiveSubMenu('strategydata'), 'visible'=>Yii::app()->user->checkAccess('admin, strategy_admin')),
			array('label'=>'<i class="fa fa-list-ul fa-lg fa-fw"></i> '.Yii::app()->utility->getOption('projects_name'), 'url'=>array('/project/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('project'), 'visible'=>Yii::app()->user->checkAccess('admin, strategy_admin')),
			array('label'=>'<i class="fa fa-clipboard fa-lg fa-fw"></i> '.Yii::app()->utility->getOption('subprojects_name'), 'url'=>array('/subproject/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('subproject'), 'visible'=>Yii::app()->user->checkAccess('admin, strategy_admin')),
			array('label'=>'<i class="fa fa-tasks fa-lg fa-fw"></i> '.Yii::app()->utility->getOption('tasks_name'), 'url'=>array('/task/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('task'), 'visible'=>Yii::app()->user->checkAccess('admin, strategy_admin')),
			array('label'=>'<i class="fa fa-sliders fa-lg fa-fw"></i> KPI', 'url'=>array('/kpi/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('kpi'), 'visible'=>Yii::app()->user->checkAccess('admin, strategy_admin')),
			array('label'=>'<i class="fa fa-inbox fa-lg fa-fw"></i> Flujos de Proceso', 'url'=>array('/process/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('process'), 'visible'=>Yii::app()->user->checkAccess('admin, workflow_admin')),
			array('label'=>'<i class="fa fa-code fa-lg fa-fw"></i> Parámetros', 'url'=>array('/option/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('option'), 'visible'=>Yii::app()->user->checkAccess('admin')),
		),
	)); 
}?>

<?php 
if (Yii::app()->utility->isActiveMenu('strategy')) {

	$alert_tasks = Yii::app()->utility->getAlertToDo();

	$this->widget('zii.widgets.CMenu',array(
		'htmlOptions'=>array(
			'class'=>'nav navbar-nav',
		),
		'encodeLabel'=>false,
		'items'=>array(
			array('label'=>'<i class="fa fa-university fa-lg fa-fw"></i> Misión y Visión', 'url'=>array('/project/strategydata'), 'active'=>Yii::app()->utility->isActiveSubMenu('strategydata')),
			array('label'=>'<i class="fa fa-list-ul fa-lg fa-fw"></i> Mis '.Yii::app()->utility->getOption('projects_name'), 'url'=>array('/project/myprojects'), 'active'=>Yii::app()->utility->isActiveSubMenu('myprojects')),
			array('label'=>'<i class="fa fa-clock-o fa-lg fa-fw"></i> Mis Tareas '.'<span class="badge badge-red pull-right">'.$alert_tasks.'</span>', 'url'=>array('/project/todo'), 'active'=>Yii::app()->utility->isActiveSubMenu('todo')),
			array('label'=>'<i class="fa fa-check-square-o fa-lg fa-fw"></i> Terminados', 'url'=>array('/project/completed'), 'active'=>Yii::app()->utility->isActiveSubMenu('completed')),
			array('label'=>'<i class="fa fa-users fa-lg fa-fw"></i> Mi Equipo', 'url'=>array('/project/myteam'), 'active'=>Yii::app()->utility->isActiveSubMenu('myteam'), 'visible'=>$is_manager),
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
		'items'=>$this->menu,
		//'items'=>Yii::app()->utility->getReportMenu(),
	)); 
}?>

		        </div><!--/.nav-collapse -->
		      </div>
		    </div>
        </div>
        <div class="col-md-offset-2 col-md-10 bg-colorlight" id="inner-content">

        	<?php if(isset($this->breadcrumbs)):
				//if ( Yii::app()->controller->route !== 'site/index' )
					//$this->breadcrumbs = array_merge(array (Yii::t('zii','Home')=>Yii::app()->homeUrl), $this->breadcrumbs);

					$this->widget('zii.widgets.CBreadcrumbs', array(
						'links'=>$this->breadcrumbs,
						'homeLink'=>false,
						'tagName'=>'ol',
						'separator'=>'',
						'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
						'inactiveLinkTemplate'=>'<li class="active">{label}</li>',
						'htmlOptions'=>array ('class'=>'breadcrumb')
				)); ?><!-- breadcrumbs -->
		    <?php endif; ?>

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
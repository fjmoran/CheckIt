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
			array('label'=>'<i class="fa fa-tags fa-lg fa-fw"></i> Cargos', 'url'=>array('/position/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('position')),
			array('label'=>'<i class="fa fa-list-ul fa-lg fa-fw"></i> '.Yii::app()->utility->getOption('projects_name'), 'url'=>array('/project/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('project')),
			array('label'=>'<i class="fa fa-clipboard fa-lg fa-fw"></i> '.Yii::app()->utility->getOption('subprojects_name'), 'url'=>array('/subproject/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('subproject')),
			array('label'=>'<i class="fa fa-tasks fa-lg fa-fw"></i> '.Yii::app()->utility->getOption('tasks_name'), 'url'=>array('/task/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('task')),
			array('label'=>'<i class="fa fa-code fa-lg fa-fw"></i> Parámetros', 'url'=>array('/option/admin'), 'active'=>Yii::app()->utility->isActiveSubMenu('option')),
		),
	)); 
}?>

<?php 
if (Yii::app()->utility->isActiveMenu('strategy')) {

	$alert_tasks = '';
	$position_id = User::model()->find('id='.Yii::app()->user->id)->position_id;

	if ($position_id) {

		$rows = Yii::app()->db->createCommand()
			->select('count(*) as q')
			->from('task t')
			->join('subproject s','t.subproject_id = s.id')
			->join('project p', 's.project_id = p.id')
			->where('p.position_id=:id AND t.status=0 AND t.due_date<NOW() + INTERVAL 15 DAY', array(':id'=>$position_id))
			//->order('j.jobno,j.projid')
			->queryRow();
		$alert_tasks = $rows['q'];
		if ($alert_tasks==0) $alert_tasks='';
	}


	$this->widget('zii.widgets.CMenu',array(
		'htmlOptions'=>array(
			'class'=>'nav navbar-nav',
		),
		'encodeLabel'=>false,
		'items'=>array(
			array('label'=>'<i class="fa fa-user fa-lg fa-fw"></i> Mis '.Yii::app()->utility->getOption('projects_name').'<span class="badge badge-red pull-right">'.$alert_tasks.'</span>', 'url'=>array('/project/myprojects'), 'active'=>Yii::app()->utility->isActiveSubMenu('myprojects')),
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
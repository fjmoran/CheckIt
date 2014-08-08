<?php
class Utility extends CApplicationComponent
{
	public function isActiveSubMenu($menu_id = null)
	{
		if ($this->getMenu(2) == $menu_id) return true;
		return false;
	}

	public function setTitle() {
		$title = 'Check!It';
		$title.= $this->getMenu(3);
		return $title;
	}

	public function isActiveMenu($menu_id = null) {
		if ($this->getMenu(1) == $menu_id) return true;
		return false;
	}

	protected function getMenu($level=1) {
		$controller = Yii::app()->getController()->id;
		$action = Yii::app()->getController()->getAction()->id;

		if ($controller=='user' && $action!='profile') {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'user';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='department') {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'department';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='option' && $action!='strategydata') {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'option';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='project' && ($action!='myprojects' && $action!='view' && $action!='strategydata' && $action!='todo' && $action!='completed' && $action!='myteam')) {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'project';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='subproject') {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'subproject';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='task') {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'task';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='kpi') {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'kpi';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='process') {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'process';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='form') {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'process';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='formField') {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'process';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='formProperty') {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'process';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='formFieldOption') {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'process';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='processTask') {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'process';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='group') {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'group';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='userGroup') {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'group';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='site' && $action=='admin') {
			if ($level == 1) return 'admin';
			if ($level == 2) return '';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='option' && $action=='strategydata') {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'strategydata';
			if ($level == 3) return ' - Administración';
		}





		if ($controller=='project' && ($action=='myprojects' || $action=='view')) {
			if ($level == 1) return 'strategy';
			if ($level == 2) return 'myprojects';
			if ($level == 3) return ' - Gestión Estratégica';
		}

		if ($controller=='project' && ($action=='strategydata')) {
			if ($level == 1) return 'strategy';
			if ($level == 2) return 'strategydata';
			if ($level == 3) return ' - Gestión Estratégica';
		}

		if ($controller=='project' && ($action=='todo')) {
			if ($level == 1) return 'strategy';
			if ($level == 2) return 'todo';
			if ($level == 3) return ' - Gestión Estratégica';
		}

		if ($controller=='project' && ($action=='completed')) {
			if ($level == 1) return 'strategy';
			if ($level == 2) return 'completed';
			if ($level == 3) return ' - Gestión Estratégica';
		}

		if ($controller=='project' && ($action=='myteam')) {
			if ($level == 1) return 'strategy';
			if ($level == 2) return 'myteam';
			if ($level == 3) return ' - Gestión Estratégica';
		}





		if ($controller=='site' && ($action=='report')) {
			if ($level == 1) return 'dashboard';
			if ($level == 2) return 'sitereport';
			if ($level == 3) return ' - Cuadro de Mando';
		}


		return '';    
	}

	public function getOption($name) {
		$data = Option::model()->find("name='$name'");
		if ($data) return $data->value;
		return null;
	}

	public function setOption($name, $value) {
		$data = Option::model()->find("name='$name'");
		if ($data) {
			$data->value = $value;
			return $data->save();
		}
		return null;
	}

	public function getTabs($data = array()) {
		echo '	<ul class="nav nav-tabs" role="tablist">
					<li '.$this->getTabsData('process').'><a href="'.Yii::app()->createUrl('process/view', array('id'=>$data['id'])).'" role="tab">Modelador</a></li>
					<li '.$this->getTabsData('form').'><a href="'.Yii::app()->createUrl('form/admin', array('process_id'=>$data['id'])).'" role="tab">Formularios</a></li>
					<li '.$this->getTabsData('field').'><a href="'.Yii::app()->createUrl('formField/admin', array('process_id'=>$data['id'])).'" role="tab">Campos</a></li>					
				</ul>';		
	}

	private function getTabsData($level) {
		$controller = Yii::app()->getController()->id;
		$action = Yii::app()->getController()->getAction()->id;

		$ret = 0;

		if ($controller=='form' || $controller=='formProperty') {
			if ($level == 'form') $ret = 1;
		}

		if ($controller=='formField' || $controller=='formFieldOption') {
			if ($level == 'field') $ret = 1;
		}

		if ($controller=='process' || $controller=='processTask') {
			if ($level == 'process') $ret = 1;
		}

		if ($ret) return 'class="active"';
		return '';

	}

	public function getAlertToDo() {

		$alert_tasks = 0;
		$user = User::model()->findByPk(Yii::app()->user->id);

		$rows = Yii::app()->db->createCommand()
			->select('count(*) as q')
			->from('task t')
			->where('t.status=0 AND t.due_date<NOW() AND t.user_id=:user_id', array(':user_id'=>Yii::app()->user->id))
			//->where('t.status=0 AND t.due_date<NOW() + INTERVAL 15 DAY', array(':id'=>$department_id))
			//->order('j.jobno,j.projid')
			->queryRow();
		$alert_tasks = $alert_tasks + $rows['q'];

		$rows = Yii::app()->db->createCommand()
			->select('count(*) as q')
			->from('kpi t')
			->where('t.next_due_date<NOW() AND t.user_id=:user_id', array(':user_id'=>Yii::app()->user->id))
			->queryRow();
		$alert_tasks = $alert_tasks + $rows['q'];

		if ($user && $user->manager==1) {
			$department_id = $user->department_id;
			$rows = Yii::app()->db->createCommand()
				->select('count(*) as q')
				->from('task t')
				->where('t.status=0 AND t.due_date<NOW() AND t.department_id=:department_id', array(':department_id'=>$department_id))
				->queryRow();
			$alert_tasks = $alert_tasks + $rows['q'];

			$rows = Yii::app()->db->createCommand()
				->select('count(*) as q')
				->from('kpi t')
				->where('t.next_due_date<NOW() AND t.department_id=:department_id', array(':department_id'=>$department_id))
				->queryRow();
			$alert_tasks = $alert_tasks + $rows['q'];
		}

		if ($alert_tasks==0) $alert_tasks='';
		return $alert_tasks;
	}

	public function getStatusColor($compliance) {

		//1: rojo ; 2: amarillo; 3: verde

		$is_yellow = Yii::app()->utility->getOption('kpi_yellow');
		$is_red = Yii::app()->utility->getOption('kpi_red');

		if ($compliance < $is_red) return 1;
		if ($compliance < $is_yellow) return 2;
		return 3;

	}

}

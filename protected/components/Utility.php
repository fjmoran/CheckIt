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
		if ($controller=='position') {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'position';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='option') {
			if ($level == 1) return 'admin';
			if ($level == 2) return 'option';
			if ($level == 3) return ' - Administración';
		}
		if ($controller=='project' && ($action!='myprojects' && $action!='view')) {
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



		if ($controller=='project' && ($action=='myprojects' || $action=='view')) {
			if ($level == 1) return 'strategy';
			if ($level == 2) return 'myprojects';
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
		return Option::model()->find("name='$name'")->value;
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

}

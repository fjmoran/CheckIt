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
		if ($controller=='project') {
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

		return '';    
	}

	public function getOption($name) {
		return Option::model()->find("name='$name'")->value;
	}

}

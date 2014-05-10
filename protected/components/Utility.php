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
      if ($level == 2) return 'usuarios';
      if ($level == 3) return ' - Administración';
    }

    return '';    
  }

}

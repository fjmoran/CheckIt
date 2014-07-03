<?php 
$cs=Yii::app()->clientScript;
$cs->scriptMap = array('jquery.js'=>false,);

$this->renderPartial('_form', array('model'=>$model));

/*
$c = $this->renderPartial('_form', array('model'=>$model), true, true); 
$a = explode('<form',$c);
$c = $a[1];
echo "<form".$c;*/
?>
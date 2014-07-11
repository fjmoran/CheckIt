<h2>Proceso: <?php echo $process->name; ?></h2>

<?php echo Yii::app()->utility->getTabs(array('id'=>$process->id)); ?>

<div class="tab-content">
  <div class="tab-pane active">

  	<h3>Editar actividad <?php echo $model->name ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model, 'process'=>$process, 'step'=>$step)); ?>

	</div>
</div>

<?php 
//$cs=Yii::app()->clientScript;
//$cs->scriptMap = array('jquery.js'=>false,);

//$this->renderPartial('_form', array('model'=>$model, 'step'=>$step));

/*
$c = $this->renderPartial('_form', array('model'=>$model), true, true); 
$a = explode('<form',$c);
$c = $a[1];
echo "<form".$c;*/
?>
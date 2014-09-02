<?php
/* @var $this KpiController */
/* @var $model Kpi */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array(
		//'enctype' => 'multipart/form-data',
		'role' => 'form',
	),
)); ?>

	<div class="form-group">
		<?php echo $form->label($model,'subproject_id'); ?>
		<?php 
			$r = array();
			foreach ($subprojects as $d) {
				$r[$d->id] = $d->project->name." > ".$d->name;
			}
		?>
		<?php echo $form->dropDownList($model,'subproject_id', $r, array('class'=>'form-control dependent')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
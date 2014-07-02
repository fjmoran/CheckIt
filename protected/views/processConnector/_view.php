<?php
/* @var $this ProcessConnectorController */
/* @var $data ProcessConnector */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('source_task_id')); ?>:</b>
	<?php echo CHtml::encode($data->source_task_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('target_task_id')); ?>:</b>
	<?php echo CHtml::encode($data->target_task_id); ?>
	<br />


</div>
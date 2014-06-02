<?php
/* @var $this KpiController */
/* @var $data Kpi */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subproject_id')); ?>:</b>
	<?php echo CHtml::encode($data->subproject_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('frequency')); ?>:</b>
	<?php echo CHtml::encode($data->frequency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('base_date')); ?>:</b>
	<?php echo CHtml::encode($data->base_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('goal_date')); ?>:</b>
	<?php echo CHtml::encode($data->goal_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('base_value')); ?>:</b>
	<?php echo CHtml::encode($data->base_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('goal_value')); ?>:</b>
	<?php echo CHtml::encode($data->goal_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit')); ?>:</b>
	<?php echo CHtml::encode($data->unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('real_value')); ?>:</b>
	<?php echo CHtml::encode($data->real_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('limit_red')); ?>:</b>
	<?php echo CHtml::encode($data->limit_red); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('limit_yellow')); ?>:</b>
	<?php echo CHtml::encode($data->limit_yellow); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('limit_green')); ?>:</b>
	<?php echo CHtml::encode($data->limit_green); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position_id')); ?>:</b>
	<?php echo CHtml::encode($data->position_id); ?>
	<br />

	*/ ?>

</div>
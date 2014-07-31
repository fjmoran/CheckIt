<?php
/* @var $this KpiController */
/* @var $model Kpi */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kpi-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		//'enctype' => 'multipart/form-data',
		'role' => 'form',
		'autocomplete' => 'off',
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<?php echo $form->labelEx($model,'name'); ?>
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'calculation'); ?>
			<?php echo $form->textArea($model,'calculation',array('size'=>60,'maxlength'=>1000,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'calculation'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,Yii::app()->utility->getOption('subproject_name')); ?>
			<?php 
			$data = Subproject::model()->findAll(array('order' => 'project_id,name'));
			$listdata;
			foreach ($data as $sp) {
				$listdata[$sp->id] = $sp->project->name . " > " . $sp->name;
			} 
			?>
			<?php echo $form->dropDownList($model,'subproject_id', $listdata, array('class'=>'form-control dependent')); ?>
			<?php echo $form->error($model,'subproject_id'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'frequency'); ?>
			<?php echo $form->textField($model,'frequency',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'frequency'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'base_date'); ?>
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'name'=>'Kpi_base_date',
				'model'=>$model,
				'attribute'=>'base_date',
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat'=>'yy-mm-dd',
					'jqueryOption'=>'jqueryOptionValue',
				),
				'htmlOptions'=>array(
					'class'=>'form-control',
				),
				)
			);
			?>
			<?php echo $form->error($model,'base_date'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'goal_date'); ?>
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'name'=>'Kpi_goal_date',
				'model'=>$model,
				'attribute'=>'goal_date',
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat'=>'yy-mm-dd',
					'jqueryOption'=>'jqueryOptionValue',
				),
				'htmlOptions'=>array(
					'class'=>'form-control',
				),
				)
			);
			?>
			<?php echo $form->error($model,'goal_date'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'base_value'); ?>
			<?php echo $form->textField($model,'base_value',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'base_value'); ?>
		</div>
	</div>

	<div class="col-md-6">
<div class="form-group">
			<?php echo $form->labelEx($model,'goal_value'); ?>
			<?php echo $form->textField($model,'goal_value',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'goal_value'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'unit'); ?>
			<?php echo $form->textField($model,'unit',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'unit'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'real_value'); ?>
			<?php echo $form->textField($model,'real_value',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'real_value'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'department_id'); ?>
			<?php $data = Department::model()->findAll(array('order' => 'name')); ?>
			<?php echo $form->dropDownList($model,'department_id', CHtml::listData($data, 'id', 'name'), array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'department_id'); ?>
		</div>
	</div>	
</div>

<div class="form-group buttons">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
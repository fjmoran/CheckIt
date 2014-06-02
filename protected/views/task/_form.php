<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $form CActiveForm */

if ($model->start_date=='') $model->start_date=date('Y-m-d');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-form',
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
			<?php echo $form->labelEx($model,'position_id'); ?>
			<?php $data = Position::model()->findAll(array('order' => 'name')); ?>
			<?php echo $form->dropDownList($model,'position_id', CHtml::listData($data, 'id', 'name'), array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'position_id'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'start_date'); ?>
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'name'=>'Agenda_start_date',
				'model'=>$model,
				'attribute'=>'start_date',
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
			<?php echo $form->error($model,'start_date'); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'due_date'); ?>
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'name'=>'Agenda_due_date',
				'model'=>$model,
				'attribute'=>'due_date',
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
			<?php echo $form->error($model,'due_date'); ?>
		</div>
	</div>
</div>

<div class="form-group buttons">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
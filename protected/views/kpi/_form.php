<?php
/* @var $this KpiController */
/* @var $model Kpi */
/* @var $form CActiveForm */
?>

<?php
Yii::app()->clientScript->registerScript('dependent_parent', "
$('.select-level').change(function(){
	var url = '".Yii::app()->createUrl('kpi/ajaxKpi')."';
	if ($(this).val()) {
		$.post(url, {subproject_id: $(this).val(), this: '".$model->id."'}, function(data) {
			$('#Kpi_parent_id').find('option').remove().end().append('<option value=\"\">Ninguno</option>').append(data);
			//html(data);
		});
	}
});
", CClientScript::POS_LOAD);

if ($model->subproject_id) {
	Yii::app()->clientScript->registerScript('dependent_parent_init', "
		var url = '".Yii::app()->createUrl('kpi/ajaxKpi')."';
		$.post(url, {subproject_id: ".$model->subproject_id.", this: '".$model->id."'}, function(data) {
			$('#Kpi_parent_id').find('option').remove().end().append('<option value=\"\">Ninguno</option>').append(data).val(".$model->parent()->find()->id.");
			//html(data);
		});
	", CClientScript::POS_LOAD);
}
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

<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#basic" role="tab" data-toggle="tab">Datos básicos</a></li>
  <li><a href="#values" role="tab" data-toggle="tab">Fechas y valores</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  	<div class="tab-pane active" id="basic">
		<div class="row" style="padding-top: 15px;">	
			<div class="col-md-6">
				<div class="form-group">
					<?php echo $form->labelEx($model,'name'); ?>
					<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
					<?php echo $form->error($model,'name'); ?>
				</div>
				<div class="form-group">
					<?php echo $form->labelEx($model,Yii::app()->utility->getOption('subproject_name')); ?>
					<?php 
					$data = Subproject::model()->with('project')->findAll(array('order' => 'project.name,t.name'));
					$listdata;
					foreach ($data as $sp) {
						$listdata[$sp->id] = $sp->project->name . " > " . $sp->name;
					} 
					?>
					<?php echo $form->dropDownList($model,'subproject_id', $listdata, array('class'=>'form-control dependent', 'empty'=>'')); ?>
					<?php echo $form->error($model,'subproject_id'); ?>
				</div>
				<div class="form-group">
					<?php echo $form->labelEx($model,'parent_id'); ?>
					<?php echo $form->dropDownList($model,'parent_id', array(), array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'parent_id'); ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<?php echo $form->labelEx($model,'department_id'); ?>
					<?php $data = Department::model()->findAll(array('order' => 'name')); ?>
					<?php echo $form->dropDownList($model,'department_id', CHtml::listData($data, 'id', 'name'), array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'department_id'); ?>
				</div>
				<div class="form-group">
					<?php echo $form->labelEx($model,'calculation'); ?>
					<?php echo $form->textArea($model,'calculation',array('rows'=>3,'size'=>60,'maxlength'=>1000,'class'=>'form-control')); ?>
					<?php echo $form->error($model,'calculation'); ?>
				</div>
				<div class="form-group">
					<?php echo $form->labelEx($model,'update_frequency'); ?>
					<?php echo $form->dropDownList($model,'update_frequency', $model->updateFrequencyOptions, array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'update_frequency'); ?>
				</div>
				<div class="form-group">
					<?php echo $form->labelEx($model,'review_frequency'); ?>
					<?php echo $form->dropDownList($model,'review_frequency', $model->reviewFrequencyOptions, array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'review_frequency'); ?>
				</div>
			</div>			  	
		</div>	
  	</div>
  	<div class="tab-pane" id="values">
		<div class="row" style="padding-top: 15px;">	
			<div class="col-md-6">
				<div class="form-group">
					<?php echo $form->labelEx($model,'unit'); ?>
					<?php echo $form->textField($model,'unit',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
					<?php echo $form->error($model,'unit'); ?>
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
					<?php echo $form->labelEx($model,'measuring'); ?>
					<?php echo $form->dropDownList($model,'measuring', $model->measuringOptions, array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'measuring'); ?>
				</div>
			</div>
			<div class="col-md-6">	
				<div class="form-group">
					<?php echo $form->labelEx($model,'weight'); ?>
					<?php echo $form->textField($model,'weight',array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'weight'); ?>
				</div>
				<div class="form-group">
					<?php echo $form->labelEx($model,'base_value'); ?>
					<?php echo $form->textField($model,'base_value',array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'base_value'); ?>
				</div>
				<div class="form-group">
					<?php echo $form->labelEx($model,'goal_value'); ?>
					<?php echo $form->textField($model,'goal_value',array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'goal_value'); ?>
				</div>
				<div class="form-group">
					<?php echo $form->labelEx($model,'function'); ?>
					<?php echo $form->dropDownList($model,'function', $model->functionOptions, array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'function'); ?>
				</div>
			</div>			  	
		</div>
  	</div>
</div>

<div class="form-group buttons">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
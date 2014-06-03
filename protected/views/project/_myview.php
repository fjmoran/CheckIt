<?php
/* @var $this ProjectController */
/* @var $data Project */
?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="panel-title">
				<a href="<?php echo Yii::app()->createUrl('project/view',array('id'=>$data->id)); ?>">
					<?php echo CHtml::encode($data->name); ?>

					<?php
						$subproject_ids = join(',',$data->subprojectIDs);
						if ($subproject_ids) {
							$expired_tasks = count(Task::model()->findAll('subproject_id IN ('.$subproject_ids.') AND status=0 AND due_date<NOW()'));
							$next_tasks = count(Task::model()->findAll('subproject_id IN ('.$subproject_ids.') AND status=0 AND due_date<NOW() + INTERVAL 15 DAY AND due_date>=NOW()'));
							$red_kpis = count(Kpi::model()->findAll('subproject_id IN ('.$subproject_ids.') AND ((base_value<goal_value AND real_value<limit_yellow) OR (base_value>goal_value AND real_value>limit_yellow))'));
							$yellow_kpis = count(Kpi::model()->findAll('subproject_id IN ('.$subproject_ids.') AND ((base_value<goal_value AND real_value<limit_green AND real_value>=limit_yellow) OR (base_value>goal_value AND real_value>limit_green AND real_value<=limit_yellow))'));
					?>

				</a>
			</h2>
		</div>

		<table class="table table-condensed">
		<tr>
			<th style="width: 50%;">KPIs</th>
			<th style="width: 50%;"><?php echo Yii::app()->utility->getOption('tasks_name'); ?></th>
		</tr>
		<tr>
			<?php if ($red_kpis+$yellow_kpis>0) { ?>
				<td style="padding: 15px;">
					<?php 
					if ($yellow_kpis > '1') { ?>
					<span class="label label-warning"><?php echo $yellow_kpis;?> Amarillos</span>
					<?php 
					} 
					if ($yellow_kpis == '1') { ?>
					<span class="label label-warning"><?php echo $yellow_kpis;?> Amarillo</span>							
					<?php } ?>	

					<?php if ($red_kpis > '1') { ?>
					<span class="label label-danger"><?php echo $red_kpis;?> Rojos</span>
					<?php 
					} 
					if ($red_kpis == '1') { ?>
					<span class="label label-danger"><?php echo $red_kpis;?> Rojo</span>
					<?php } ?>
				</td>
			<?php } ?>
			<?php if ($red_kpis+$yellow_kpis<=0) { ?>
				<td style="padding: 15px;">
					No tiene KPIs con alerta.
				</td>	
			<?php } ?>	
			<?php if ($expired_tasks+$next_tasks>0) { ?>
				<td style="padding: 15px;">	
					<?php 
					if ($next_tasks > '1') { ?>
					<span class="label label-warning"><?php echo $next_tasks;?> Próximos</span>
					<?php 
					} 
					if ($next_tasks == '1') { ?>
					<span class="label label-warning"><?php echo $next_tasks;?> Próximo</span>							
					<?php } ?>	

					<?php if ($expired_tasks > '1') { ?>
					<span class="label label-danger"><?php echo $expired_tasks;?> Vencidos</span>
					<?php 
					} 
					if ($expired_tasks == '1') { ?>
					<span class="label label-danger"><?php echo $expired_tasks;?> Vencido</span>
					<?php } ?>
				</td>
			<?php } ?>
			<?php if ($expired_tasks+$next_tasks<=0) { ?>
				<td style="padding: 15px;">
					No tiene tareas con alerta.
				</td>	
			<?php } ?>	
		</tr>	
		</table>	
						<?php } ?>
	</div>	

<?php
/* @var $this ProjectController */
/* @var $data Project */
?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
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

						<div class="pull-right">
							<?php if ($expired_tasks+$next_tasks>0) { ?>
								<b><?php echo Yii::app()->utility->getOption('tasks_name'); ?>:</b>
							<?php } ?>
							<?php 
							if ($next_tasks > '1') { ?>
							<span class="label label-warning"><?php echo $next_tasks;?> Próximas</span>
							<?php 
							} 
							if ($next_tasks == '1') { ?>
							<span class="label label-warning"><?php echo $next_tasks;?> Próxima</span>							
							<?php } ?>	

							<?php if ($expired_tasks > '1') { ?>
							<span class="label label-danger"><?php echo $expired_tasks;?> Vencidas</span>
							<?php 
							} 
							if ($expired_tasks == '1') { ?>
							<span class="label label-danger"><?php echo $expired_tasks;?> Vencida</span>
							<?php } ?>

							<?php if ($red_kpis+$yellow_kpis>0) { ?>
								<b>KPIs:</b>
							<?php } ?>
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

						</div>
						<?php } ?>
				</a>
			</h4>
		</div>
	</div>

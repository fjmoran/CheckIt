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
					?>

						<div class="pull-right">
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
						</div>
						<?php } ?>
				</a>
			</h4>
		</div>
	</div>

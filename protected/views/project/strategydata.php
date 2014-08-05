<h2><?php echo Yii::app()->utility->getOption('company_name'); ?></h2>

<?php if ($mision): ?>
<br>	
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Misión</h3>
  </div>
  <div class="panel-body">
    <?php echo $mision; ?>
  </div>
</div>
<?php endif; ?>

<?php if ($mision): ?>
<br>	
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Visión</h3>
  </div>
  <div class="panel-body">
    <?php echo $vision; ?>
  </div>
</div>
<?php endif; ?>

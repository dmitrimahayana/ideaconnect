<?php
/* @var $this TimeLimitController */
/* @var $data TimeLimit */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('month_limit')); ?>:</b>
	<?php echo CHtml::encode($data->month_limit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_funding_time')); ?>:</b>
	<?php echo CHtml::encode($data->is_funding_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_actived')); ?>:</b>
	<?php echo CHtml::encode($data->is_actived); ?>
	<br />


</div>
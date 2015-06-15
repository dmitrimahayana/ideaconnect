<?php
/* @var $this ProjectChargeController */
/* @var $data ProjectCharge */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_percentage')); ?>:</b>
	<?php echo CHtml::encode($data->is_percentage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('value')); ?>:</b>
	<?php echo CHtml::encode($data->value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_actived')); ?>:</b>
	<?php echo CHtml::encode($data->is_actived); ?>
	<br />


</div>
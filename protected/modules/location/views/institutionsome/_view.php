<?php
/* @var $this InstitutionSomeController */
/* @var $data InstitutionSome */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('province_id')); ?>:</b>
	<?php echo CHtml::encode($data->province_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('regency_id')); ?>:</b>
	<?php echo CHtml::encode($data->regency_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('institution_phone_number')); ?>:</b>
	<?php echo CHtml::encode($data->institution_phone_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_position')); ?>:</b>
	<?php echo CHtml::encode($data->job_position); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	*/ ?>

</div>
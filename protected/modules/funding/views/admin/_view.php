<?php
/* @var $this FundingUserController */
/* @var $data FundingUser */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sponsor_id')); ?>:</b>
	<?php echo CHtml::encode($data->sponsor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sponsor_name')); ?>:</b>
	<?php echo CHtml::encode($data->sponsor_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requisite_id')); ?>:</b>
	<?php echo CHtml::encode($data->requisite_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('as_institution_id')); ?>:</b>
	<?php echo CHtml::encode($data->as_institution_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('as_institution_name')); ?>:</b>
	<?php echo CHtml::encode($data->as_institution_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_from_number')); ?>:</b>
	<?php echo CHtml::encode($data->account_from_number); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('bank_from_id')); ?>:</b>
	<?php echo CHtml::encode($data->bank_from_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bank_from_name')); ?>:</b>
	<?php echo CHtml::encode($data->bank_from_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_to_id')); ?>:</b>
	<?php echo CHtml::encode($data->account_to_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_to_number')); ?>:</b>
	<?php echo CHtml::encode($data->account_to_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('value')); ?>:</b>
	<?php echo CHtml::encode($data->value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit')); ?>:</b>
	<?php echo CHtml::encode($data->unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_verified')); ?>:</b>
	<?php echo CHtml::encode($data->is_verified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('varificator_id')); ?>:</b>
	<?php echo CHtml::encode($data->varificator_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('verification_time')); ?>:</b>
	<?php echo CHtml::encode($data->verification_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('had_been_returned')); ?>:</b>
	<?php echo CHtml::encode($data->had_been_returned); ?>
	<br />

	*/ ?>

</div>
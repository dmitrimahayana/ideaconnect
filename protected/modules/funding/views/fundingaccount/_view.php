<?php
/* @var $this FundingAccountController */
/* @var $data FundingAccount */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bank_id')); ?>:</b>
	<?php echo CHtml::encode($data->bank_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_number')); ?>:</b>
	<?php echo CHtml::encode($data->account_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_name_alias')); ?>:</b>
	<?php echo CHtml::encode($data->owner_name_alias); ?>
	<br />


</div>
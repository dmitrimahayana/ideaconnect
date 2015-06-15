<?php
/* @var $this MessegeController */
/* @var $data Messege */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject')); ?>:</b>
	<?php echo CHtml::encode($data->subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('messege')); ?>:</b>
	<?php echo CHtml::encode($data->messege); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('from_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->from_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('from_user_name')); ?>:</b>
	<?php echo CHtml::encode($data->from_user_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('to_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->to_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('to_user_name')); ?>:</b>
	<?php echo CHtml::encode($data->to_user_name); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_read')); ?>:</b>
	<?php echo CHtml::encode($data->is_read); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sent_time')); ?>:</b>
	<?php echo CHtml::encode($data->sent_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_deleted_by_sender')); ?>:</b>
	<?php echo CHtml::encode($data->is_deleted_by_sender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_deleted_by_receiver')); ?>:</b>
	<?php echo CHtml::encode($data->is_deleted_by_receiver); ?>
	<br />

	*/ ?>

</div>
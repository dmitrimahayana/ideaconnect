<?php
/* @var $this JobseekerupdateController */
/* @var $data CcnJobseekerUpdate */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('swt_users_id')); ?>:</b>
	<?php echo CHtml::encode($data->swt_users_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cv_type')); ?>:</b>
	<?php echo CHtml::encode($data->cv_type); ?>
	<br />


</div>
<?php
/* @var $this JobseekersubscribeController */
/* @var $data CcnJobseekerSubscribe */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subscribe_vacancy')); ?>:</b>
	<?php echo CHtml::encode($data->subscribe_vacancy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subscribe_news')); ?>:</b>
	<?php echo CHtml::encode($data->subscribe_news); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subscribe_vacancy_create')); ?>:</b>
	<?php echo CHtml::encode($data->subscribe_vacancy_create); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subscribe_news_create')); ?>:</b>
	<?php echo CHtml::encode($data->subscribe_news_create); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('major')); ?>:</b>
	<?php echo CHtml::encode($data->major); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('industry')); ?>:</b>
	<?php echo CHtml::encode($data->industry); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('swt_users_id')); ?>:</b>
	<?php echo CHtml::encode($data->swt_users_id); ?>
	<br />

	*/ ?>

</div>
<?php
/* @var $this BadgeController */
/* @var $data Badge */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('badge')); ?>:</b>
	<?php echo CHtml::encode($data->badge); ?>
	<br />


</div>
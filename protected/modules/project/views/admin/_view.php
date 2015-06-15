<?php
/* @var $this ProjectController */
/* @var $data Project */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_name')); ?>:</b>
	<?php echo CHtml::encode($data->project_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cover_image')); ?>:</b>
	<?php echo CHtml::encode($data->cover_image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('intro_text')); ?>:</b>
	<?php echo CHtml::encode($data->intro_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('geometry_location')); ?>:</b>
	<?php echo CHtml::encode($data->geometry_location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_category_id')); ?>:</b>
	<?php echo CHtml::encode($data->project_category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_category_inherit_id')); ?>:</b>
	<?php echo CHtml::encode($data->project_category_inherit_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('project_category_name')); ?>:</b>
	<?php echo CHtml::encode($data->project_category_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_category_name_inherit')); ?>:</b>
	<?php echo CHtml::encode($data->project_category_name_inherit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('video_url')); ?>:</b>
	<?php echo CHtml::encode($data->video_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('background')); ?>:</b>
	<?php echo CHtml::encode($data->background); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('goal')); ?>:</b>
	<?php echo CHtml::encode($data->goal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('charge_id')); ?>:</b>
	<?php echo CHtml::encode($data->charge_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('charge')); ?>:</b>
	<?php echo CHtml::encode($data->charge); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('charge_is_percentage')); ?>:</b>
	<?php echo CHtml::encode($data->charge_is_percentage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_time_id')); ?>:</b>
	<?php echo CHtml::encode($data->project_time_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_time')); ?>:</b>
	<?php echo CHtml::encode($data->project_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_time')); ?>:</b>
	<?php echo CHtml::encode($data->created_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('editor_id')); ?>:</b>
	<?php echo CHtml::encode($data->editor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('edited_time')); ?>:</b>
	<?php echo CHtml::encode($data->edited_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_actived')); ?>:</b>
	<?php echo CHtml::encode($data->is_actived); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inisiator_id')); ?>:</b>
	<?php echo CHtml::encode($data->inisiator_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inisiator_name')); ?>:</b>
	<?php echo CHtml::encode($data->inisiator_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_verified')); ?>:</b>
	<?php echo CHtml::encode($data->is_verified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('verificator_id')); ?>:</b>
	<?php echo CHtml::encode($data->verificator_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('verification_time')); ?>:</b>
	<?php echo CHtml::encode($data->verification_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_started_time')); ?>:</b>
	<?php echo CHtml::encode($data->project_started_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_ending_time')); ?>:</b>
	<?php echo CHtml::encode($data->project_ending_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_funded')); ?>:</b>
	<?php echo CHtml::encode($data->is_funded); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('as_institution_id')); ?>:</b>
	<?php echo CHtml::encode($data->as_institution_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('as_institution_name')); ?>:</b>
	<?php echo CHtml::encode($data->as_institution_name); ?>
	<br />

	*/ ?>

</div>
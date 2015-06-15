<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->id,
);
?>

<? //begin.Messages ?>
<?php
	if(Yii::app()->user->hasFlash('success'))
		echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<? //end.Messages ?>
<?php $this->widget('application.components.system.BDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'project_name',
		'cover_image',
		'intro_text',
		'geometry_location',
		'project_category_id',
		'project_category_inherit_id',
		'project_category_name',
		'project_category_name_inherit',
		'video_url',
		'background',
		'description',
		'goal',
		'charge_id',
		'charge',
		'charge_is_percentage',
		'project_time_id',
		'project_time',
		'created_time',
		'editor_id',
		'edited_time',
		'is_actived',
		'inisiator_id',
		'inisiator_name',
		'is_verified',
		'verificator_id',
		'verification_time',
		'project_started_time',
		'project_ending_time',
		'is_funded',
		'as_institution_id',
		'as_institution_name',
	),
)); ?>

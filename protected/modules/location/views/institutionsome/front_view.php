<?php
/* @var $this InstitutionSomeController */
/* @var $model InstitutionSome */

$this->breadcrumbs=array(
	'Institution Somes'=>array('index'),
	$model->name,
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
		'name',
		'address',
		'province_id',
		'regency_id',
		'institution_phone_number',
		'job_position',
		'user_id',
	),
)); ?>

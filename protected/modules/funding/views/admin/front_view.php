<?php
/* @var $this FundingUserController */
/* @var $model FundingUser */

$this->breadcrumbs=array(
	'Funding Users'=>array('index'),
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
		'sponsor_id',
		'sponsor_name',
		'requisite_id',
		'as_institution_id',
		'as_institution_name',
		'account_from_number',
		'bank_from_id',
		'bank_from_name',
		'account_to_id',
		'account_to_number',
		'value',
		'unit',
		'is_verified',
		'varificator_id',
		'verification_time',
		'had_been_returned',
	),
)); ?>

<?php
/* @var $this TimeLimitController */
/* @var $model TimeLimit */

$this->breadcrumbs=array(
	'Time Limits'=>array('index'),
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
		'month_limit',
		'is_funding_time',
		'is_actived',
	),
)); ?>

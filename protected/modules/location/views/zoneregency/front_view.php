<?php
/* @var $this ZoneRegencyController */
/* @var $model ZoneRegency */

$this->breadcrumbs=array(
	'Zone Regencies'=>array('index'),
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
		'province_id',
		'name',
	),
)); ?>

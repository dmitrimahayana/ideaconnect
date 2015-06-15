<?php
/* @var $this ZoneCountryController */
/* @var $model ZoneCountry */

$this->breadcrumbs=array(
	'Zone Countries'=>array('index'),
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
		'code',
		'name',
		'alias',
	),
)); ?>

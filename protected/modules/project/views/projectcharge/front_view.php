<?php
/* @var $this ProjectChargeController */
/* @var $model ProjectCharge */

$this->breadcrumbs=array(
	'Project Charges'=>array('index'),
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
		'is_percentage',
		'value',
		'is_actived',
	),
)); ?>

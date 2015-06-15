<?php
/* @var $this ZoneProvinceController */
/* @var $model ZoneProvince */

$this->breadcrumbs=array(
	'Zone Provinces'=>array('index'),
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
		'country_code',
	),
)); ?>

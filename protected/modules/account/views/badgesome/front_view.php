<?php
/* @var $this BadgeSomeController */
/* @var $model BadgeSome */

$this->breadcrumbs=array(
	'Badge Somes'=>array('index'),
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
		'badge_id',
		'user_id',
	),
)); ?>

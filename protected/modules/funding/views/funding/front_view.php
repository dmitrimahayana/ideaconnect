<?php
/* @var $this FundingController */
/* @var $model Funding */

$this->breadcrumbs=array(
	'Fundings'=>array('index'),
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
		'requirement',
		'value',
		'unit',
		'requisite_id',
	),
)); ?>

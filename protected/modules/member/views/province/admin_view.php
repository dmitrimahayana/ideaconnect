<?php
/* @var $this ProvinceController */
/* @var $model CcnProvince */

$this->pageTitle = ': ID#';
$this->breadcrumbs=array(
	'Ccn Provinces'=>array('index'),
	$model->name,
);
?>

<?php //begin.Messages ?>
<?php
	if(Yii::app()->user->hasFlash('success'))
		echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<?php //end.Messages ?>
<?php $this->widget('application.components.system.BDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>

<?php
/* @var $this CountryController */
/* @var $model CcnCountry */

$this->pageTitle = ': ID#';
$this->breadcrumbs=array(
	'Ccn Countries'=>array('index'),
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
		'code',
		'name',
		'alias',
	),
)); ?>

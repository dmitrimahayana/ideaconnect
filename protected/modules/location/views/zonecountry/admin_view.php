<?php
	/* @var $this ZoneCountryController */
	/* @var $model ZoneCountry */

$this->breadcrumbs=array(
	'Zone Countries'=>array('adminmanage'),
	Yii::t('site', 'Detail Zone Countries'),
);

	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/office/grid-view.css');
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

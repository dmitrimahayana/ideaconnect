<?php
	/* @var $this UsersGroupController */
	/* @var $model UsersGroup */

$this->breadcrumbs=array(
	'Users Groups'=>array('adminmanage'),
	Yii::t('site', 'Detail Users Groups'),
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
		'id',
		'name',
		'params',
		'group_name',
		'group_login',
	),
)); ?>

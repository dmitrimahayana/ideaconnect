<?php
	/* @var $this MessegeController */
	/* @var $model Messege */

$this->breadcrumbs=array(
	'Messeges'=>array('adminmanage'),
	Yii::t('site', 'Detail Messeges'),
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
//		'id',
		'subject',
		'messege',
//		'from_user_id',
		'from_user_name',
//		'to_user_id',
		'to_user_name',
//		'is_read',
		'sent_time',
//		'is_deleted_by_sender',
//		'is_deleted_by_receiver',
	),
)); ?>

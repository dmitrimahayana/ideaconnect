<?php
	/* @var $this TimeLimitController */
	/* @var $model TimeLimit */

$this->breadcrumbs=array(
	'Time Limits'=>array('adminmanage'),
	Yii::t('site', 'Detail Time Limits'),
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
		'month_limit',
		//'is_funding_time',
        array(
            "name"=>'Setting Waktu',
            "type"=>'raw',
            "value"=>  ($model->is_funding_time==1)?'Project':'Pedanaan',
        ),
		//'is_actived',
        array(
            "name"=>'is_actived',
            "type"=>'raw',
            "value"=>  Utility::getPublishedToImg($model->is_actived),
        ),
	),
)); ?>

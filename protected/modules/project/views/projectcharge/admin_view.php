<?php
	/* @var $this ProjectChargeController */
	/* @var $model ProjectCharge */

$this->breadcrumbs=array(
	'Project Charges'=>array('adminmanage'),
	Yii::t('site', 'Detail Project Charges'),
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
		//'id',
//		'is_percentage',
        array(
            "name"=>'is_percentage',
            "type"=>'raw',
            "value"=>  ($model->is_percentage==1)?'Persentase':'Nominal',
        ),
		'value',
//		'is_actived',
        array(
            "name"=>'is_actived',
            "type"=>'raw',
            "value"=>  Utility::getPublishedToImg($model->is_actived),
        )
	),
)); ?>

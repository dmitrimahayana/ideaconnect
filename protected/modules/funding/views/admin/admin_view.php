<?php
	/* @var $this FundingUserController */
	/* @var $model FundingUser */

$this->breadcrumbs=array(
	'Funding Users'=>array('adminmanage'),
	Yii::t('site', 'Detail Funding Users'),
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
		//'sponsor_id',
		'sponsor_name',
		'requisite_id',
		//'as_institution_id',
		'as_institution_name',
		'account_from_number',
		//'bank_from_id',
		'bank_from_name',
		//'account_to_id',
		'account_to_number',
		'value',
		'unit',
//		'is_verified',
        array(
            "name"=>'is_verified',
            "type"=>'raw',
            "value"=>  Utility::getPublishedToImg($model->is_verified),
        ),
		'varificator_id',
		'verification_time',
//		'had_been_returned',
        array(
            "name"=>'had_been_returned',
            "type"=>'raw',
            "value"=>  Utility::getPublishedToImg($model->had_been_returned),
        ),
	),
)); ?>

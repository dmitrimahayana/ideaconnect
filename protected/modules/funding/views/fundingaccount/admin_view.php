<?php
	/* @var $this FundingAccountController */
	/* @var $model FundingAccount */

$this->breadcrumbs=array(
	'Funding Accounts'=>array('adminmanage'),
	Yii::t('site', 'Detail Funding Accounts'),
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
		//'bank_id',
        array(
            "name"=>'Bank Name',
            "value"=>$model->bank->bank_name,
        ),
        'account_number',
		'owner_name_alias',
	),
)); ?>

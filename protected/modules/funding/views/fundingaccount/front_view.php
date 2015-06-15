<?php
/* @var $this FundingAccountController */
/* @var $model FundingAccount */

$this->breadcrumbs=array(
	'Funding Accounts'=>array('index'),
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
		'bank_id',
		'account_number',
		'owner_name_alias',
	),
)); ?>

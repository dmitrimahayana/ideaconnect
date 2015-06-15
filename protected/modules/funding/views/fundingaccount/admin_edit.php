<?php
	/* @var $this FundingAccountController */
	/* @var $model FundingAccount */

$this->breadcrumbs=array(
	'Funding Accounts'=>array('adminmanage'),
	$model->id=>array('adminview','id'=>$model->id),
	Yii::t('site', 'Edit Funding Accounts'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
	/* @var $this FundingAccountController */
	/* @var $model FundingAccount */

$this->breadcrumbs=array(
	'Funding Accounts'=>array('adminmanage'),
	Yii::t('site', 'Tambah Funding Accounts'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
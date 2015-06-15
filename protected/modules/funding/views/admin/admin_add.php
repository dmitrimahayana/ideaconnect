<?php
	/* @var $this FundingUserController */
	/* @var $model FundingUser */

$this->breadcrumbs=array(
	'Funding Users'=>array('adminmanage'),
	Yii::t('site', 'Tambah Funding Users'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
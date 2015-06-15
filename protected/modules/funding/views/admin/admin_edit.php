<?php
	/* @var $this FundingUserController */
	/* @var $model FundingUser */

$this->breadcrumbs=array(
	'Funding Users'=>array('adminmanage'),
	$model->id=>array('adminview','id'=>$model->id),
	Yii::t('site', 'Edit Funding Users'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
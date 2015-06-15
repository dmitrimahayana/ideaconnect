<?php
	/* @var $this FundingController */
	/* @var $model Funding */

$this->breadcrumbs=array(
	'Fundings'=>array('adminmanage'),
	$model->id=>array('adminview','id'=>$model->id),
	Yii::t('site', 'Edit Fundings'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
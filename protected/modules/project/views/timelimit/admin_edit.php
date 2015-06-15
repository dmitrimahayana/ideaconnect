<?php
	/* @var $this TimeLimitController */
	/* @var $model TimeLimit */

$this->breadcrumbs=array(
	'Time Limits'=>array('adminmanage'),
	$model->id=>array('adminview','id'=>$model->id),
	Yii::t('site', 'Edit Time Limits'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
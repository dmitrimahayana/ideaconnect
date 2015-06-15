<?php
	/* @var $this TimeLimitController */
	/* @var $model TimeLimit */

$this->breadcrumbs=array(
	'Time Limits'=>array('adminmanage'),
	Yii::t('site', 'Tambah Time Limits'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
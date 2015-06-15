<?php
	/* @var $this BankController */
	/* @var $model Bank */

$this->breadcrumbs=array(
	'Banks'=>array('adminmanage'),
	$model->id=>array('adminview','id'=>$model->id),
	Yii::t('site', 'Edit Banks'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
	/* @var $this ProjectChargeController */
	/* @var $model ProjectCharge */

$this->breadcrumbs=array(
	'Project Charges'=>array('adminmanage'),
	$model->id=>array('adminview','id'=>$model->id),
	Yii::t('site', 'Edit Project Charges'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
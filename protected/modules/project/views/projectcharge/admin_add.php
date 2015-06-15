<?php
	/* @var $this ProjectChargeController */
	/* @var $model ProjectCharge */

$this->breadcrumbs=array(
	'Project Charges'=>array('adminmanage'),
	Yii::t('site', 'Tambah Project Charges'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
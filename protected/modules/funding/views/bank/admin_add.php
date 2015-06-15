<?php
	/* @var $this BankController */
	/* @var $model Bank */

$this->breadcrumbs=array(
	'Banks'=>array('adminmanage'),
	Yii::t('site', 'Tambah Banks'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
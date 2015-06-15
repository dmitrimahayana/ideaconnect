<?php
	/* @var $this ZoneRegencyController */
	/* @var $model ZoneRegency */

$this->breadcrumbs=array(
	'Zone Regencies'=>array('adminmanage'),
	Yii::t('site', 'Tambah Zone Regencies'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
	/* @var $this ZoneRegencyController */
	/* @var $model ZoneRegency */

$this->breadcrumbs=array(
	'Zone Regencies'=>array('adminmanage'),
	$model->name=>array('adminview','id'=>$model->id),
	Yii::t('site', 'Edit Zone Regencies'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
	/* @var $this ZoneProvinceController */
	/* @var $model ZoneProvince */

$this->breadcrumbs=array(
	'Zone Provinces'=>array('adminmanage'),
	$model->name=>array('adminview','id'=>$model->id),
	Yii::t('site', 'Edit Zone Provinces'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
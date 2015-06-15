<?php
	/* @var $this ZoneProvinceController */
	/* @var $model ZoneProvince */

$this->breadcrumbs=array(
	'Zone Provinces'=>array('adminmanage'),
	Yii::t('site', 'Tambah Zone Provinces'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
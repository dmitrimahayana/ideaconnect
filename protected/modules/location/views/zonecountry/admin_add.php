<?php
	/* @var $this ZoneCountryController */
	/* @var $model ZoneCountry */

$this->breadcrumbs=array(
	'Zone Countries'=>array('adminmanage'),
	Yii::t('site', 'Tambah Zone Countries'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
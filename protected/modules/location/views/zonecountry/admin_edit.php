<?php
	/* @var $this ZoneCountryController */
	/* @var $model ZoneCountry */

$this->breadcrumbs=array(
	'Zone Countries'=>array('adminmanage'),
	$model->name=>array('adminview','id'=>$model->code),
	Yii::t('site', 'Edit Zone Countries'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
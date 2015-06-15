<?php
/* @var $this ProvinceController */
/* @var $model CcnProvince */

$this->pageTitle = '';
$this->breadcrumbs=array(
	'Ccn Provinces'=>array('index'),
	'Create',
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
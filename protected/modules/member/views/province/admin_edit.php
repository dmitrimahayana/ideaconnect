<?php
/* @var $this ProvinceController */
/* @var $model CcnProvince */

$this->pageTitle = '';
$this->breadcrumbs=array(
	'Ccn Provinces'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
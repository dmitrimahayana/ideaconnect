<?php
/* @var $this CityController */
/* @var $model CcnCity */

$this->pageTitle = '';
$this->breadcrumbs=array(
	'Ccn Cities'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
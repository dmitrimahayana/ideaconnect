<?php
/* @var $this CityController */
/* @var $model CcnCity */

$this->pageTitle = '';
$this->breadcrumbs=array(
	'Ccn Cities'=>array('index'),
	'Create',
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
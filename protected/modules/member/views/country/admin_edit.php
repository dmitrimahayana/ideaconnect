<?php
/* @var $this CountryController */
/* @var $model CcnCountry */

$this->pageTitle = '';
$this->breadcrumbs=array(
	'Ccn Countries'=>array('index'),
	$model->name=>array('view','id'=>$model->code),
	'Update',
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
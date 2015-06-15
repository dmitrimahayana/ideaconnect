<?php
/* @var $this CountryController */
/* @var $model CcnCountry */

$this->pageTitle = '';
$this->breadcrumbs=array(
	'Ccn Countries'=>array('index'),
	'Create',
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
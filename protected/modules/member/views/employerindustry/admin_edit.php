<?php
/* @var $this EmployerindustryController */
/* @var $model CcnEmployerIndustry */

$this->pageTitle = '';
$this->breadcrumbs=array(
	'Ccn Employer Industries'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
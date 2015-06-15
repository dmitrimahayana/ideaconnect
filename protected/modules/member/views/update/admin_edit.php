<?php
/* @var $this JobseekerupdateController */
/* @var $model CcnJobseekerUpdate */

$this->pageTitle = '';
$this->breadcrumbs=array(
	'Ccn Jobseeker Updates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
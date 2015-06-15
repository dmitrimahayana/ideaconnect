<?php
/* @var $this JobseekersubscribeController */
/* @var $model CcnJobseekerSubscribe */

$this->pageTitle = '';
$this->breadcrumbs=array(
	'Ccn Jobseeker Subscribes'=>array('index'),
	'Create',
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this JobseekersubscribeController */
/* @var $model CcnJobseekerSubscribe */

$this->pageTitle = '';
$this->breadcrumbs=array(
	'Ccn Jobseeker Subscribes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
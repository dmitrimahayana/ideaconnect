<?php
/* @var $this JobseekerupdateController */
/* @var $model CcnJobseekerUpdate */

$this->pageTitle = ': ID#';
$this->breadcrumbs=array(
	'Ccn Jobseeker Updates'=>array('index'),
	$model->id,
);
?>

<?php //begin.Messages ?>
<?php
	if(Yii::app()->user->hasFlash('success'))
		echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<?php //end.Messages ?>
<?php $this->widget('application.components.system.BDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'swt_users_id',
		'modified',
		'cv_type',
	),
)); ?>

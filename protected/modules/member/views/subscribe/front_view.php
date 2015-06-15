<?php
/* @var $this JobseekersubscribeController */
/* @var $model CcnJobseekerSubscribe */

$this->pageTitle = ': ID#';
$this->breadcrumbs=array(
	'Ccn Jobseeker Subscribes'=>array('index'),
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
		'subscribe_vacancy',
		'subscribe_news',
		'subscribe_vacancy_create',
		'subscribe_news_create',
		'major',
		'industry',
		'swt_users_id',
	),
)); ?>

<?php
	/* @var $this CommentController */
	/* @var $model Comment */

$this->breadcrumbs=array(
	'Comments'=>array('adminmanage'),
	Yii::t('site', 'Detail Comments'),
);

	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/office/grid-view.css');
?>

<? //begin.Messages ?>
<?php
	if(Yii::app()->user->hasFlash('success'))
		echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<? //end.Messages ?>
<?php $this->widget('application.components.system.BDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'content',
		'parent_id',
		'project_id',
		'commentator_name',
		'commentator_email',
		'created_time',
		'is_published',
	),
)); ?>

<?php
$this->pageTitle = 'Com Widgets View';
$this->breadcrumbs=array(
	'Com Widgets'=>array('adminmanage'),
	$model->title,
);
?>

<?php //begin.Messages ?>
<?php
if(Yii::app()->user->hasFlash('success'))
		echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<?php //begin.Messages ?>

<?php $this->widget('application.components.system.SDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'com_modules_id',
		'title',
		'content',
		'ordering',
		'hook_position',
		'enabled',
		'widget',
		'access',
		'show_title',
		'params',
	),
)); ?>

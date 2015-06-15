<?php
$this->pageTitle = 'Users View';
$this->breadcrumbs=array(
	'Users'=>array('adminmanage'),
	$model->name,
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
		'users_group_id',
		'actived',
		'name',
		'username',
		'password',
		'email',
		'block',
		'register_date',
		'last_visit_date',
		'activation',
		'is_online',
		'photo',
		'mobile_no',
		'params',
	),
)); ?>

<?php
	$this->pageTitle = 'Users View';
	$this->breadcrumbs=array(
		'Users'=>array('adminmanage'),
		$model->name,
	);
?>

<?php //begin.Messages ?>
<div id="ajax-message">
<?php
	if(Yii::app()->user->hasFlash('error'))
		echo Utility::flashError(Yii::app()->user->getFlash('error'));
	if(Yii::app()->user->hasFlash('success'))
		echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
</div>
<?php //end.Messages ?>

<div class="boxed">
	<?php $this->widget('application.components.system.BDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'users_group.name',
			'name',
			'username',
			'email',
			'register_date',
			'last_visit_date',
			'is_online',
			'photo',
			'mobile_no',		
			'block',			
			'actived',
		),
	)); ?>
</div>

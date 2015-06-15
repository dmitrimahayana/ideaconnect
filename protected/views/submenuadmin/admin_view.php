<?php
	$this->pageTitle = 'Sub Menu Admins View';
	$this->breadcrumbs=array(
		'Sub Menu Admins'=>array('adminmanage'),
		$model->id,
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
		'group_type',
		'controller',
		'action',
		'enabled',
		'menu',
		'attr',
	),
)); ?>

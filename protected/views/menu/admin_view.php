<?php
$this->pageTitle = 'Menus View';
$this->breadcrumbs=array(
	'Menus'=>array('adminmanage'),
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
		'menu_types_id',
		'com_modules_id',
		'menu_type',
		'name',
		'url',
		'alias_url',
		'icon',
		'dest_type',
		'parent',
		'ordering',
		'access',
		'ordering',
		'params',
		'in_use',		
		'published',
	),
)); ?>

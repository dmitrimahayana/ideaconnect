<?php
/* @var $this ProjectCategoryController */
/* @var $model ProjectCategory */

$this->breadcrumbs=array(
	'Project Categories'=>array('index'),
	$model->id,
);
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
		'category_name',
		'parent_id',
	),
)); ?>

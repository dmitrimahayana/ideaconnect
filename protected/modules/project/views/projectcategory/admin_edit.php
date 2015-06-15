<?php
	/* @var $this ProjectCategoryController */
	/* @var $model ProjectCategory */

$this->breadcrumbs=array(
	'Project Categories'=>array('adminmanage'),
	$model->id=>array('adminview','id'=>$model->id),
	Yii::t('site', 'Edit Project Categories'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
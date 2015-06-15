<?php
	/* @var $this ProjectCategoryController */
	/* @var $model ProjectCategory */

$this->breadcrumbs=array(
	'Project Categories'=>array('adminmanage'),
	Yii::t('site', 'Tambah Project Categories'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
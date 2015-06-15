<?php
	/* @var $this ProjectController */
	/* @var $model Project */

$this->breadcrumbs=array(
	'Projects'=>array('adminmanage'),
	Yii::t('site', 'Tambah Projects'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
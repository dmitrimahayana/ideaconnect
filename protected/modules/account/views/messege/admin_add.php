<?php
	/* @var $this MessegeController */
	/* @var $model Messege */

$this->breadcrumbs=array(
	'Messeges'=>array('adminmanage'),
	Yii::t('site', 'Tambah Messeges'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
	/* @var $this MessegeController */
	/* @var $model Messege */

$this->breadcrumbs=array(
	'Messeges'=>array('adminmanage'),
	$model->id=>array('adminview','id'=>$model->id),
	Yii::t('site', 'Edit Messeges'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
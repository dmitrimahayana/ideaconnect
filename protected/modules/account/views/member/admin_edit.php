<?php
	/* @var $this BadgeController */
	/* @var $model Badge */

$this->breadcrumbs=array(
	'Pengguna'=>array('adminmanage'),
	$model->username=>array('adminview','id'=>$model->id),
	Yii::t('site', 'Edit Pengguna'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
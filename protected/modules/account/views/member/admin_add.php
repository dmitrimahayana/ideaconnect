<?php
	/* @var $this BadgeController */
	/* @var $model Badge */

$this->breadcrumbs=array(
	'Pengguna'=>array('adminmanage'),
	Yii::t('site', 'Tambah Pengguna'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
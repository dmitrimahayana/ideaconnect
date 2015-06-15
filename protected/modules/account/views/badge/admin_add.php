<?php
	/* @var $this BadgeController */
	/* @var $model Badge */

$this->breadcrumbs=array(
	'Badges'=>array('adminmanage'),
	Yii::t('site', 'Tambah Badges'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
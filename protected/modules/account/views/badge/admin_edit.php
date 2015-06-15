<?php
	/* @var $this BadgeController */
	/* @var $model Badge */

$this->breadcrumbs=array(
	'Badges'=>array('adminmanage'),
	$model->id=>array('adminview','id'=>$model->id),
	Yii::t('site', 'Edit Badges'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
	/* @var $this BadgeSomeController */
	/* @var $model BadgeSome */

$this->breadcrumbs=array(
	'Badge Somes'=>array('adminmanage'),
	$model->id=>array('adminview','id'=>$model->id),
	Yii::t('site', 'Edit Badge Somes'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
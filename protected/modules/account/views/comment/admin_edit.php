<?php
	/* @var $this CommentController */
	/* @var $model Comment */

$this->breadcrumbs=array(
	'Comments'=>array('adminmanage'),
	$model->id=>array('adminview','id'=>$model->id),
	Yii::t('site', 'Edit Comments'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
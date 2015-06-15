<?php
	/* @var $this CommentController */
	/* @var $model Comment */

$this->breadcrumbs=array(
	'Comments'=>array('adminmanage'),
	Yii::t('site', 'Tambah Comments'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
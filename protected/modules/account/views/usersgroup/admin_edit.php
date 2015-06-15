<?php
	/* @var $this UsersGroupController */
	/* @var $model UsersGroup */

$this->breadcrumbs=array(
	'Users Groups'=>array('adminmanage'),
	$model->name=>array('adminview','id'=>$model->id),
	Yii::t('site', 'Edit Users Groups'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
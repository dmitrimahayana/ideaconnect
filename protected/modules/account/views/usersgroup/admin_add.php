<?php
	/* @var $this UsersGroupController */
	/* @var $model UsersGroup */

$this->breadcrumbs=array(
	'Users Groups'=>array('adminmanage'),
	Yii::t('site', 'Tambah Users Groups'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
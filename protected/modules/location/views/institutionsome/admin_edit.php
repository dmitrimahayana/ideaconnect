<?php
	/* @var $this InstitutionSomeController */
	/* @var $model InstitutionSome */

$this->breadcrumbs=array(
	'Institution Somes'=>array('adminmanage'),
	$model->name=>array('adminview','id'=>$model->id),
	Yii::t('site', 'Edit Institution Somes'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
	/* @var $this ProjectController */
	/* @var $model Project */

$this->breadcrumbs=array(
	'Projects'=>array('adminmanage'),
	//$model->id=>array('adminview','id'=>$model->id),
    $model->project_name=>array('adminview','id'=>$model->id),
    Yii::t('site', 'Edit Projects'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
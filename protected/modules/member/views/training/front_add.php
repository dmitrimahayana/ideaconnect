<?php
	/* @var $this JobseekertrainingController */
	/* @var $model CcnJobseekerTraining */

	$this->pageTitle = '';
	$this->breadcrumbs=array();
?>
<?php echo CHtml::tag('p', array('class'=>'ml-20 silent larger-px'), Yii::t('','Anda pernah mengikuti pelatihan, workshop dan semacamnya? Silahkan tambahkan di sini.'));
	echo CHtml::tag('br');
	echo CHtml::tag('br'); ?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
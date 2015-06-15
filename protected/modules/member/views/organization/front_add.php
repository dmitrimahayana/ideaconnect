<?php
	/* @var $this CcnJobseekerorgController */
	/* @var $model CcnJobseekerOrg */

	$this->pageTitle = '';
	$this->breadcrumbs=array();
?>
<?php echo CHtml::tag('p', array('class'=>'ml-20 silent larger-px'), Yii::t('','Anda pernah tergabung dalam organisasi sekolah, kampus atau luar kampus? Tambahkan di sini.'));
	echo CHtml::tag('br');
	echo CHtml::tag('br'); ?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
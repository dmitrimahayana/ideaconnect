<?php
/* @var $this JobseekerlangController */
/* @var $model CcnJobseekerLang */

$this->pageTitle = '';
$this->breadcrumbs=array();
?>
<?php echo CHtml::tag('p', array('class'=>'ml-20 silent larger-px'), Yii::t('','Informasikan kepada perusahaan kemampuan bahasa non lokal/pribumi Anda.'));
	echo CHtml::tag('br');
	echo CHtml::tag('br'); ?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
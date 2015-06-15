<?php
	/* @var $this JobseekerexpController */
	/* @var $model CcnJobseekerExp */

	$this->pageTitle = '';
	$this->breadcrumbs=array();
?>
<?php echo CHtml::tag('p', array('class'=>'ml-20 silent larger-px'), Yii::t('','Informasikan kepada perusahaan, pengalaman pekerjaan yang pernah atau masih Anda miliki.'));
	echo CHtml::tag('br');
	echo CHtml::tag('br'); ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
	/* @var $this JobseekertoeflController */
	/* @var $model CcnJobseekerToefl */

	$this->pageTitle = 'TOEFL';
	$this->breadcrumbs=array();
?>

<div id="mycv" name="post-on">
<?php echo CHtml::tag('p', array('class'=>'ml-20 silent larger-px'), Yii::t('','Informasikan kepada perusahaan standar kemampuan bahasa Inggris Anda.'));
	echo CHtml::tag('br');
	echo CHtml::tag('br'); ?>
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
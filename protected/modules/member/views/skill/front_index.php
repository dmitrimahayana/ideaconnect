<?php
	/* @var $this JobseekerskillController */
	/* @var $model CcnJobseekerSkill */

	$this->pageTitle = 'Kelebihan Diri';
	$this->breadcrumbs=array();
?>
<?php echo CHtml::tag('p', array('class'=>'ml-20 silent larger-px'), Yii::t('','Tambahkan keahlian yang Anda miliki baik teknis maupun non teknis.'));
	echo CHtml::tag('br');
	echo CHtml::tag('br'); ?>

<div id="mycv" name="post-on">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
<?php
	/* @var $this JobseekerpositiveController */
	/* @var $model CcnJobseekerPositive */

	$this->pageTitle = 'Kelebihan dan Kekurangan';
	$this->breadcrumbs=array();
?>
<?php echo CHtml::tag('p', array('class'=>'ml-20 silent larger-px'), Yii::t('','Informasikan kepada perusahaan, kelebihan dan kekurangan yang Anda miliki dengan jujur.'));
	echo CHtml::tag('br');
	echo CHtml::tag('br'); ?>

<div id="mycv" name="post-on">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
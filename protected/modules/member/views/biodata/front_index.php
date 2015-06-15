<?php
	/* @var $this JobseekerbioController */
	/* @var $model CcnJobseekerBio */

	$this->pageTitle = 'Biodata';
	$this->breadcrumbs=array();
?>

<div id="mycv" name="post-on">
<?php echo CHtml::tag('p', array('class'=>'ml-20 mb-10 silent larger-px'), Yii::t('','Data diri agar perusahaan dapat mengetahui latar belakang dan kontak Anda.'));
	echo CHtml::tag('br');
	echo CHtml::tag('br'); ?>
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
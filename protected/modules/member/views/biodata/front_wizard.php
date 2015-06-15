<?php
	/* @var $this JobseekerbioController */
	/* @var $model CcnJobseekerBio */

	$this->pageTitle = 'Biodata Wizard';
	$this->breadcrumbs=array();
?>

<div class="boxed" id="biodata" name="post-on">
	<h5><?php echo Yii::t('', 'Perusahaan perlu mengetahui data diri Anda : nama, tempat dan tanggal lahir, alamat  Anda dan sebagainya. Juga bagaimana perusahaan dapat menghubungi Anda.') ?> </h5>
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

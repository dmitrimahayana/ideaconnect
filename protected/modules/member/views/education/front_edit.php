<?php
	/* @var $this JobseekereduController */
	/* @var $model CcnJobseekerEdu */

	$this->pageTitle = '';
	$this->breadcrumbs=array();
?>

<h5>Informasikan kepada perusahaan, pendidikan formal apa dan dimana yang pernah Anda tempuh.</h5>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
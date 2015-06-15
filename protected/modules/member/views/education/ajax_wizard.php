<?php
	/* @var $this JobseekerbioController */
	/* @var $model CcnJobseekerBio */

	$this->pageTitle = '';
	$this->breadcrumbs=array();
?>

<div id="edu-<?php echo $model->id;?>" name="post-on">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

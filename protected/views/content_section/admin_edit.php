<?php
	$this->pageTitle = 'Content Sections Update';
	$this->breadcrumbs=array(
		'Content Sections'=>array('adminmanage'),
		$model->title=>array('adminview','id'=>$model->id),
		'Update',
	);
	if(Yii::app()->user->id == 1) {
		$render = '/content_section/_form';
	} else {
		$render = '/content_section/_form_office';
	}
?>

<div class="form">
	<?php echo $this->renderPartial($render, array('model'=>$model)); ?>
</div>
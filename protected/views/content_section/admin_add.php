<?php
	$this->pageTitle = 'Content Sections Create';
	$this->breadcrumbs=array(
		'Content Sections'=>array('adminmanage'),
		'Create',
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
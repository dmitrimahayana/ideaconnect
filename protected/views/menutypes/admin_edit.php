<?php
	$this->pageTitle = 'Menu Types Update';
	$this->breadcrumbs=array(
		'Menu Types'=>array('adminmanage'),
		$model->title=>array('adminview','id'=>$model->id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
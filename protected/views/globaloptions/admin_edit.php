<?php
	$this->pageTitle = 'Global Options Update';
	$this->breadcrumbs=array(
		'Global Options'=>array('adminmanage'),
		$model->option_id=>array('adminview','id'=>$model->option_id),
		'Update',
	);

?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
	$this->pageTitle = 'Users Groups Update';
	$this->breadcrumbs=array(
		'Users Groups'=>array('adminmanage'),
		$model->name=>array('adminview','id'=>$model->id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
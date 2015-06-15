<?php
	$this->pageTitle = 'Users Groups Create';
	$this->breadcrumbs=array(
		'Users Groups'=>array('adminmanage'),
		'Create',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
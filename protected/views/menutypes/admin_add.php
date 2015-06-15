<?php
	$this->pageTitle = 'Menu Types Create';
	$this->breadcrumbs=array(
		'Menu Types'=>array('adminmanage'),
		'Create',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
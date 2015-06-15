<?php
	$this->pageTitle = 'Global Options Create';
	$this->breadcrumbs=array(
		'Global Options'=>array('adminmanage'),
		'Create',
	);

?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
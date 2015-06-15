<?php
	$this->pageTitle = 'Msg Translations Create';
	$this->breadcrumbs=array(
		'Msg Translations'=>array('adminmanage'),
		'Create',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
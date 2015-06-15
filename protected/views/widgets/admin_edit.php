<?php
$this->pageTitle = 'Com Widgets Update';
$this->breadcrumbs=array(
	'Com Widgets'=>array('adminmanage'),
	$model->title=>array('adminview','id'=>$model->id),
	'Update',
);

?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->pageTitle = 'Users Update';
$this->breadcrumbs=array(
	'Users'=>array('adminmanage'),
	$model->name=>array('adminview','id'=>$model->id),
	'Update',
);

?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
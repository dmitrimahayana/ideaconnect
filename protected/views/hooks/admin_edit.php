<?php
$this->pageTitle = 'Hooks Update';
$this->breadcrumbs=array(
	'Hooks'=>array('adminmanage'),
	$model->id=>array('adminview','id'=>$model->id),
	'Update',
);

?>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
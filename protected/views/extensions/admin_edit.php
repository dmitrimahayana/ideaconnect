<?php
$this->pageTitle = 'Com Extensions Update';
$this->breadcrumbs=array(
	'Com Extensions'=>array('adminmanage'),
	$model->name=>array('adminview','id'=>$model->id),
	'Update',
);

?>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
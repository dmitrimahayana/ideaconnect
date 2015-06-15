<?php
$this->pageTitle = 'Sub Menu Admins Update';
$this->breadcrumbs=array(
	'Sub Menu Admins'=>array('adminmanage'),
	$model->id=>array('adminview','id'=>$model->id),
	'Update',
);

?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
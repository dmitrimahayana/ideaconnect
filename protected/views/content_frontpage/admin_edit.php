<?php
$this->pageTitle = 'Content Frontpages Update';
$this->breadcrumbs=array(
	'Content Frontpages'=>array('adminmanage'),
	$model->id=>array('adminview','id'=>$model->id),
	'Update',
);

?>


<?php echo $this->renderPartial('/content_frontpage/_form', array('model'=>$model)); ?>
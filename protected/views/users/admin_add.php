<?php
$this->pageTitle = 'Users Create';
$this->breadcrumbs=array(
	'Users'=>array('adminmanage'),
	'Create',
);

?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
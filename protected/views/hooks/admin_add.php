<?php
$this->pageTitle = 'Hooks Create';
$this->breadcrumbs=array(
	'Hooks'=>array('adminmanage'),
	'Create',
);

?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
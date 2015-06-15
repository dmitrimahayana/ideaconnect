<?php
$this->pageTitle = 'Com Widgets Create';
$this->breadcrumbs=array(
	'Com Widgets'=>array('adminmanage'),
	'Create',
);

?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
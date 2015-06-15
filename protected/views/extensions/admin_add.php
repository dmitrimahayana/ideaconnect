<?php
$this->pageTitle = 'Com Extensions Create';
$this->breadcrumbs=array(
	'Com Extensions'=>array('adminmanage'),
	'Create',
);

?>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
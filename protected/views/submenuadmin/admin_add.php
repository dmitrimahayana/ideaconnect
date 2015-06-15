<?php
$this->pageTitle = 'Sub Menu Admins Create';
$this->breadcrumbs=array(
	'Sub Menu Admins'=>array('adminmanage'),
	'Create',
);

?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
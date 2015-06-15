<?php
$this->pageTitle = 'Update Menu  '.ucwords(str_replace('_', ' ', $menuType->group_type)). ' : '. $model->name;
$this->breadcrumbs=array(
	'Menus'=>array('adminmanage'),
	$model->name=>array('adminview','id'=>$model->id),
	'Update',
);

?>



<?php echo $this->renderPartial('_form', array('model'=>$model, 'menuType'=>$menuType)); ?>
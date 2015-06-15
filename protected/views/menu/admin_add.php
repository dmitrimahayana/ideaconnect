<?php
$this->pageTitle = 'Create Menu '. ucwords(str_replace('_', ' ', $menuType->group_type)). ' : '. $menuType->title;
$this->breadcrumbs=array(
	'Menus'=>array('adminmanage'),
	'Create',
);

?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'menuType'=>$menuType)); ?>
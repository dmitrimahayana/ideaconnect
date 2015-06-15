<?php
	$this->pageTitle = 'Msg Translations Update';
	$this->breadcrumbs=array(
		'Msg Translations'=>array('adminmanage'),
		$model->id_message=>array('adminview','id'=>$model->id_message),
		'Update',
	);

?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
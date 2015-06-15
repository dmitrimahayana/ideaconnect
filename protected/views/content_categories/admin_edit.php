<?php
	$this->pageTitle = 'Content Categories Update';
	$this->breadcrumbs=array(
		'Content Categories'=>array('adminmanage'),
		$model->title=>array('adminview','id'=>$model->id),
		'Update',
	);
	if(Yii::app()->user->id == 1) {
		$render = '/content_categories/_form';
	} else {
		$render = '/content_categories/_form_office';
	}
?>

<?php echo $this->renderPartial($render, array('model'=>$model)); ?>
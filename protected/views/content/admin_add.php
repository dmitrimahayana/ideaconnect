<?php
	$this->pageTitle = 'Buat Konten';
	$this->breadcrumbs=array(
		'Contents'=>array('adminmanage'),
		'Create',
	);
	if(Yii::app()->user->id == 1) {
		$render = '_form';
	} else {
		$render = '_form_office';
	}
?>

<div class="form">
	<?php echo $this->renderPartial($render, array('model'=>$model)); ?>
</div>
<?php
	$this->pageTitle = 'Tambah Kategori Konten';
	$this->breadcrumbs=array(
		'Content Categories'=>array('adminmanage'),
		'Create',
	);
	if(Yii::app()->user->id == 1) {
		$render = '/content_categories/_form';
	} else {
		$render = '/content_categories/_form_office';
	}
?>

<?php echo $this->renderPartial($render, array('model'=>$model)); ?>
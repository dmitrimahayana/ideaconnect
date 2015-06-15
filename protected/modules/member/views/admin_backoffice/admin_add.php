<?php
	/* @var $this JobseekerController */
	/* @var $model PcrUsers */	
	$this->pageTitle = 'Tambah Member Admin';

	
?>

<?php echo $this->renderPartial('/admin_backoffice/_form_ajax', array('model'=>$model)); ?>
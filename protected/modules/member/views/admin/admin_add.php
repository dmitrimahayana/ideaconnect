<?php
	/* @var $this JobseekerController */
	/* @var $model PcrUsers */
	if ($_GET['gid'] == 4) {
		$title = 'Jobseeker Alumni';
	} else if($_GET['gid'] == 5) {
		$title = 'Jobseeker';
	} else if($_GET['gid'] == 6) {
		$title = 'Employer';
	} else {
		$title = 'Admin';
	}

	$this->pageTitle = 'Tambah Member '.$title;

	if(isset($_GET['type']) && $_GET['type'] == 'action') {
		$render = '_form';
	} else {
		$render = '_form_ajax';
	}
?>

<?php echo $this->renderPartial($render, array('model'=>$model)); ?>
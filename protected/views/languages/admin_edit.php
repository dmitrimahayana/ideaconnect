<?php
	$this->pageTitle = 'Languages Update';

	if(Yii::app()->user->id == 1) {
		$render = '_form';
	} else {
		$render = '_form_office';
	}
?>

<?php echo $this->renderPartial($render, array('model'=>$model)); ?>
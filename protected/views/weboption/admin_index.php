<?php
	$this->pageTitle = 'Web Options Update';
	$this->breadcrumbs=array(
		'Web Options'=>array('adminmanage'),
		$model->id_option=>array('adminview','id'=>$model->id_option),
		'Update',
	);
	if(Yii::app()->user->id == 1) {
		$render = '_form';
	} else {
		$render = '_form_office';
	}
?>

<?php //begin.Messages ?>
<div id="ajax-message">
<?php
	if(Yii::app()->user->hasFlash('error'))
		echo Utility::flashError(Yii::app()->user->getFlash('error'));
	if(Yii::app()->user->hasFlash('success'))
		echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
</div>
<?php //end.Messages ?>

<div class="form">
	<?php echo $this->renderPartial($render, array('model'=>$model)); ?>
</div>
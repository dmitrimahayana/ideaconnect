<?php
	$this->pageTitle = 'Contact Details Update';
	$this->breadcrumbs=array(
		'Contact Details'=>array('adminmanage'),
		$model->name=>array('adminview','id'=>$model->id),
		'Update',
	);
	if(Yii::app()->user->id == 1) {
		$render = '/contact_detail/_form';
	} else {
		$render = '/contact_detail/_form_office';
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

<?php
	/* @var $this JobseekerController */
	/* @var $dataProvider CActiveDataProvider */
	$this->pageTitle = "Welcome Jobseeker!";
	$nowDate = date("Y-m-d H:i:s");
	$this->breadcrumbs=array();
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
<?php //begin.Messages ?>	

<?php //begin.Apply Online ?>
<?php $this->widget('JobseekerApplyOnline'); ?>
<?php //end.Apply Online ?>

<?php //begin.Test ?>
<?php $this->widget('JobseekerTest'); ?>
<?php //end.Test ?>

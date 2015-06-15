<?php
	/* @var $this EmployerController */
	/* @var $dataProvider CActiveDataProvider */
	$this->pageTitle = 'Welcome Employer!';
	$this->breadcrumbs=array(
		'Pcr Users',
	);
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

<?php //begin.Employer Last Vacancy ?>
<?php $this->widget('EmployerLastVacancy'); ?>
<?php //begin.Employer Last Vacancy ?>

<?php //begin.Employer Update APP-ON ?>
<?php $this->widget('EmployerApplyUpdate'); ?>
<?php //begin.Employer Update APP-ON ?>

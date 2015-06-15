<?php
	$this->pageTitle = 'Login';
	$this->breadcrumbs=array(
		'Login',
	);
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
	'focus' => array($model, 'username'),
));?>

	<div class="notifier">
	<?php echo $form->errorSummary($model); ?>
	</div>

	<img class="backoffice" src="<?php echo Yii::app()->theme->baseUrl;?>/images/login/the-backoffice-title.png" alt="logo the backoffice" />
	<img class="logo" src="<?php echo Yii::app()->theme->baseUrl;?>/images/login/logo-cc-admin.png" alt="logo the backoffice" />
	<div class="clear"></div>

	<ul class="form">
		<li><?php echo $form->textField($model,'username', array('placeholder'=>'Username')); ?></li>
		<li><?php echo $form->passwordField($model,'password', array('placeholder'=>'Password')); ?></li>
		<li><?php echo CHtml::submitButton('Login'); ?></li>
		<div class="clear"></div>
	</ul>

<?php $this->endWidget(); ?>

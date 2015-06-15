<?php
	$this->pageTitle = 'Login';
	$this->breadcrumbs=array(
		'Login',
	);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>false,
	'focus' => array($model, 'username'),
)); ?>

	<fieldset>

		<div>
			<?php echo $form->textField($model,'username', array('placeholder'=>'Username')); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>

		<div class="password">
			<?php echo $form->passwordField($model,'password', array('placeholder'=>'Password')); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>

		<div class="rememberMe">
			<?php echo CHtml::submitButton('Login'); ?>
			<?php echo $form->checkBox($model,'rememberMe'); ?>
			<?php echo $form->label($model,'rememberMe'); ?>
			<div class="clear"></div>
		</div>

	</fieldset>
<?php $this->endWidget(); ?>

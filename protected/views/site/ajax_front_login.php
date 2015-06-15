<?php
	/* @var $this SiteController */
	/* @var $model LoginForm */
	/* @var $form CActiveForm  */

	$this->pageTitle=Yii::app()->name . ' - Login';
	$this->breadcrumbs=array(
		'Login',
	);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	<div class="dialog-header">Login</div>
	<div class="dialog-content">
		<fieldset>
			
			<?php if(isset($_GET['id'])) {
				$group = $_GET['id'];
			} else {
				$group = 5;
			}?>

			<?php echo $form->hiddenField($model, 'users_group_id', array('value'=> $group)); ?>
			<div>
				<?php echo $form->labelEx($model,'email'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'email', array('size' => '27')); ?>
					<?php echo $form->error($model,'email'); ?>
				</div>
				<div class="clear"></div>
			</div>

			<div>
				<?php echo $form->labelEx($model,'password'); ?>
				<div class="desc">
					<?php echo $form->passwordField($model,'password', array('size' => '27')); ?>
					<?php echo $form->error($model,'password'); ?>
				</div>
				<div class="clear"></div>
			</div>
		</fieldset>
	</div>
	<div class="dialog-submit">
		<div class="left">
			<?php echo $form->checkBox($model,'rememberMe'); ?>
			<?php echo $form->label($model,'rememberMe'); ?>
		</div>
		<?php echo CHtml::submitButton('Login'); ?>
		<input id="closed" type="button" value="Tutup" />
		<div class="clear"></div>
	</div>

<?php $this->endWidget(); ?>

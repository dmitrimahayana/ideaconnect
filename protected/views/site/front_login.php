<?php
	/* @var $this SiteController */
	/* @var $model LoginForm */
	/* @var $form CActiveForm  */

	$this->pageTitle= '';
	$this->breadcrumbs=array(
		'Login',
	);
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/main/main_login.css');
?>

<div class="boxed" id="login">
	<h3 class="rockwell">Login</h3>
	<div class="box" name="post-on">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'login-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>
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
						<?php echo $form->textField($model,'email',array('class'=>'span-7')); ?>
						<?php echo $form->error($model,'email'); ?>
					</div>
					<div class="clear"></div>
				</div>

				<div>
					<?php echo $form->labelEx($model,'password'); ?>
					<div class="desc">
						<?php echo $form->passwordField($model,'password',array('class'=>'span-7')); ?>
						<?php echo $form->error($model,'password'); ?>
					</div>
					<div class="clear"></div>
				</div>

				<div class="submit">
					<label>&nbsp;</label>
					<div class="desc">
						<?php echo CHtml::submitButton('Login'); ?>
					</div>
					<div class="clear"></div>
				</div>
			</fieldset>
		<?php $this->endWidget(); ?>

	</div>
</div>

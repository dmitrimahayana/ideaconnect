<?php
/* @var $this JobseekersubscribeController */
/* @var $model CcnJobseekerSubscribe */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccn-jobseeker-subscribe-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<fieldset>

	<div>
		<?php echo $form->labelEx($model,'subscribe_vacancy'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'subscribe_vacancy'); ?>
			<?php echo $form->error($model,'subscribe_vacancy'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'subscribe_news'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'subscribe_news'); ?>
			<?php echo $form->error($model,'subscribe_news'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'subscribe_vacancy_create'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'subscribe_vacancy_create'); ?>
			<?php echo $form->error($model,'subscribe_vacancy_create'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'subscribe_news_create'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'subscribe_news_create'); ?>
			<?php echo $form->error($model,'subscribe_news_create'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'major'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'major'); ?>
			<?php echo $form->error($model,'major'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'industry'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'industry',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo $form->error($model,'industry'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'swt_users_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'swt_users_id',array('size'=>11,'maxlength'=>11)); ?>
			<?php echo $form->error($model,'swt_users_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="submit">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>
		<div class="clear"></div>
	</div>

	</fieldset>

<?php $this->endWidget(); ?>

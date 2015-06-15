<?php
/* @var $this JobseekerupdateController */
/* @var $model CcnJobseekerUpdate */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccn-jobseeker-update-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<fieldset>

	<div>
		<?php echo $form->labelEx($model,'swt_users_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'swt_users_id',array('size'=>11,'maxlength'=>11)); ?>
			<?php echo $form->error($model,'swt_users_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'modified'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'modified'); ?>
			<?php echo $form->error($model,'modified'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'cv_type'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'cv_type',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo $form->error($model,'cv_type'); ?>
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

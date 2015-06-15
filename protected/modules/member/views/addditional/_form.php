<?php
/* @var $this JobseekeraddController */
/* @var $model CcnJobseekerAdd */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccn-jobseeker-add-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<fieldset>

	<div>
		<?php echo $form->labelEx($model,'id_add'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'id_add',array('size'=>11,'maxlength'=>11)); ?>
			<?php echo $form->error($model,'id_add'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'abroad'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'abroad'); ?>
			<?php echo $form->error($model,'abroad'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'travel_ok'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'travel_ok'); ?>
			<?php echo $form->error($model,'travel_ok'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'vehicle'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'vehicle'); ?>
			<?php echo $form->error($model,'vehicle'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'sim_a'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'sim_a'); ?>
			<?php echo $form->error($model,'sim_a'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'sim_c'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'sim_c'); ?>
			<?php echo $form->error($model,'sim_c'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'passport'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'passport'); ?>
			<?php echo $form->error($model,'passport'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'available'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'available'); ?>
			<?php echo $form->error($model,'available'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'available_time'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'available_time',array('size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'available_time'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'additional_info'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'additional_info',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'additional_info'); ?>
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

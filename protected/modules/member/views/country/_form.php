<?php
/* @var $this CountryController */
/* @var $model CcnCountry */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccn-country-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<fieldset>

	<div>
		<?php echo $form->labelEx($model,'code'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'code',array('size'=>2,'maxlength'=>2)); ?>
			<?php echo $form->error($model,'code'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'alias'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'alias',array('size'=>15,'maxlength'=>15)); ?>
			<?php echo $form->error($model,'alias'); ?>
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

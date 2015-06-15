<?php
	/* @var $this JobseekerpositiveController */
	/* @var $model CcnJobseekerPositive */
	/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccn-jobseeker-positive-form',
	'enableAjaxValidation'=>true,
)); ?>

<fieldset>

	<div id="ajax-message"></div>

	<div>
		<?php echo $form->labelEx($model,'positive'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'positive',array('rows'=>6, 'cols'=>50 ,'maxlength'=>128, 'class'=>'span-9')); ?>
			<?php echo $form->error($model,'positive'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'negative'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'negative',array('rows'=>6, 'cols'=>50 ,'maxlength'=>128, 'class'=>'span-9')); ?>
			<?php echo $form->error($model,'negative'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="submit">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('','Simpan') : Yii::t('','Simpan')); ?>
		</div>
		<div class="clear"></div>
	</div>

</fieldset>

<?php $this->endWidget(); ?>

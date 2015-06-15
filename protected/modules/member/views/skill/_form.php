<?php
	/* @var $this JobseekerskillController */
	/* @var $model CcnJobseekerSkill */
	/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccn-jobseeker-skill-form',
	'enableAjaxValidation'=>true,
)); ?>

<fieldset>
	
	<div id="ajax-message"></div>

	<div>
		<?php echo $form->labelEx($model,'technical_skill'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'technical_skill',array('rows'=>6, 'cols'=>50, 'class'=>'span-9')); ?>
			<?php echo $form->error($model,'technical_skill'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'non_technical_skill'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'non_technical_skill',array('rows'=>6, 'cols'=>50, 'class'=>'span-9')); ?>
			<?php echo $form->error($model,'non_technical_skill'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'computer_skill'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'computer_skill',array('rows'=>6, 'cols'=>50, 'class'=>'span-9')); ?>
			<?php echo $form->error($model,'computer_skill'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'other'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'other',array('rows'=>6, 'cols'=>50, 'class'=>'span-9')); ?>
			<?php echo $form->error($model,'other'); ?>
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

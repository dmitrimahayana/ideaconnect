<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'msg-translation-form',
	'enableAjaxValidation'=>true,
)); ?>
<div class="dialog-header">
	<?php echo CHtml::encode($this->pageTitle); ?>
</div>
<div class="dialog-content">

	<fieldset>
		<div>
			<?php echo $form->labelEx($model,'id'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
				<?php echo $form->error($model,'id'); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div>
			<?php echo $form->labelEx($model,'language'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'language',array('size'=>2,'maxlength'=>2)); ?>
				<?php echo $form->error($model,'language'); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div>
			<?php echo $form->labelEx($model,'translation'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'translation',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'translation'); ?>
			</div>
			<div class="clear"></div>
		</div>
	</fieldset>

</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	<?php echo CHtml::button('Closed', array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>

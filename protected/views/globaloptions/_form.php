<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'global-options-form',
	'enableAjaxValidation'=>true,
)); ?>
<div class="dialog-header">
	<?php echo CHtml::encode($this->pageTitle); ?>
</div>
<div class="dialog-content">
	<fieldset>

		<div>
			<?php echo $form->labelEx($model,'option_name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'option_name',array('size'=>60,'maxlength'=>128)); ?>
				<?php echo $form->error($model,'option_name'); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div>
			<?php echo $form->labelEx($model,'option_value'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'option_value',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'option_value'); ?>
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

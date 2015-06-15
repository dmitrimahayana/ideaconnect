<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hooks-form',
	'enableAjaxValidation'=>true,
));
?>
<div class="dialog-header">
	<?php echo CHtml::encode($this->pageTitle); ?>
</div>
<div class="dialog-content">

	<fieldset>

		<div>
			<?php echo $form->labelEx($model,'hook_name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'hook_name',array('size'=>60,'maxlength'=>100)); ?>
				<?php echo $form->error($model,'hook_name'); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div>
			<?php echo $form->labelEx($model,'published'); ?>
			<div class="desc">
				<?php echo 
				$enableOption = array(1 => 'Ya', 0 => 'Tidak');
				$form->dropDownList($model, 'published', $enableOption, array(
					'prompt' => 'Pilih salah satu')); ?>
				<?php echo $form->error($model,'published'); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div>
			<?php echo $form->labelEx($model,'desc'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'desc',array('size'=>60,'maxlength'=>255)); ?>
				<?php echo $form->error($model,'desc'); ?>
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

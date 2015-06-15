<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'com-modules-form',
	'enableAjaxValidation'=>true,
));
$enableOption = array(1 => 'Ya', 0 => 'Tidak');
?>
<div class="dialog-header">
	<?php echo CHtml::encode($this->pageTitle); ?>
</div>
<div class="dialog-content">

	<fieldset>

		<div>
			<?php echo $form->labelEx($model,'name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'name',array('maxlength'=>50,'class'=>'span-5')); ?>
				<?php echo $form->error($model,'name'); ?>
			</div>
			<div class="clear"></div>
		</div>
		
		<?php /*
		<div>
			<?php echo $form->labelEx($model, 'description'); ?>
			<div class="desc">
				<?php echo $form->textArea($model, 'description',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'description'); ?>
			</div>
			<div class="clear"></div>
		</div>

		
		<div>
			<?php echo $form->labelEx($model,'public_menu_link'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'public_menu_link',array('size'=>60,'maxlength'=>255)); ?>
				<?php echo $form->error($model,'public_menu_link'); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div>
			<?php echo $form->labelEx($model,'admin_menu_link'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'admin_menu_link',array('size'=>60,'maxlength'=>255)); ?>
				<?php echo $form->error($model,'admin_menu_link'); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div>
			<?php echo $form->labelEx($model,'parent'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'parent',array('size'=>11,'maxlength'=>11)); ?>
				<?php echo $form->error($model,'parent'); ?>
			</div>
			<div class="clear"></div>
		</div>
		*/ ?>

		<div>
			<?php echo $form->labelEx($model,'module'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'module',array('maxlength'=>50,'class'=>'span-4')); ?>
				<?php echo $form->error($model,'module'); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div>
			<?php echo $form->labelEx($model,'ordering'); ?>
			<div class="desc">
				<?php if(!$model->isNewRecord): ?>
					<?php echo $form->textField($model,'ordering',array('class'=>'span-1')); ?>
					<?php echo $form->error($model,'ordering'); ?>
				<?php else: ?>
					Pengurutan tampil setelah data disimpan.
				<?php endif; ?>
			</div>
			<div class="clear"></div>
		</div>

		<div>
			<?php echo $form->labelEx($model,'params'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50,'class'=>'span-4')); ?>
				<?php echo $form->error($model,'params'); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div>
			<?php echo $form->labelEx($model,'enabled'); ?>
			<div class="desc">
				<?php echo $form->dropDownList($model, 'enabled', Utility::getEnableList(), array(
					'prompt' => 'Pilih salah satu')); ?>
				<?php echo $form->error($model,'enabled'); ?>
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

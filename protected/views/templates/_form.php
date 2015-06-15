<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'templates-form',
	'enableAjaxValidation'=>false,
));

$enableOption = array(1 => 'Ya', 0 => 'Tidak');
?>
<?php echo $form->errorSummary($model); ?>

<fieldset>

	<div>
		<?php echo $form->labelEx($model, 'group_page'); ?>
		<div class="desc">
			<?php echo $form->dropDownList($model, 'group_page', $model->getGroupPage(), array(
				'prompt' => 'Pilih salah satu'),array('tabindex'=>1)); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'template'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'template',array('maxlength'=>100,'class'=>'span-5','tabindex'=>2)); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'default_theme'); ?>
		<div class="desc">
			<?php echo $form->dropDownList($model, 'default_theme', $enableOption, array(
				'prompt' => 'Pilih salah satu'),array('tabindex'=>3)); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'path_folder'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'path_folder',array('maxlength'=>100,'class'=>'span-3','tabindex'=>4)); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'thumbnail'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'thumbnail',array('maxlength'=>200,'class'=>'span-3','tabindex'=>5)); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="submit">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan',array('tabindex'=>6)); ?>
		</div>
		<div class="clear"></div>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

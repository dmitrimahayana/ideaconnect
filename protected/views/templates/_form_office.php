<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'templates-form',
	'enableAjaxValidation'=>false,
));?>
<div class="dialog-header">
	<?php echo CHtml::encode($this->pageTitle); ?>
</div>
<div class="dialog-content">
	<fieldset>

		<div class="clearfix">
			<?php echo $form->labelEx($model, 'group_page'); ?>
			<div class="desc">
				<?php echo $form->dropDownList($model, 'group_page', $model->getGroupPage(), array(
					'prompt' => 'Pilih salah satu'
				)); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'template'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'template',array('maxlength'=>100,'class'=>'span-7')); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'path_folder'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'path_folder',array('maxlength'=>100,'class'=>'span-7')); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'default_theme'); ?>
			<div class="desc">
				<?php 
				$enableOption = array(1 => 'Ya', 0 => 'Tidak');
				echo $form->dropDownList($model, 'default_theme', $enableOption, array(
					'prompt' => 'Pilih salah satu')); ?>
			</div>
		</div>


	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('','Tambah') : Yii::t('','Simpan'), array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('','Keluar'), array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>

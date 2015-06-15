<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'languages-form',
	'enableAjaxValidation'=>true,
)); ?>
<div class="dialog-header">
	<?php echo CHtml::encode($this->pageTitle); ?>
</div>
<div class="dialog-content">
	<fieldset>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'title'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'title',array('maxlength'=>100,'class'=>'span-7')); ?>
				<?php echo $form->error($model,'title'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'lang_id'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'lang_id',array('maxlength'=>6,'class'=>'span-4')); ?>
				<?php echo $form->error($model,'lang_id'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'iso'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'iso',array('maxlength'=>20,'class'=>'span-5')); ?>
				<?php echo $form->error($model,'iso'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'params'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50,'class'=>'span-9 smaller')); ?>
				<?php echo $form->error($model,'params'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'active'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'active'); ?>
				<?php echo $form->error($model,'active'); ?>
			</div>
		</div>

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('','Tambah') : Yii::t('','Simpan'), array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('','Keluar'), array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>

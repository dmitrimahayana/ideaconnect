<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'com-modules-form',
	'enableAjaxValidation'=>true,
)); ?>
<div class="dialog-header">
	<?php echo CHtml::encode($this->pageTitle); ?>
</div>
<div class="dialog-content">

	<fieldset>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'name',array('maxlength'=>50,'class'=>'span-7')); ?>
				<?php echo $form->error($model,'name'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'module'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'module',array('maxlength'=>50,'class'=>'span-7')); ?>
				<?php echo $form->error($model,'module'); ?>
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
			<?php echo $form->labelEx($model,'enabled'); ?>
			<div class="desc">
				<?php echo $form->dropDownList($model, 'enabled', Utility::getEnableList(), array(
					'prompt' => 'Pilih salah satu')); ?>
				<?php echo $form->error($model,'enabled'); ?>
			</div>
		</div>

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('','Tambah') : Yii::t('','Simpan'), array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('','Keluar'), array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>

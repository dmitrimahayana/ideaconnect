<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'menu-types-form',
	'enableAjaxValidation'=>false,
)); ?>
<div class="dialog-header">
	<?php echo CHtml::encode($this->pageTitle); ?>
</div>
<div class="dialog-content">

	<fieldset>
		
		<div>
			<?php echo $form->labelEx($model,'group_type'); ?>
			<div class="desc">
				<?php echo $form->dropDownList($model,'group_type',array('back_office'=>'back_office','public'=>'public')); ?>
				<?php echo $form->error($model,'group_type'); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div>
			<?php echo $form->labelEx($model,'menu_type'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'menu_type',array('size'=>60,'maxlength'=>75)); ?>
				<?php echo $form->error($model,'menu_type'); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div>
			<?php echo $form->labelEx($model,'title'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
				<?php echo $form->error($model,'title'); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div>
			<?php echo $form->labelEx($model,'description'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
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

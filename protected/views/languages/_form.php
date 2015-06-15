<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'languages-form',
	'enableAjaxValidation'=>false,
)); ?>
<fieldset>

	<div>
		<?php echo $form->labelEx($model,'lang_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'lang_id',array('maxlength'=>6,'class'=>'span-2','tabindex'=>1)); ?>
			<?php echo $form->error($model,'lang_id'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'title'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'title',array('maxlength'=>100,'class'=>'span-5','tabindex'=>2)); ?>
			<?php echo $form->error($model,'title'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'active'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'active',array('tabindex'=>3)); ?>
			<?php echo $form->error($model,'active'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'iso'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'iso',array('maxlength'=>20,'class'=>'span-3','tabindex'=>4)); ?>
			<?php echo $form->error($model,'iso'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'code'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'code',array('maxlength'=>20,'class'=>'span-3','tabindex'=>5)); ?>
			<?php echo $form->error($model,'code'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'image'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'image',array('maxlength'=>100,'tabindex'=>6)); ?>
			<?php echo $form->error($model,'image'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'params'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50,'class'=>'span-5','tabindex'=>7)); ?>
			<?php echo $form->error($model,'params'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'ordering'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'ordering',array('class'=>'span-2','tabindex'=>8)); ?>
			<?php echo $form->error($model,'ordering'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="submit">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('tabindex'=>9)); ?>
		</div>
		<div class="clear"></div>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

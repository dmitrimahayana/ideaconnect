<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'content-section-form',
	'enableAjaxValidation'=>false,
)); ?>
<fieldset>

	<div>
		<?php echo $form->labelEx($model,'title'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>80)); ?>
			<?php echo $form->error($model,'title'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'alias_url'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'alias_url',array('size'=>60,'maxlength'=>200)); ?>
			<?php echo $form->error($model,'alias_url'); ?>
		</div> 
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'description'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'description'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'image'); ?>
		<div class="desc">
			<?php echo $form->fileField($model,'image',array('maxlength'=>255)); ?>
			<?php echo $form->error($model,'image'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'image_position'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'image_position',array('size'=>30,'maxlength'=>30)); ?>
			<?php echo $form->error($model,'image_position'); ?>
		</div>
		<div class="clear"></div>
	</div>


	<div>
		<?php echo $form->labelEx($model,'ordering'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'ordering',array('size'=>4)); ?>
			<?php echo $form->error($model,'ordering'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'access'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'access'); ?>
			<?php echo $form->error($model,'access'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'params'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'params'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'published'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'published'); ?>
			<?php echo $form->error($model,'published'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	
	<div class="submit">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>
		<div class="clear"></div>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

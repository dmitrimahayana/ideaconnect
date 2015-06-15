<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-details-form',
	'enableAjaxValidation'=>true,
)); ?>

<fieldset>

	<div id="ajax-message">
		<?php echo $form->errorSummary($model); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'alias_url'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'alias_url',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'alias_url'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'address'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'address'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'city'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'city'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'propincy'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'propincy',array('size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'propincy'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'country'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'country',array('size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'country'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'post_code'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'post_code',array('size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'post_code'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'telephone'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'telephone',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'telephone'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'fax'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'fax',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'fax'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	
	<div>
		<?php echo $form->labelEx($model,'messenger_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'messenger_id',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'messenger_id'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'facebook_address'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'facebook_address',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'facebook_address'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'twitter_address'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'twitter_address',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'twitter_address'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'misc'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'misc',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'misc'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'image'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'image'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'image_pos'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'image_pos',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'image_pos'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'email_to'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'email_to',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'email_to'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'published'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'published'); ?>
			<?php echo $form->error($model,'published'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'ordering'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'ordering'); ?>
			<?php echo $form->error($model,'ordering'); ?>
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
		<?php echo $form->labelEx($model,'mobile'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'mobile',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'mobile'); ?>
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

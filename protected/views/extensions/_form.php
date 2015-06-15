<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'com-extensions-form',
	'enableAjaxValidation'=>true,
)); ?>
<div class="dialog-header">
	<?php echo CHtml::encode($this->pageTitle); ?>
</div>
<div class="dialog-content">

	<fieldset>

		<div>
			<?php echo $form->labelEx($model,'name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
				<?php echo $form->error($model,'name'); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div>
			<?php echo $form->labelEx($model,'element'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'element',array('size'=>60,'maxlength'=>100)); ?>
				<?php echo $form->error($model,'element'); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div>
			<?php echo $form->labelEx($model,'folder'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'folder',array('size'=>60,'maxlength'=>100)); ?>
				<?php echo $form->error($model,'folder'); ?>
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
			<?php echo $form->labelEx($model,'ordering'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'ordering'); ?>
				<?php echo $form->error($model,'ordering'); ?>
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
			<?php echo $form->labelEx($model,'params'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'params'); ?>
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

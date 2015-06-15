<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'content-section-form',
	'enableAjaxValidation'=>true,
)); ?>
<fieldset class="clearfix">

	<div id="ajax-message">
		<?php echo $form->errorSummary($model); ?>
	</div>

	<div class="left">
		<div class="shadow"></div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'title'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'title',array('maxlength'=>80,'class'=>'span-6')); ?>
				<?php echo $form->error($model,'title'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'alias_url'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'alias_url',array('maxlength'=>200,'class'=>'span-6')); ?>
				<?php echo $form->error($model,'alias_url'); ?>
			</div> 
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'description'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50,'class'=>'span-9 small')); ?>
				<?php echo $form->error($model,'description'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'params'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50,'class'=>'span-9 small')); ?>
				<?php echo $form->error($model,'params'); ?>
			</div>
		</div>

	</div>

	<div class="right">
		<div class="shadow"></div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'image'); ?>
			<div class="desc">
				<?php echo $form->fileField($model,'image',array('maxlength'=>255)); ?>
				<?php echo $form->error($model,'image'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'image_position'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'image_position',array('maxlength'=>30,'class'=>'span-8')); ?>
				<?php echo $form->error($model,'image_position'); ?>
			</div>
		</div>

		<?php /*
		<div class="clearfix">
			<?php echo $form->labelEx($model,'ordering'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'ordering'); ?>
				<?php echo $form->error($model,'ordering'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'access'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'access'); ?>
				<?php echo $form->error($model,'access'); ?>
			</div>
		</div>
		*/?>
		
		<div class="clearfix publish">
			<?php echo $form->checkBox($model,'published'); ?>
			<?php echo $form->labelEx($model,'published'); ?>
			<div class="desc">
				<?php echo $form->error($model,'published'); ?>
			</div>
		</div>

	</div>
	<div class="clear"></div>

	<div class="submit clearfix">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('','Tambah') : Yii::t('','Simpan')); ?>
		</div>
	</div>

</fieldset>
<?php $this->endWidget(); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'content-categories-form',
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
				<?php echo $form->textField($model,'title',array('maxlength'=>80,'class'=>'span-7')); ?>
				<?php echo $form->error($model,'title'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'alias_url'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'alias_url',array('maxlength'=>200,'class'=>'span-7')); ?>
				<?php echo $form->error($model,'alias_url'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'description'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50,'class'=>'span-10 smaller')); ?>
				<?php echo $form->error($model,'description'); ?>
			</div>
		</div>

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
				<?php echo $form->textField($model,'image_position',array('size'=>20,'maxlength'=>30,'class'=>'span-5')); ?>
				<?php echo $form->error($model,'image_position'); ?>
			</div>
		</div>

		<?php
		/* <div class="clearfix">
			<?php echo $form->labelEx($model,'editor'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'editor',array('maxlength'=>50,'class'=>'span-3')); ?>
				<?php echo $form->error($model,'editor'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'ordering'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'ordering',array('class'=>'span-1')); ?>
				<?php echo $form->error($model,'ordering'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'access'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'access',array('class'=>'span-1')); ?>
				<?php echo $form->error($model,'access'); ?>
			</div>
		</div> */
		?>
		<?php if (Yii::app()->user->id != '2') {?>
		<div class="clearfix">
			<?php echo $form->labelEx($model,'params'); ?>
			<div class="desc">
				<?php
					if($model->isNewRecord) {
						$model->params = '#INPUT-FIELD#
content_categories_id=1,
parent_id=1,
title=1,
alias_url=1,
intro_text=1,
full_text=1,
meta_key=1,
meta_desc=1,
publish_up=1,
publish_down=1,
images=1,
url=1,
ordering=1,
published=1
#END-INPUT-FORM#
-----
#DISPLAY-FIELD#
content_categories_id=1,
parent_id=1,
title=0,
alias_url=1,
intro_text=1,
full_text=1,
meta_key=1,
meta_desc=1,
publish_up=1,
publish_down=1,
images=1,
url=1,
ordering=1,
published=1
#END-DISPLAY-FIELD#
';
					}
				
				?>
				<?php echo $form->textArea($model,'params',array('rows'=>15, 'cols'=>50)); ?>
				<?php echo $form->error($model,'params'); ?>
			</div>
		</div>
		<?php }?>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'published'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'published'); ?>
				<?php echo $form->error($model,'published'); ?>
			</div>
		</div>
	</fieldset>

</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('','Tambah') : Yii::t('','Simpan'), array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('','Keluar'), array('id'=>'closed')); ?>
</div>

<?php $this->endWidget(); ?>

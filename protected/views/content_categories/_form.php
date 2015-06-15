<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'content-categories-form',
	'enableAjaxValidation'=>true,
)); ?>

<fieldset>
	<div>
		<?php echo $form->labelEx($model,'content_section_id'); ?>
		<div class="desc">
			<?php $listData = CHtml::listData(ContentSection::model()->findAllByAttributes(array('published'=>1)), 'id','title'); ?>
			<?php echo $form->dropDownList($model,'content_section_id', $listData, array('prompt'=>Yii::t('', 'Pilih satu'),'tabindex'=>1)); ?>
			<?php echo $form->error($model,'content_section_id'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<div class="desc">
			<?php $listData = CHtml::listData(ContentCategories::model()->findAllByAttributes(array('published'=>1)), 'id','title'); ?>
			<?php echo $form->dropDownList($model,'parent_id', $listData, array('prompt'=>Yii::t('', 'No Parent'),'tabindex'=>2)); ?>
			<?php echo $form->error($model,'parent_id'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'title'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'title',array('maxlength'=>80,'class'=>'span-6','tabindex'=>3)); ?>
			<?php echo $form->error($model,'title'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'alias_url'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'alias_url',array('maxlength'=>200,'class'=>'span-3','tabindex'=>4)); ?>
			<?php echo $form->error($model,'alias_url'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'description'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50,'class'=>'span-5','tabindex'=>5)); ?>
			<?php echo $form->error($model,'description'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'image'); ?>
		<div class="desc">
			<?php echo $form->fileField($model,'image',array('maxlength'=>255,'tabindex'=>6)); ?>
			<?php echo $form->error($model,'image'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'image_position'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'image_position',array('size'=>20,'maxlength'=>30,'class'=>'span-1','tabindex'=>7)); ?>
			<?php echo $form->error($model,'image_position'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<?php
	/* <div>
		<?php echo $form->labelEx($model,'editor'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'editor',array('maxlength'=>50,'class'=>'span-3','tabindex'=>8)); ?>
			<?php echo $form->error($model,'editor'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'ordering'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'ordering',array('class'=>'span-1','tabindex'=>9)); ?>
			<?php echo $form->error($model,'ordering'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'access'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'access',array('class'=>'span-1','tabindex'=>10)); ?>
			<?php echo $form->error($model,'access'); ?>
		</div>
		<div class="clear"></div>
	</div> */
	?>
	
	<?php if (Yii::app()->user->id != '2') {?>
	<div>
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
		<div class="clear"></div>
	</div>
	<?php }?>
	
	<div>
		<?php echo $form->labelEx($model,'published'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'published',array('tabindex'=>11)); ?>
			<?php echo $form->error($model,'published'); ?>
		</div>
		<div class="clear"></div>
	</div>


	<div class="submit">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('tabindex'=>12)); ?>
		</div>
		<div class="clear"></div>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

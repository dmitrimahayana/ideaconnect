<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'content-frontpage-form',
	'enableAjaxValidation'=>true,
)); ?>
<div class="dialog-header">
	<?php echo CHtml::encode($this->pageTitle); ?>
</div>
<div class="dialog-content">

	<fieldset>

		<div>
			<?php echo $form->labelEx($model,'content_id'); ?>
			<div class="desc">
				<?php $listData = CHtml::listData(Content::model()->findAllByAttributes(array('published'=>1)), 'id','title'); ?>
				<?php echo $form->dropDownList($model,'content_id', $listData, array('prompt'=>Yii::t('', 'Choose One'))); ?>
				<?php echo $form->error($model,'content_id'); ?>
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
	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	<?php echo CHtml::button('Closed', array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>

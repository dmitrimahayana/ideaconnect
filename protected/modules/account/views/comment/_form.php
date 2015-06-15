<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<div id="ajax-message"><?php echo $form->errorSummary($model); ?></div>

	<fieldset>
	<div>
		<?php echo $form->labelEx($model,'content'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'content'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'parent_id',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'parent_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'project_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'project_id',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'project_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'commentator_name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'commentator_name',array('size'=>60,'maxlength'=>80)); ?>
			<?php echo $form->error($model,'commentator_name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'commentator_email'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'commentator_email',array('size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'commentator_email'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'created_time'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'created_time'); ?>
			<?php echo $form->error($model,'created_time'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'is_published'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'is_published'); ?>
			<?php echo $form->error($model,'is_published'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
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


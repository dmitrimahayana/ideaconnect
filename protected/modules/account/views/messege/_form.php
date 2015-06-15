<?php
/* @var $this MessegeController */
/* @var $model Messege */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'messege-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<div id="ajax-message"><?php echo $form->errorSummary($model); ?></div>

	<fieldset>
	<div>
		<?php echo $form->labelEx($model,'subject'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'subject'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'messege'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'messege',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'messege'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'from_user_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'from_user_id',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'from_user_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'from_user_name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'from_user_name',array('size'=>60,'maxlength'=>80)); ?>
			<?php echo $form->error($model,'from_user_name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'to_user_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'to_user_id',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'to_user_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'to_user_name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'to_user_name',array('size'=>60,'maxlength'=>80)); ?>
			<?php echo $form->error($model,'to_user_name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'is_read'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'is_read'); ?>
			<?php echo $form->error($model,'is_read'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'sent_time'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'sent_time'); ?>
			<?php echo $form->error($model,'sent_time'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'is_deleted_by_sender'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'is_deleted_by_sender'); ?>
			<?php echo $form->error($model,'is_deleted_by_sender'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'is_deleted_by_receiver'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'is_deleted_by_receiver'); ?>
			<?php echo $form->error($model,'is_deleted_by_receiver'); ?>
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


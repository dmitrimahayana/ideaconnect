<?php
/* @var $this UsersGroupController */
/* @var $model UsersGroup */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-group-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<div id="ajax-message"><?php echo $form->errorSummary($model); ?></div>

	<fieldset>
	<div>
		<?php echo $form->labelEx($model,'name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'params'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'params'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'group_name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'group_name',array('size'=>30,'maxlength'=>30)); ?>
			<?php echo $form->error($model,'group_name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

<!--	<div>-->
<!--		--><?php //echo $form->labelEx($model,'group_login'); ?>
<!--		<div class="desc">-->
<!--			--><?php //echo $form->textField($model,'group_login',array('size'=>12,'maxlength'=>12)); ?>
<!--			--><?php //echo $form->error($model,'group_login'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
<!--		</div>-->
<!--		<div class="clear"></div>-->
<!--	</div>-->

	<div class="submit">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>
		<div class="clear"></div>
	</div>
	</fieldset>
<?php $this->endWidget(); ?>


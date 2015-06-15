<?php
/* @var $this FundingController */
/* @var $model Funding */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'funding-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<div id="ajax-message"><?php echo $form->errorSummary($model); ?></div>

	<fieldset>
	<div>
		<?php echo $form->labelEx($model,'requirement'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'requirement',array('size'=>60,'maxlength'=>80)); ?>
			<?php echo $form->error($model,'requirement'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'value'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'value',array('size'=>14,'maxlength'=>14)); ?>
			<?php echo $form->error($model,'value'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'unit'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'unit',array('size'=>30,'maxlength'=>30)); ?>
			<?php echo $form->error($model,'unit'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'requisite_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'requisite_id',array('size'=>11,'maxlength'=>11)); ?>
			<?php echo $form->error($model,'requisite_id'); ?>
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


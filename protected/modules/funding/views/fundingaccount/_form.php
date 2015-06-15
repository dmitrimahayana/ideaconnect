<?php
/* @var $this FundingAccountController */
/* @var $model FundingAccount */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'funding-account-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<div id="ajax-message"><?php echo $form->errorSummary($model); ?></div>

	<fieldset>
	<div>
		<?php echo $form->labelEx($model,'bank_id'); ?>
		<div class="desc">
			<?php
            echo CHtml::activeDropDownList($model, "bank_id", Bank::model()->getCategory(), array("prompt"=>" - Pilihan Kategori Berita - "));
			//echo $form->textField($model,'bank_id'); ?>
			<?php echo $form->error($model,'bank_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'account_number'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'account_number',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'account_number'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'owner_name_alias'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'owner_name_alias',array('size'=>60,'maxlength'=>80)); ?>
			<?php echo $form->error($model,'owner_name_alias'); ?>
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


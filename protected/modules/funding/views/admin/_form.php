<?php
/* @var $this FundingUserController */
/* @var $model FundingUser */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'funding-user-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<div id="ajax-message"><?php echo $form->errorSummary($model); ?></div>

	<fieldset>
<!--	<div>-->
<!--		--><?php //echo $form->labelEx($model,'sponsor_id'); ?>
<!--		<div class="desc">-->
			<?php echo $form->hiddenField($model,'sponsor_id',array('size'=>10,'maxlength'=>10)); ?>
<!--			--><?php //echo $form->error($model,'sponsor_id'); ?>
<!--			--><?php ///*<div class="small-px silent"></div>*/?>
<!--		</div>-->
<!--		<div class="clear"></div>-->
<!--	</div>-->

	<div>
		<?php echo $form->labelEx($model,'sponsor_name'); ?>
		<div class="desc">
			<?php echo $model->sponsor_name;//$form->textField($model,'sponsor_name',array('size'=>60,'maxlength'=>80)); ?>
			<?php echo $form->error($model,'sponsor_name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

<!--	<div>-->
<!--		--><?php //echo $form->labelEx($model,'requisite_id'); ?>
<!--		<div class="desc">-->
<!--			--><?php //echo $form->hiddenField($model,'requisite_id',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'requisite_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
<!--		</div>-->
<!--		<div class="clear"></div>-->
<!--	</div>-->

<!--	<div>-->
<!--		--><?php //echo $form->labelEx($model,'as_institution_id'); ?>
<!--		<div class="desc">-->
			<?php echo $form->hiddenField($model,'as_institution_id',array('size'=>10,'maxlength'=>10)); ?>
<!--			--><?php //echo $form->error($model,'as_institution_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
<!--		</div>-->
<!--		<div class="clear"></div>-->
<!--	</div>-->

	<div>
		<?php echo $form->labelEx($model,'as_institution_name'); ?>
		<div class="desc">
			<?php echo $model->as_institution_name;//$form->textField($model,'as_institution_name',array('size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'as_institution_name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'account_from_number'); ?>
		<div class="desc">
            <?php echo $model->account_from_number; ?>
			<?php echo $form->hiddenField($model,'account_from_number',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'account_from_number'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

<!--	<div>-->
<!--		--><?php //echo $form->labelEx($model,'bank_from_id'); ?>
<!--		<div class="desc">-->
			<?php echo $form->hiddenField($model,'bank_from_id'); ?>
<!--			--><?php //echo $form->error($model,'bank_from_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
<!--		</div>-->
<!--		<div class="clear"></div>-->
<!--	</div>-->

	<div>
		<?php echo $form->labelEx($model,'bank_from_name'); ?>
		<div class="desc">
			<?php echo $model->bank_from_name;//$form->textField($model,'bank_from_name',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'bank_from_name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

<!--	<div>-->
<!--		--><?php //echo $form->labelEx($model,'account_to_id'); ?>
<!--		<div class="desc">-->
			<?php echo $form->hiddenField($model,'account_to_id'); ?>
<!--			--><?php //echo $form->error($model,'account_to_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
<!--		</div>-->
<!--		<div class="clear"></div>-->
<!--	</div>-->

	<div>
		<?php echo $form->labelEx($model,'account_to_number'); ?>
		<div class="desc">
			<?php echo $model->account_to_number;//$form->textField($model,'account_to_number',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'account_to_number'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'value'); ?>
		<div class="desc">
            <?php echo $model->value; ?>
			<?php echo $form->hiddenField($model,'value',array('size'=>14,'maxlength'=>14)); ?>
			<?php echo $form->error($model,'value'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'unit'); ?>
		<div class="desc">
			<?php echo $model->unit;//$form->textField($model,'unit',array('size'=>30,'maxlength'=>30)); ?>
			<?php echo $form->error($model,'unit'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'is_verified'); ?>
		<div class="desc">
			<?php
            echo $form->dropDownList($model, 'is_verified',FundingUser::model()->getStatus("Yes", "No"), array(
                'prompt' => 'Pilih Status',
                'style' => 'width:80px'
            ));
			//echo $form->textField($model,'is_verified'); ?>
			<?php echo $form->error($model,'is_verified'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

<!--	<div>-->
<!--		--><?php //echo $form->labelEx($model,'varificator_id'); ?>
<!--		<div class="desc">-->
<!--			--><?php //echo $form->textField($model,'varificator_id',array('size'=>10,'maxlength'=>10)); ?>
<!--			--><?php //echo $form->error($model,'varificator_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
<!--		</div>-->
<!--		<div class="clear"></div>-->
<!--	</div>-->
<!---->
<!--	<div>-->
<!--		--><?php //echo $form->labelEx($model,'verification_time'); ?>
<!--		<div class="desc">-->
<!--			--><?php //echo $form->textField($model,'verification_time'); ?>
<!--			--><?php //echo $form->error($model,'verification_time'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
<!--		</div>-->
<!--		<div class="clear"></div>-->
<!--	</div>-->

<!--	<div>-->
<!--		--><?php //echo $form->labelEx($model,'had_been_returned'); ?>
<!--		<div class="desc">-->
			<?php echo $form->hiddenField($model,'had_been_returned'); ?>
<!--			--><?php //echo $form->error($model,'had_been_returned'); ?>
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


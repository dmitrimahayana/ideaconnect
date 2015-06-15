<?php
/* @var $this ZoneProvinceController */
/* @var $model ZoneProvince */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'zone-province-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<div id="ajax-message"><?php echo $form->errorSummary($model); ?></div>

	<fieldset>
	<div>
		<?php echo $form->labelEx($model,'name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo $form->error($model,'name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'country_code'); ?>
		<div class="desc">
			<?php
            echo CHtml::activeDropDownList($model, "country_code", ZoneCountry::model()->getCategory(), array("prompt"=>" - Pilihan Negara - "));
            //echo $form->textField($model,'country_code',array('size'=>2,'maxlength'=>2)); ?>
			<?php echo $form->error($model,'country_code'); ?>
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


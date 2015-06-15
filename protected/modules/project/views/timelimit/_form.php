<?php
/* @var $this TimeLimitController */
/* @var $model TimeLimit */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'time-limit-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<div id="ajax-message"><?php echo $form->errorSummary($model); ?></div>

	<fieldset>
	<div>
		<?php echo $form->labelEx($model,'month_limit'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'month_limit'); ?>
			<?php echo $form->error($model,'month_limit'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'is_funding_time'); ?>
		<div class="desc">
			<?php
            echo $form->dropDownList($model, 'is_actived',Project::model()->getStatus("Pendanaan", "Project"), array(
                'prompt' => 'Pilih Setting Waktu',
                'style' => 'width:80px'
            ));//echo $form->textField($model,'is_funding_time'); ?>
			<?php echo $form->error($model,'is_funding_time'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'is_actived'); ?>
		<div class="desc">
			<?php
            echo $form->dropDownList($model, 'is_actived',Project::model()->getStatus("Yes", "No"), array(
                'prompt' => 'Pilih',
                'style' => 'width:80px'
            ));//echo $form->textField($model,'is_actived'); ?>
			<?php echo $form->error($model,'is_actived'); ?>
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


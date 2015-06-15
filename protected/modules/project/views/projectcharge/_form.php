<?php
/* @var $this ProjectChargeController */
/* @var $model ProjectCharge */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-charge-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<div id="ajax-message"><?php echo $form->errorSummary($model); ?></div>

	<fieldset>
	<div>
		<?php echo $form->labelEx($model,'is_percentage'); ?>
		<div class="desc">
			<?php
            echo $form->dropDownList($model, 'is_percentage',Project::model()->getStatus("Yes", "No"), array(
                'prompt' => 'Pilih Status',
                'style' => 'width:80px'
            ));//echo $form->textField($model,'is_percentage'); ?>
			<?php echo $form->error($model,'is_percentage'); ?>
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
		<?php echo $form->labelEx($model,'is_actived'); ?>
		<div class="desc">
			<?php
            echo $form->dropDownList($model, 'is_actived',Project::model()->getStatus("Yes", "No"), array(
                'prompt' => 'Pilih Status',
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


<?php
/* @var $this JobseekerreferenceController */
/* @var $model CcnJobseekerReference */
/* @var $form CActiveForm */
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/module/member/member_reference_wizard.css');
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccn-jobseeker-reference-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=> array(
		'name'=>2,
	)
)); ?>

<fieldset>

	<div>
		<?php echo $form->labelEx($model,'name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'name',array('maxlength'=>70, 'class'=>'span-6')); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'position'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'position',array('maxlength'=>70, 'class'=>'span-5')); ?>
			<?php echo $form->error($model,'position'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'phone'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'phone',array('maxlength'=>20, 'class'=>'span-5')); ?>
			<?php echo $form->error($model,'phone'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'address'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50, 'maxlength'=>256, 'class'=>'span-8')); ?>
			<?php echo $form->error($model,'address'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'contactable'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'contactable'); ?>
			<?php echo $form->error($model,'contactable'); ?>
		</div>
		<div class="clear"></div>
	</div>


	<div class="submit">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('','Tambah') : Yii::t('','Simpan'), array('onclick' => 'setEnableSave()')); ?>
			<?php echo CHtml::button($model->isNewRecord ? Yii::t('','Batal') : Yii::t('','Batal') ,array('id'=>'cancel')); ?>
		</div>
		<div class="clear"></div>
	</div>

</fieldset>

<?php $this->endWidget(); ?>

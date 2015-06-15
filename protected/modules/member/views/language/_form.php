<?php
	/* @var $this JobseekerlangController */
	/* @var $model CcnJobseekerLang */
	/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccn-jobseeker-lang-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=> array(
		'name'=>2,
	)
)); ?>


<fieldset>
	
	<div>
		<?php echo $form->labelEx($model,'lang_name'); ?>
		<div class="desc">
			<?php echo $form->dropDownlist($model,'lang_name',array(
				'Prancis'	=> 'Prancis',
				'Mandarin'	=> 'Mandarin',
				'Korea'	=> 'Korea',
				'Belanda'	=> 'Belanda',
				'Inggris'	=> 'Inggris',
			)); ?>
			<?php echo $form->error($model,'lang_name'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'ability'); ?>
		<div class="desc">
			<?php echo $form->dropDownlist($model,'ability',array(
				'1'	=> 'Cukup',
				'2'	=> 'Baik',
				'3'	=> 'Sangat Baik',
			)); ?>
			<?php echo $form->error($model,'ability'); ?>
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

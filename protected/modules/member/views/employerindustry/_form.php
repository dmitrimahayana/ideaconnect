<?php
/* @var $this EmployerindustryController */
/* @var $model CcnEmployerIndustry */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccn-employer-industry-form',
	'enableAjaxValidation'=>false,
)); ?>
<div class="dialog-header">
	<?php echo CHtml::encode($this->pageTitle); ?>
</div>
<div class="dialog-content">	

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

	</fieldset>
</div>
    
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('','Tambah') : Yii::t('','Simpan'), array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('','Keluar'), array('id'=>'closed')); ?>
</div>

<?php $this->endWidget(); ?>

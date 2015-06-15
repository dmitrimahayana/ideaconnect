<?php
	/* @var $this JobseekerawardController */
	/* @var $model CcnJobseekerAward */
	/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccn-jobseeker-award-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=> array(
		'name'=>2,
	)
)); ?>

<fieldset>

	<div>
		<?php echo $form->labelEx($model,'award_name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'award_name',array('maxlength'=>70, 'class'=>'span-6')); ?>
			<?php echo $form->error($model,'award_name'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'sponsor'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'sponsor',array('maxlength'=>70, 'class'=>'span-5')); ?>
			<?php echo $form->error($model,'sponsor'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'year'); ?>
		<div class="desc">
			<?php
			$years = array();
			$year	= '';
			for ($i = date("Y"); $i >= date("Y")-10; $i--) {
				if (strlen($i) < 2)
					$year = '0'.$i;
				else
					$year = $i;
				$years[$i] = $year;
			}
			?>
			<?php echo $form->dropDownlist($model,'year',$years); ?>
			<?php echo $form->error($model,'year'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'note'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'note',array('row'=>6, 'cols'=> 50 ,'maxlength'=>150, 'class'=>'span-8 small')); ?>
			<?php echo $form->error($model,'note'); ?>
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

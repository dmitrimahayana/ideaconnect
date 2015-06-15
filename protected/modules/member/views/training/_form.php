<?php
	/* @var $this JobseekertrainingController */
	/* @var $model CcnJobseekerTraining */
	/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccn-jobseeker-training-form',
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
		<?php echo $form->labelEx($model,'training_time'); ?>
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
			<?php echo $form->dropDownlist($model,'training_time',$years); ?>
			<?php echo $form->error($model,'training_time'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'organizer'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'organizer',array('maxlength'=>50, 'class'=>'span-6')); ?>
			<?php echo $form->error($model,'organizer'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'certificate'); ?>
		<div class="desc">
			<?php echo $form->checkbox($model,'certificate'); ?>
			<?php echo $form->error($model,'certificate'); ?>
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

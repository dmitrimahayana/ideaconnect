<?php
	/* @var $this JobseekertoeflController */
	/* @var $model CcnJobseekerToefl */
	/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccn-jobseeker-toefl-form',
	'enableAjaxValidation'=>true,
)); ?>

<fieldset>

	<div id="ajax-message"></div>

	<div>
		<?php echo $form->labelEx($model,'toefl_score'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'toefl_score', array('maxlength'=>3, 'class'=>'span-3')); ?>
			<?php echo $form->error($model,'toefl_score'); ?>
            <div class="small-px silent"><?php echo Yii::t('','Isikan nilai tes TOEFL. Contoh : 350'); ?></div>
		</div>
		<div class="clear"></div>
	</div>
	
    <div>
		<?php echo $form->labelEx($model,'toefl_years'); ?>
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
			<?php echo $form->dropDownList($model,'toefl_years',$years); ?>
			<?php echo $form->error($model,'toefl_years'); ?>
		</div>
		<div class="clear"></div>
	</div>
    
	<div>
		<?php echo $form->labelEx($model,'ielts_score'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'ielts_score',array('maxlength'=>3, 'class'=>'span-3')); ?>
			<?php echo $form->error($model,'ielts_score'); ?>
			<div class="small-px silent"><?php echo Yii::t('','Pisahkan angka dengan titik. Contoh : 8.9'); ?></div>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'ielts_years'); ?>
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
			<?php echo $form->dropDownList($model,'ielts_years',$years); ?>
			<?php echo $form->error($model,'ielts_years'); ?>
		</div>
		<div class="clear"></div>
	</div>


	<div class="submit">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('','Simpan') : Yii::t('','Simpan'), array('onclick' => 'setEnableSave()')); ?>
		</div>
		<div class="clear"></div>
	</div>

</fieldset>

<?php $this->endWidget(); ?>

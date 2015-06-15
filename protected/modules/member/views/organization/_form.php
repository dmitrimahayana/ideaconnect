<?php
	/* @var $this CcnJobseekerorgController */
	/* @var $model CcnJobseekerOrg */
	/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccn-jobseeker-org-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=> array(
		'name'=>2,
	)
)); ?>

<fieldset>

	<div>
		<?php echo $form->labelEx($model,'org_name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'org_name',array('maxlength'=>32, 'class'=>'span-6')); ?>
			<?php echo $form->error($model,'org_name'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'position'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'position',array('maxlength'=>50, 'class'=>'span-6')); ?>
			<?php echo $form->error($model,'position'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'description'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'description',array('maxlength'=>50, 'class'=>'span-6 small')); ?>
			<?php echo $form->error($model,'description'); ?>
		</div>
		<div class="clear"></div>
	</div>


	<div>
		<?php echo $form->labelEx($model,'start_date'); ?>
		<div class="desc">
			<?php
			if($model->start_date != null) {
				$model->start_date = date('d-m-Y', strtotime($model->start_date));
			}
			echo $form->textField($model,'start_date',array('class'=>'span-4'));
			/* $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'attribute' => 'start_date',
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'slideDown',
					'dateFormat'	=> 'dd-mm-yy'
				),
				'htmlOptions'=>array(),
				)); */
			?>
			&nbsp;&nbsp;<?php echo $form->checkBox($model,'active'); ?>&nbsp;Masih&nbsp;Aktif
			<?php echo $form->error($model,'start_date'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div id="current">
		<?php echo $form->labelEx($model,'finish_date'); ?>
		<div class="desc">
			<?php
			if($model->finish_date != null) {
				$model->finish_date = date('d-m-Y', strtotime($model->finish_date));
			}
			echo $form->textField($model,'finish_date',array('class'=>'span-4'));
			/* $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'attribute' => 'finish_date',
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'slideDown',
					'dateFormat'	=> 'dd-mm-yy'
				),
				'htmlOptions'=>array(),
				)); */
			?>
			<?php echo $form->error($model,'finish_date'); ?>
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

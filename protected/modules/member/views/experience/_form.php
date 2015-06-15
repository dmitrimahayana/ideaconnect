<?php
	/* @var $this JobseekerexpController */
	/* @var $model CcnJobseekerExp */
	/* @var $form CActiveForm */
	$current = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccn-jobseeker-exp-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=> array(
		'name'=>2,
	)
)); ?>

<fieldset>

	<div>
		<?php echo $form->labelEx($model,'role_date'); ?>
		<div class="desc">
			<?php
			echo $form->textField($model,'role_date',array('maxlength'=>7, 'class'=>'span-4'));
			/* $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'attribute' => 'role_date',
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'slideDown',
					'dateFormat'	=> 'dd-mm-yy'
				),
				'htmlOptions'=>array(),
				)); */
			?>
			&nbsp;&nbsp;<?php echo $form->checkBox($model,'still_work');?> Masih bekerja
			<?php echo $form->error($model,'role_date'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div id="current">
		<?php echo $form->labelEx($model,'exit_date'); ?>
		<div class="desc">
			<?php
			echo $form->textField($model,'exit_date',array('maxlength'=>7, 'class'=>'span-4'));
			/* $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'attribute' => 'exit_date',
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'slideDown',
					'dateFormat'	=> 'dd-mm-yy'
				),
				'htmlOptions'=>array(),
				)); */
			?>
			<?php echo $form->error($model,'exit_date'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'company_name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'company_name',array('maxlength'=>32, 'class'=>'span-7')); ?>
			<?php echo $form->error($model,'company_name'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'industry'); ?>
		<div class="desc">
        	<?php $listData = CHtml::listData(CcnEmployerIndustry::model()->findAll(array('condition'=>'id != 1', 'order'=>'name')),'id','name');?>
			<?php echo $form->dropDownlist($model,'industry',$listData, array('prompt'=>Yii::t('form','Pilih salah satu'))); ?>
			<?php echo $form->error($model,'industry'); ?>
		</div>
		<div class="clear"></div>
	</div>

    <div>
		<?php echo $form->labelEx($model,'company_scale'); ?>
		<div class="desc">
			<?php echo $form->dropDownlist($model,'company_scale',array(
				'1'	=> 'Lokal',
				'2'	=> 'Nasional',
				'3'	=> 'Multinasional',
			),array('tabindex'=>2)); ?>
			<?php echo $form->error($model,'company_scale'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'position'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'position',array('maxlength'=>32, 'class'=>'span-5')); ?>
			<?php echo $form->error($model,'position'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'function'); ?>
		<div class="desc">
        	<?php $listData = CHtml::listData(CcnFunctionVacancy::model()->findAll(array('order'=>'name')),'id','name');?>
			<?php echo $form->dropDownlist($model,'function',$listData, array('prompt'=>Yii::t('form','Pilih salah satu'))); ?>
			<?php echo $form->error($model,'function'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'job_desc'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'job_desc',array('rows'=>6, 'cols'=>50, 'class'=>'span-9 small')); ?>
			<?php echo $form->error($model,'job_desc'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'job_type'); ?>
		<div class="desc">
			<?php echo $form->dropDownlist($model,'job_type',array(
				'1'	=> 'Full Time',
				'2'	=> 'Part Time',
			),array('tabindex'=>2)); ?>
			<?php echo $form->error($model,'job_type'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'title'); ?>
		<div class="desc">
			<?php echo $form->dropDownlist($model,'title',array(
				'1'	=> 'Direktur',
				'2'	=> 'Manager',
				'3'	=> 'Supervisor',
				'4'	=> 'Staff',
				'5'	=> 'Entry',
			), array('prompt'=>Yii::t('form','Pilih salah satu'))); ?>
			<?php echo $form->error($model,'title'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'last_salary'); ?>
		<div class="desc">
			Rp.&nbsp;&nbsp;<?php echo $form->textField($model,'last_salary',array('maxlength'=>12, 'class'=>'span-4')).'&nbsp;,-'; ?>
			<?php echo $form->error($model,'last_salary'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="submit">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan' ,array('onclick' => 'setEnableSave()')); ?>
            <?php if(!in_array($current ,array('experience/wizard','experience/ajaxwizard'))) {
				echo CHtml::button($model->isNewRecord ? Yii::t('','Batal') : Yii::t('','Batal') ,array('id'=>'cancel'));
			}?>
		</div>
		<div class="clear"></div>
	</div>

</fieldset>

<?php $this->endWidget(); ?>

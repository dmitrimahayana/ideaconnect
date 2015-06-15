<?php
	/* @var $this EmployerController */
	/* @var $model PcrUsers */

	$this->pageTitle = 'Ubah Employer Akun';
	$this->breadcrumbs=array();
?>

<div class="boxed account">
	<h3 class="rockwell">Ubah Akun</h3>
	<div class="box">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'ccn-users-form',
			'enableAjaxValidation'=>false,
		)); ?>

			<fieldset>

				<?php// echo $form->errorSummary($model); ?>

				<div>
					<label><?php echo $model->getAttributeLabel('email');?><span class="required">*</span></label>
					<div class="desc">
						<?php echo $form->textField($model,'email',array('maxlength'=>32,'class'=>'span-6','readonly'=>'readonly')); ?>
						<?php echo $form->error($model,'email'); ?>
					</div>
					<div class="clear"></div>
				</div>

				<div>
					<label><?php echo $model->getAttributeLabel('oldPassword');?><span class="required">*</span></label>
					<div class="desc">
						<?php echo $form->passwordField($model,'oldPassword',array('maxlength'=>32,'class'=>'span-5', 'value'=>'')); ?>
						<?php echo $form->error($model,'oldPassword'); ?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<label><?php echo $model->getAttributeLabel('newPassword');?><span class="required">*</span></label>
					<div class="desc">
						<?php echo $form->passwordField($model,'newPassword',array('maxlength'=>32,'class'=>'span-5')); ?>
						<?php echo $form->error($model,'newPassword'); ?>
						<div class="small-px silent">Minimal 6 karakter, gunakan kombinasi huruf dan angka. Misal: abc123</div>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<label><?php echo $model->getAttributeLabel('retypePassword');?><span class="required">*</span></label>
					<div class="desc">
						<?php echo $form->passwordField($model,'retypePassword',array('maxlength'=>32,'class'=>'span-5')); ?>
						<?php echo $form->error($model,'retypePassword'); ?>
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

			</fieldset>

		<?php $this->endWidget(); ?>
	</div>
</div>
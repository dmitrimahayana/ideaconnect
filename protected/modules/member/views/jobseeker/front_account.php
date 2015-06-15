<?php
	/* @var $this JobseekerController */
	/* @var $model CcnUpdateUserAccount */

	$this->pageTitle = 'Ubah Jobseeker Akun';
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
				
				<div>
					<?php // echo $form->labelEx($model,'email'); ?>
					<label class="required" for="CcnUsers_password">
						Email
						<span class="required">*</span>
					</label>
					<div class="desc">
						<?php echo $form->textField($model,'email',array('maxlength'=>100,'class'=>'span-6','readonly'=>'readonly')); ?>
						<?php echo $form->error($model,'email'); ?>
						<?php /*<div class="small-px silent">Contoh: user@domain.com</div>*/?>
					</div>
					<div class="clear"></div>
				</div>

				<div>
					<?php// echo $form->labelEx($user,'password'); ?>
					<label class="required" for="CcnUsers_password">
						Masukkan password lama
						<span class="required">*</span>
					</label>
					<div class="desc">
						<?php echo $form->passwordField($model,'oldPassword',array('maxlength'=>100,'class'=>'span-5')); ?>
						<?php echo $form->error($model,'oldPassword'); ?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<label class="required" for="CcnUsers_password">
						Masukkan password baru
						<span class="required">*</span>
					</label>
					<div class="desc">
						<?php echo $form->passwordField($model,'newPassword',array('maxlength'=>100,'class'=>'span-5')); ?>
						<?php echo $form->error($model,'newPassword'); ?>
						<div class="small-px silent">Minimal 6 karakter, gunakan kombinasi huruf dan angka. Misal: abc123</div>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<label class="required" for="CcnUsers_password">
						Masukkan password baru sekali lagi
						<span class="required">*</span>
					</label>
					<div class="desc">
						<?php echo $form->passwordField($model,'retypePassword',array('class'=>'span-5')); ?>
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
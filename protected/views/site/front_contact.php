<?php
	$this->pageTitle = "Kontak";
	/* Register Script */
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/module/article/article_static.css');
?>

<div class="contact-us">
	<div class="boxed">
		<h3 class="rockwell">Kami <span>Membantu</span></h3>
		<?php if(Yii::app()->user->hasFlash('success')) { ?>
			<div class="errorSummary success"><p>
			<?php echo Yii::app()->user->getFlash('success'); ?>
			</p></div>
		<?php } ?>
		<div class="box">
			<div class="office left">
				<?php $this->widget('PublicContactDetail'); ?>
			</div>
			<div class="form left">
				<h5 class="bell-gothic">Pertanyaan atau Saran</h5>
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'contact-form',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
				)); ?>
					<fieldset>
						<div>
							<label>Nama<span class="required">*</span></label>
							<div class="desc">
								<?php echo $form->textField($model,'name', array('class'=>'span-14')); ?>
								<?php echo $form->error($model,'name'); ?>
							</div>
							<div class="clear"></div>
						</div>
						<div>
							<label>Email<span class="required">*</span></label>
							<div class="desc">
								<?php echo $form->textField($model,'email', array('class'=>'span-14')); ?>
								<?php echo $form->error($model,'email'); ?>
							</div>
							<div class="clear"></div>
						</div>

						<div>
							<label>Subjek</label>
							<div class="desc">
								<?php echo $form->textField($model,'subject', array('class'=>'span-14')); ?>
								<?php echo $form->error($model,'subject'); ?>
							</div>
							<div class="clear"></div>
						</div>
						<div>
							<label>Pesan<span class="required">*</span></label>
							<div class="desc">
								<?php echo $form->textArea($model,'body', array('class'=>'span-14 small')); ?>
								<?php echo $form->error($model,'body'); ?>
							</div>
							<div class="clear"></div>
						</div>
						<?php if(extension_loaded('gd')): ?>
						<div class="code">
							<label>Kode Verifikasi<span class="required">*</span></label>
							<div class="desc">
								<?php $this->widget('CCaptcha'); ?>
								<div class="clear"></div>
								<?php echo $form->textField($model,'verifyCode', array('class'=>'span-9 mt-5')); ?>
								<?php echo $form->error($model,'verifyCode'); ?>
							</div>
							<div class="clear"></div>
						</div>
						<?php endif; ?>
						<div class="submit">
							<input type="submit" value="Kirim">
						</div>
					</fieldset>
				<?php $this->endWidget(); ?>

			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>

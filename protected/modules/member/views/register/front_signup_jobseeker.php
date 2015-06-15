<?php
	/* @var $this JobseekerController */
	/* @var $model PcrUsers */
	$this->pageTitle = 'Registrasi Jobseeker';
	$cs = Yii::app()->getClientScript();

$js = <<<EOP
	$('select#CcnUsers_member_type').change(function(){
		var id = $(this).val();
		if(id == 4) {
			$('div#pcr-alumni').slideDown();
		} else {
			$('div#pcr-alumni').slideUp();
		}
	}).change();
EOP;
	$cs->registerScript('jobseeker', $js, CClientScript::POS_END);
?>

<div class="box" style="margin:0 380px 0 0">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'swt-users-form',
		'enableAjaxValidation'=>true,
	)); ?>

	<fieldset>
		
		<h5 class="bell-gothic">Buat akun baru Jobseeker di CC PCR</h5>

		<div class="hint">
			<?php echo $form->labelEx($model,'email'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'email',array('maxlength'=>100,'class'=>'span-8')); ?>
				<span class="hint"><span><?php echo Yii::t('', 'Contoh: andi@domainemail.com') ?> </span><em>*</em></span>
				<?php echo $form->hiddenField($model,'users_group_id',array('size'=>60,'maxlength'=>100,'value'=>$_GET['gid'])); ?>
				<?php echo $form->error($model,'email'); ?>
				<?php /*<div class="small-px silent"></div>*/?>					
			</div>
			<div class="clear"></div>
		</div>
		
		<div>
			<?php echo $form->label($model, 'member_type'); ?>
			<div class="desc">
				<?php
				//$model->users_group_id = $_GET['gid'];
				echo $form->dropDownList($model, 'member_type', array(
					'0' => 'Pilih jenis keanggotaan',
					'4' => 'Alumni PCR',
					'5' => 'Bukan Alumni PCR'
					),array('options'=>array($model->member_type=>array('selected'=>true))));?>
				<?php echo $form->error($model,'member_type'); ?>
			</div>
			<div class="clear"></div>
		</div>
		
		<div id="pcr-alumni">
			<div class="hint">
				<?php echo $form->label($model, 'nim'); ?>
				<div class="desc">
					<?php echo $form->textField($model, 'nim',array('class'=>'span-5')); ?>
					<span class="hint"><span><?php echo Yii::t('', 'No Induk Mahasiswa saat dulu aktif di almamater PCR') ?></span><em>*</em></span>
					<?php echo $form->error($model,'nim'); ?>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="hint">
				<?php echo $form->label($model, 'first_name'); ?>
				<div class="desc">
					<?php echo $form->textField($model, 'first_name',array('class'=>'span-6')); ?>
					<span class="hint"><span><?php echo Yii::t('', 'Nama depan mahasiswa alumni PCR') ?></span><em>*</em></span>
					<?php echo $form->error($model,'first_name'); ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>			
		
		<div class="hint">
			<?php echo $form->labelEx($model,'password'); ?>
			<div class="desc">
				<?php echo $form->passwordField($model,'password',array('maxlength'=>100,'class'=>'span-6')); ?>
				<span class="hint"><span><?php echo Yii::t('', 'Minimal 6 karakter, gunakan kombinasi huruf dan angka. Contoh: abc123') ?></span><em>*</em></span>
				<?php echo $form->error($model,'password'); ?>
				<?php //<div class="small-px silent"></div>?>					
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="hint">
			<?php echo $form->labelEx($model,'retypePassword'); ?>
			<div class="desc">
				<?php echo $form->passwordField($model,'retypePassword',array('maxlength'=>100,'class'=>'span-6')); ?>
				<span class="hint"><span><?php echo Yii::t('', 'Ketik ulang password') ?></span><em>*</em></span>
				<?php echo $form->error($model,'retypePassword'); ?>
				<?php //<div class="small-px silent"></div>?>					
			</div>
			<div class="clear"></div>
		</div>

		<div class="hint">
			<?php echo $form->labelEx($model,'mobile_no'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'mobile_no',array('maxlength'=>15,'class'=>'span-7')); ?>
				<span class="hint"><span><?php echo Yii::t('', 'No. HP aktif Anda untuk menerima info dari Career Center PCR') ?></span><em>*</em></span>
				<?php echo $form->error($model,'mobile_no'); ?>
				<?php //<div class="small-px silent"></div>?>					
			</div>
			<div class="clear"></div>
		</div>

		<div class="submit">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Daftar' : 'Save',array('id'=>'rockwell'));?>
		</div>
	</fieldset>	
	<?php $this->endWidget(); ?>
</div>

<?php //begin.Facility ?>
<div class="facility">
	<div class="sep">
		<img src="<?php echo Yii::app()->request->baseUrl;?>/images/resource/facility/enote.png" />
		<h5 class="bell-gothic">Enote</h5>
		<p class="large-px">Anda akan menerima info lowongan terbaru di inbox Anda, sesuai dengan kebutuhan Anda. Termasuk info panggilan tes (lowongan tertentu) atau info menarik lainnya.</p>
	</div>
	<div class="sep">
		<img src="<?php echo Yii::app()->request->baseUrl;?>/images/resource/facility/appon.png" />
		<h5 class="bell-gothic">App On</h5>
		<p class="large-px">Mengakses lowongan-lowongan terbaik sekarang sangat mudah. Kapan saja. Di mana saja. Ingin melamar, tinggal satu kali klik!</p>
	</div>
	<div class="sep">
		<img src="<?php echo Yii::app()->request->baseUrl;?>/images/resource/facility/lifetime.png" />
		<h5 class="bell-gothic">Lifetime Membership</h5>
		<p class="large-px">Dapatkan keanggotaan selamanya! Tanpa batas waktu. Anda bisa terus mengupdate CV Anda terbaru dan terus mengembangkan karir Anda.</p>
	</div>
</div>
<?php //end.Facility ?>

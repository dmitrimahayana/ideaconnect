<?php
	/* @var $this JobseekerController */
	/* @var $model PcrUsers */
	$this->pageTitle = 'Registrasi Employer';
?>

<?php //begin.Form Input ?>
<div class="box" style="margin:0 380px 0 0">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'swt-users-form',
		'enableAjaxValidation'=>true,
	)); ?>

	<fieldset>
		
		<h5 class="bell-gothic">Isi Data Perusahaan Anda</h5>

		<?php// echo $form->errorSummary($model); ?>

		<div class="hint">
			<?php echo $form->labelEx($model,'email'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'email',array('maxlength'=>100,'class'=>'span-8')); ?>
				<span class="hint"><span>Contoh: namauser@domain.com</span><em>*</em></span>
				<?php echo $form->hiddenField($model,'users_group_id',array('size'=>60,'maxlength'=>100,'value'=>$_GET['gid'])); ?>
				<?php echo $form->error($model,'email'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
			<div class="clear"></div>
		</div>
		
		<div>
			<?php echo $form->labelEx($model,'name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'name',array('maxlength'=>100,'class'=>'span-6')); ?>
				<?php echo $form->error($model,'name'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
			<div class="clear"></div>
		</div>			
		
		<div class="hint">
			<?php echo $form->labelEx($model,'password'); ?>
			<div class="desc">
				<?php echo $form->passwordField($model,'password',array('maxlength'=>100,'class'=>'span-6')); ?>
				<span class="hint"><span>Minimal 6 karakter, gunakan kombinasi huruf dan angka. Contoh: abc123</span><em>*</em></span>
				<?php echo $form->error($model,'password'); ?>
				<?php //<div class="small-px silent"></div>?>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="hint">
			<?php echo $form->labelEx($model,'retypePassword'); ?>
			<div class="desc">
				<?php echo $form->passwordField($model,'retypePassword',array('maxlength'=>100,'class'=>'span-6')); ?>
				<span class="hint"><span>Ketik ulang password</span><em>*</em></span>
				<?php echo $form->error($model,'retypePassword'); ?>
				<?php //<div class="small-px silent"></div>?>
			</div>
			<div class="clear"></div>
		</div>

		<div class="hint">
			<?php echo $form->labelEx($model,'mobile_no'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'mobile_no',array('maxlength'=>15,'class'=>'span-7')); ?>
				<span class="hint"><span>No. HP digunakan untuk menerima info dari Career Center</span><em>*</em></span>
				<?php echo $form->error($model,'mobile_no'); ?>
				<?php //<div class="small-px silent"></div>?>
			</div>
			<div class="clear"></div>
		</div>

		<div class="submit">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Langkah Selanjutnya' : 'Save' ,array('id'=>'rockwell')); ?>
		</div>
	</fieldset>	
	<?php $this->endWidget(); ?>
</div>
<?php //end.Form Input ?>

<?php //begin.Facility ?>
<div class="facility">
	<div class="sep">
		<img src="<?php echo Yii::app()->request->baseUrl;?>/images/resource/facility/pantau-pelamar.png" />
		<h5 class="bell-gothic">Pantau Pelamar</h5>
		Anda akan dengan mudah memantau pelamar dari lowongan yang Anda publish. Termasuk notifikasi via email untuk laporan mingguan dari lowongan Anda.
	</div>
	
	<div class="sep">
		<img src="<?php echo Yii::app()->request->baseUrl;?>/images/resource/facility/download-lowongan.png" />
		<h5 class="bell-gothic">Download Lowongan</h5>
		Merekap data pelamar menjadi begitu mudah. Tinggal download dalam format Excell atau versi PDF untuk tiap CV individual agar Anda bisa olah untuk tahap selanjutnya.</div>

	<div class="sep">
		<img src="<?php echo Yii::app()->request->baseUrl;?>/images/resource/facility/publish-lowongan.png" />
		<h5 class="bell-gothic">Publish Lowongan</h5>
		Posting lowongan Anda langsung dari halaman member. Setiap saat dan kapan saja Anda membutuhkan talenta terbaik tinggal mengisi form yang telah kami sediakan secara online. Mudah dan cepat.
	</div>
</div>
<?php //end.Facility ?>

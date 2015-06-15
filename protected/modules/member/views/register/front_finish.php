<?php
	/* @var $this JobseekerController */
	/* @var $model PcrUsers */
	$this->pageTitle = '';
?>

<div class="boxed">
	<div class="icons finish"></div>
	<div class="tagline">
		<img src="<?php echo Yii::app()->request->baseUrl;?>/images/resource/finish_bg.png" title="" />
	</div>
	<div class="text">
		<strong>Anda telah mengisi data penting tentang diri Anda.</strong><br/>
		Selanjutnya Anda bisa masuk dan memanfaatkan sepenuhnya fitur dari kami.<br/>
		Anda bisa melengkapi lagi CV Anda dengan data-data yang lain.<br/>
		Atau Anda bisa langsung melamar. Anda sudah siap.<br/>
		<a href="<?php echo Yii::app()->controller->createUrl('jobseeker/index');?>" title="Masuk!">Masuk!</a>
	</div>
</div>
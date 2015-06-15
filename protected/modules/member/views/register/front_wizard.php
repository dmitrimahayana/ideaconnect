<?php
	/* @var $this JobseekerController */
	/* @var $model PcrUsers */
	$this->pageTitle = 'Welcome Member';
?>

<div class="boxed">
	<div class="icons"></div>
	<div class="tagline">
		<img src="<?php echo Yii::app()->request->baseUrl;?>/images/resource/welcome_bg.png" title="" />
	</div>
	<div class="text">
		<strong>Terima kasih telah mendaftar.</strong><br/>
		Tinggal selangkah lagi sebelum Anda mulai memulai aktifitas Anda di sini.<br/>
		Silahkan isi dahulu beberapa data penting <br/>
		mengenai Anda berikut ini.<br/>
		<a href="<?php echo Yii::app()->controller->createUrl('biodata/wizard');?>" title="Go!">Go!</a>
	</div>
</div>
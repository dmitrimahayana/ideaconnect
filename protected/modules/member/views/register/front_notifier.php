<?php
	/* @var $this JobseekerController */
	/* @var $model PcrUsers */
	$this->pageTitle = ($_GET['gid'] == 6) ? 'Selamat Datang Employer' : 'Selamat Datang Jobseeker';
?>

<div class="front-success">
	<strong><?php echo Yii::t('', 'Terima kasih telah mendaftar.')?></strong><br/>
	<?php if(isset($_GET['type'])) {
		if($_GET['type'] == 'activation') {
			$desc = 'Anda belum melakukan validasi email, silahkan melakukan validasi email terlebih<br/>dahulu untuk dapat menggunakan fitur-fitur Career Canter PCR.';
		} else if($_GET['type'] == 'confirm') {
			$desc = 'Anda belum melakukan konfirmasi pembayaran, silahkan melakukan konfirmasi terlebih<br/>dahulu untuk dapat menggunakan fitur-fitur Career Canter PCR.';
		} else if($_GET['type'] == 'approved') {
			$desc = 'Kanggotaaan and belum di aktifkan oleh pihak administrasi, silahka menunggu paling lambat 1x 24 jam.';
		} else if($_GET['type'] == 'blocked') {
			$desc = 'Kanggotaaan telah di non aktifkan, silahkan hubungi admin CC PCR.';
		}
	}
	?>
	<?php echo Yii::t('', $desc)?>
</div>
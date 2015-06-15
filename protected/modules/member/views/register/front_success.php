<?php
	/* @var $this JobseekerController */
	/* @var $model PcrUsers */
	$this->pageTitle = ($_GET['gid'] == 5) ? 'Registrasi Jobseeker' : 'Registrasi Employer';
	$lastDigitPhone = substr($model->mobile_no, -3);
	$pay_model = CcnPayment::model()->find(array(
		'select'=>'total_payment',
		'condition' => 'user_group_id = '.$_GET['gid'].''
	));
	$pay = substr($pay_model->total_payment,0,-3);
?>

<div class="front-success">
	<strong><?php echo Yii::t('', 'Terima kasih telah mendaftar.')?></strong><br/>
	<?php if($_GET['gid'] == 5) {?>

	<?php /*<?php echo Yii::t('', 'Cek email Anda dan buka email dari kami.<br/>Klik link aktivasi yang terdapat dalam email dan lakukan pembayaran<br/>sejumlah Rp '.$pay.'.'.$lastDigitPhone.',- untuk menyelesaikan proses pendaftaran.<br/>')?>*/ ?>
       	<?php echo Yii::t('', 'Cek email Anda dan buka email dari kami.<br/>Klik link aktivasi yang terdapat dalam email, setelah itu Anda dapat login ke halaman Jobseeker Career Center PCR dan memanfaatkan fitur-fitur dari kami.<br/>')?>

	<?php } else {?>

	<?php echo Yii::t('', 'Pihak Career Center PCR akan memvalidasi keanggotaan Anda.<br/>Segera setelah keanggotaan Anda disetujui, maka sebuah email akan dikirimkan ke alamat email Anda.<br />Anda dapat login ke halaman employer Career Center PCR dan memanfaatkan fitur-fitur dari kami.')?>

	<?php }?>
</div>
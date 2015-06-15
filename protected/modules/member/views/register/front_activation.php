<?php
	/* @var $this JobseekerController */
	/* @var $model PcrUsers */

	$this->pageTitle = 'Aktivasi Jobseeker';
?>

<div class="front-success">
	<strong>Terima kasih telah melakukan aktivasi.</strong><br/>

	<?php echo $data; ?><br/><br/>

	<?php /* if($model->users_group_id != 6 && ($status == 'actived' || $status == 'actived_before')) {
		echo CHtml::button('Konfirmasi', array('onclick' => "document.location.href='".Yii::app()->createUrl('finance/confirm')."'"));
	}*/ ?>
</div>
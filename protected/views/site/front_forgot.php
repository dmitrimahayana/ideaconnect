<?php
	/* @var $this SiteController */
	/* @var $model LoginForm */
	/* @var $form CActiveForm  */

	$this->pageTitle= 'Lupa Password';
	$this->breadcrumbs=array();
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/main/main_login.css');
?>

<div class="boxed" id="forgot">
	<h3>Lupa Password</h3>
	<div class="box">
		<?php if(isset($_GET['email'])) {?>
			Password baru telah dikirimkan ke email <strong><?php echo $_GET['email'];?></strong>. Silahkan buka dan cek email Anda.
		<?php } else {?>
			Silahkan masukkan alamat email Anda. Kami akan mengirimkan password baru kepada Anda :<br/>
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'swt-users-form',
				'enableAjaxValidation'=>true,
			)); ?>
				<?php echo $form->textField($model,'email',array('maxlength'=>100,'class'=>'span-8')); ?>
				<?php echo $form->error($model,'email'); ?>
				<?php echo CHtml::submitButton('Kirim'); ?>
			<?php $this->endWidget(); ?>

			<div class="clear"></div>
		<?php }?>
	</div>
</div>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'swt-users-form',
	'enableAjaxValidation'=>true,
)); ?>
	<div class="dialog-header" id="forgot">Lupa Password</div>
	<div class="dialog-content">
		<?php if(!isset($_GET['email'])) {?>
			Silahkan masukkan alamat email Anda. Kami akan mengirimkan password baru kepada Anda : <br/><br/>
            
			<?php echo $form->textField($model,'email',array('maxlength'=>50,'class'=>'span-7')); ?>		
			<?php echo $form->error($model,'email'); ?>
		<?php } else {?>
			Password baru sudah dikirimkan ke email <strong><?php echo $_GET['email'];?></strong>. Silahkan buka dan cek email anda
		<?php }?>
        
	</div>
	<div class="dialog-submit">
		<?php if(!isset($_GET['email'])) {?>
			<?php echo CHtml::submitButton('Kirim'); ?>
			<?php echo CHtml::Button('Keluar', array('id'=>'closed')); ?>
		<?php } else {?>
			<?php echo CHtml::Button('Keluar', array('id'=>'closed')); ?>
		<?php }?>
		<?php echo $button;?>
	</div>
<?php $this->endWidget(); ?>

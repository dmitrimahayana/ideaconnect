<?php
/* @var $this JobseekerController */
/* @var $model PcrUsers */
/* @var $form CActiveForm */
$action = strtolower(Yii::app()->controller->action->id);

?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccn-users-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>
<div class="dialog-header">
	<?php echo CHtml::encode($this->pageTitle); ?>
</div>
<div class="dialog-content">

	<fieldset>
		
        <?php
			$model->users_group_id = $_GET['gid'];
			echo $form->hiddenField($model,'users_group_id');
		?>
        
		<div class="clearfix">
			<?php echo $form->labelEx($model,'email'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'email',array('maxlength'=>100,'class'=>'span-7')); ?>
				<?php echo $form->error($model,'email'); ?>
				<?php /*<div class="small-px silent">Contoh: user@domain.com</div>*/?>
			</div>
		</div>


		<div class="clearfix">
			<?php echo $form->labelEx($model,'password'); ?>
			<div class="desc">
				<?php echo $form->passwordField($model,'password',array('maxlength'=>100,'class'=>'span-6','value'=>'')); ?>
				<?php echo $form->error($model,'password'); ?>
				<div class="small-px silent">Minimal 6 karakter, gunakan kombinasi huruf dan angka. Misal: abc123</div> 
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'retypePassword'); ?>
			<div class="desc">
				<?php echo $form->passwordField($model,'retypePassword',array('maxlength'=>100,'class'=>'span-6','value'=>'')); ?>
				<?php echo $form->error($model,'retypePassword'); ?>
				<div class="small-px silent">Sama dengan kata sandi sebelumnya</div>
			</div>
		</div>
		
		<?php if ($_GET['gid'] == 4) { ?>
		<div class="clearfix">
			<?php echo $form->labelEx($model,'nim'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'nim', array('class'=>'span-6')); ?>
				<?php echo $form->error($model,'nim'); ?>
				<div class="small-px silent">NIM Alumni PCR</div>
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'first_name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'first_name', array('class'=>'span-6')); ?>
				<?php echo $form->error($model,'first_name'); ?>
				<div class="small-px silent">Nama depan alumni PCR</div>
			</div>
		</div>
		
		<?php }
		if (($_GET['gid'] == 4) || ($_GET['gid'] == 5)) { ?>
		<div class="clearfix">
			<?php echo $form->labelEx($model,'mobile_no'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'mobile_no',array('maxlength'=>15,'class'=>'span-6')); ?>
				<?php echo $form->error($model,'mobile_no'); ?>
				<div class="small-px silent">Pastikan nomor yang bisa dihubungi</div>
			</div>
		</div>
		<?php }?>
		
       	<?php /* if ($_GET['gid'] == 0) {?>  
        <div class="clearfix">
			<?php echo $form->labelEx($model,'photo');?>
            <div class="desc">
                <?php if($action == 'adminedit') {?>
                    <img src="<?php echo Yii::app()->request->baseUrl?>/images/member_upload/admin/<?php echo $model->photo?>"><br/>
                <?php } ?>
                <?php echo $form->fileField($model,'photo'); ?>
                <?php echo $form->error($model,'photo'); ?>
                 
            </div>
		</div>
        
        <div class="clearfix">
			<?php echo $form->labelEx($model,'actived'); ?>
			<div class="desc">
				<?php echo $form->checkbox($model,'actived'); ?>
				<?php echo $form->error($model,'actived'); ?>
				<?php //<div class="small-px silent">asds</div> ?>
			</div>
		</div>
        <?php }  */?>

		<!-- <div class="submit">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah' : 'Selesai'); ?>
			<?php echo $this->action->id == 'adminedit' ? CHtml::submitButton('Data Selanjutnya') : ''; ?>
		</div> -->

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('','Tambah') : Yii::t('','Simpan'), array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('','Keluar'), array('id'=>'closed')); ?>
</div>

<?php $this->endWidget(); ?>

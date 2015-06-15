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
		<?php if($model->id != 2) { ?>				
			<div class="clearfix">
				<?php echo $form->labelEx($model,'users_group_id'); ?>
				<div class="desc">
					<?php $listData = CHtml::listData(UsersGroup::model()->findAll(array('select'=>'id,name','condition'=>'group_login = "back_office"')),'id','name'); ?>
					<?php echo $form->dropDownList($model,'users_group_id', $listData); ?>
					<?php echo $form->error($model,'users_group_id'); ?>
				</div>
			</div>
        <?php } ?>
		
		<?php 
		if(!isset($_GET['type']) || (isset($_GET['type']) && $_GET['type'] == 'account')) { ?>
        <div class="clearfix">
			<?php echo $form->labelEx($model,'name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'name',array('maxlength'=>250,'class'=>'span-6')); ?>
				<?php echo $form->error($model,'name'); ?>
			</div>
		</div>
        
        
		<div class="clearfix">
			<?php echo $form->labelEx($model,'email'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'email',array('maxlength'=>100,'class'=>'span-7')); ?>
				<?php echo $form->error($model,'email'); ?>
			</div>
		</div>
        
        
        <div class="clearfix">
			<?php echo $form->labelEx($model,'username'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'username',array('maxlength'=>150,'class'=>'span-6')); ?>
				<?php echo $form->error($model,'username'); ?>
			</div>
		</div>
        
		<div class="clearfix">
			<?php echo $form->labelEx($model,'mobile_no'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'mobile_no',array('maxlength'=>15,'class'=>'span-6')); ?>
				<?php echo $form->error($model,'mobile_no'); ?>
				<div class="small-px silent">Pastikan nomor yang bisa dihubungi</div>
			</div>
		</div>
		<?php }?>

		<?php if(!isset($_GET['type']) || (isset($_GET['type']) && $_GET['type'] == 'password')) {
		?>
		<div class="clearfix">
			<?php echo $form->labelEx($model,'old_password'); ?>
			<div class="desc">
				<?php echo $form->passwordField($model,'old_password',array('maxlength'=>100,'class'=>'span-6')); ?>
				<?php echo $form->error($model,'old_password'); ?>
				<div class="small-px silent">Minimal 6 karakter, gunakan kombinasi huruf dan angka. Misal: abc123</div> 
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'new_password'); ?>
			<div class="desc">
				<?php echo $form->passwordField($model,'new_password',array('maxlength'=>100,'class'=>'span-6')); ?>
				<?php echo $form->error($model,'new_password'); ?>
				<div class="small-px silent">Minimal 6 karakter, gunakan kombinasi huruf dan angka. Misal: abc123</div> 
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'retype_new_password'); ?>
			<div class="desc">
				<?php echo $form->passwordField($model,'retype_new_password',array('maxlength'=>100,'class'=>'span-6')); ?>
				<?php echo $form->error($model,'retype_new_password'); ?>
				<div class="small-px silent">Sama dengan kata sandi sebelumnya</div>
			</div>
		</div>
		<?php }?>
		
        <?php if($model->id != 2) { ?>	
			<div class="clearfix">
				<?php echo $form->labelEx($model,'actived'); ?>
				<div class="desc">
					<?php echo $form->checkbox($model,'actived'); ?>
					<?php echo $form->error($model,'actived'); ?>
					<?php //<div class="small-px silent">asds</div> ?>
				</div>
			</div>        
		 <?php } ?>
	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('','Tambah') : Yii::t('','Simpan'), array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('','Keluar'), array('id'=>'closed')); ?>
</div>

<?php $this->endWidget(); ?>

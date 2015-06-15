<?php 
$action = strtolower(Yii::app()->controller->action->id);
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

<fieldset>
	<?php
	$arrPar = UsersGroup::model()->getParams(2, '#INPUT-FIELD#', '#END-INPUT-FORM#');
	$admSwt = Yii::app()->user->id; // admin sweeto
	?>
	<?php if($admSwt == 1 || $arrPar['users_group_id'] == 1) {?>
	<div>
		<?php echo $form->labelEx($model,'users_group_id'); ?>
		<div class="desc">
			<?php $listData = CHtml::listData(UsersGroup::model()->findAll(array('condition'=>'id <> 1')), 'id', 'name'); ?>
			<?php echo $form->dropDownList($model,'users_group_id', $listData); ?>
		</div>
		<div class="clear"></div>
	</div>
	<?php }else {
		$model->users_group_id = $arrPar['users_group_id'];
		echo $form->hiddenField($model,'users_group_id');
	}?>
	
	<div>
		<?php echo $form->labelEx($model,'name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'name',array('maxlength'=>255)); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'username'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'username',array('maxlength'=>150)); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'currentPassword'); ?>
		<div class="desc">
			<?php echo $form->passwordField($model,'currentPassword',array('maxlength'=>100)); ?>
			<?php echo $form->error($model,'currentPassword'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'retypePassword'); ?>
		<div class="desc">
			<?php echo $form->passwordField($model,'retypePassword',array('maxlength'=>100)); ?>
			<?php echo $form->error($model,'retypePassword'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'email'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'email',array('maxlength'=>100)); ?>
			<?php echo $form->error($model,'email'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<?php if($admSwt == 1 || $arrPar['photo'] == 1) {?>
	<div>
		<?php echo $form->labelEx($model,'photo'); ?>
		<div class="desc">
			<?php echo $form->fileField($model,'photo',array('maxlength'=>80)); ?>
			<?php echo $form->error($model,'photo'); ?>
		</div>
		<div class="clear"></div>
	</div>
	<?php }?>
	
	<?php if($admSwt == 1 || $arrPar['mobile_no'] == 1) {?>
	<div>
		<?php echo $form->labelEx($model,'mobile_no'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'mobile_no',array('maxlength'=>15)); ?>
			<?php echo $form->error($model,'mobile_no'); ?>
		</div>
		<div class="clear"></div>
	</div>
	<?php }?>
	
	<?php if(Yii::app()->user->id == 1) {?>
	<div>
		<?php echo $form->labelEx($model,'params'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'params'); ?>
		</div>
		<div class="clear"></div>
	</div>
	<?php }?>
	
	<?php 
	if($action != 'adminadd') {
		if($admSwt == 1 || $arrPar['block'] == 1) {?>
		<div>
			<?php echo $form->labelEx($model,'block'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'block'); ?>
				<?php echo $form->error($model,'block'); ?>
			</div>
			<div class="clear"></div>
		</div>
	<?php }
	}?>

	<div>
		<?php echo $form->labelEx($model,'actived'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'actived'); ?>
			<?php echo $form->error($model,'actived'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="submit">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>
		<div class="clear"></div>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

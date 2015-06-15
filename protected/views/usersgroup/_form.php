<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-group-form',
	'enableAjaxValidation'=>true,
)); ?>
<div class="dialog-header">
	<?php echo CHtml::encode($this->pageTitle); ?>
</div>
<div class="dialog-content">

	<fieldset>
		<div>
			<?php echo $form->labelEx($model,'group_login'); ?>
			<div class="desc">
				<?php if(Yii::app()->user->id == 1) { 
					$listGroup = array('admin_sweeto'=>'admin_sweeto', 'back_office'=>'back_office'
						,'member'=>'member','back_office_n_member'=>'back_office_n_member'
					);
				} else {
					$listGroup = array('back_office'=>'back_office','member'=>'member');
				}
				?>
				<?php echo $form->dropDownList($model,'group_login', $listGroup); ?>
				<?php echo $form->error($model,'group_login'); ?>
			</div>
			<div class="clear"></div>
		</div>
		
		<div>
			<?php echo $form->labelEx($model,'name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($model,'name'); ?>
			</div>
			<div class="clear"></div>
		</div>
		
		<div>
			<?php echo $form->labelEx($model,'group_name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'group_name',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($model,'group_name'); ?>
			</div>
			<div class="clear"></div>
		</div>
		
		
		<?php if(Yii::app()->user->id == 1) { ?>
		<div>
			<?php echo $form->labelEx($model,'params'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'params'); ?>
			</div>
			<div class="clear"></div>
		</div>
		<?php }?>
	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	<?php echo CHtml::button('Closed', array('id'=>'closed')); ?>
</div>

<?php $this->endWidget(); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sub-menu-admin-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>

<fieldset>

	<div>
		<?php echo $form->labelEx($model,'group_type'); ?>
		<div class="desc">
			<?php echo $form->radioButtonList($model,'group_type',array('back_office'=>'back_office', 'admin_sweeto'=>'admin_sweeto')); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'menu'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'menu',array('size'=>50,'maxlength'=>50)); ?>
			<div class="small-px silent">example: Search</div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'position'); ?>
		<div class="desc">
			<?php echo $form->radioButtonList($model,'position',array('left'=>'left','right'=>'right')); ?>
		</div>
		<div class="clear"></div>
	</div>
    
       

	<div>
		<?php echo $form->labelEx($model,'module'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'module',array('size'=>60,'maxlength'=>100,'value'=>'-')); ?>			
		</div>
		<div class="clear"></div>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'controller'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'controller',array('size'=>60,'maxlength'=>100)); ?>
			<div class="small-px silent">example: submenuadmin</div>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'action'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'action',array('size'=>60,'maxlength'=>100)); ?>
			<div class="small-px silent">example: adminedit,adminadd,adminview or adminmanage</div>
		</div>
		<div class="clear"></div>
	</div>	
	
	<div>
		<?php echo $form->labelEx($model,'dialog'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'dialog',array('0','1')); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'class'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'class',array('size'=>50,'maxlength'=>50)); ?>
			<div class="small-px silent">Class of style, example: search-button</div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'url'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'url',array('size'=>50,'maxlength'=>50)); ?>
			<div class="small-px silent">example: submenuadmin/adminadd</div>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'attr'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'attr',array('size'=>60,'maxlength'=>200)); ?>
			<div class="small-px silent">example: id=34,category=admin or tid=$_GET*tid</div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'icon'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'icon',array('size'=>50,'maxlength'=>50)); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'enabled'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'enabled'); ?>
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

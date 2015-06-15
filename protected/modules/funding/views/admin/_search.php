<?php
/* @var $this FundingUserController */
/* @var $model FundingUser */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<ul>
		<li>
			<?php echo $model->getAttributeLabel('id'); ?><br/>
			<?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('sponsor_id'); ?><br/>
			<?php echo $form->textField($model,'sponsor_id',array('size'=>10,'maxlength'=>10)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('sponsor_name'); ?><br/>
			<?php echo $form->textField($model,'sponsor_name',array('size'=>60,'maxlength'=>80)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('requisite_id'); ?><br/>
			<?php echo $form->textField($model,'requisite_id',array('size'=>10,'maxlength'=>10)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('as_institution_id'); ?><br/>
			<?php echo $form->textField($model,'as_institution_id',array('size'=>10,'maxlength'=>10)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('as_institution_name'); ?><br/>
			<?php echo $form->textField($model,'as_institution_name',array('size'=>60,'maxlength'=>100)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('account_from_number'); ?><br/>
			<?php echo $form->textField($model,'account_from_number',array('size'=>20,'maxlength'=>20)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('bank_from_id'); ?><br/>
			<?php echo $form->textField($model,'bank_from_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('bank_from_name'); ?><br/>
			<?php echo $form->textField($model,'bank_from_name',array('size'=>60,'maxlength'=>255)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('account_to_id'); ?><br/>
			<?php echo $form->textField($model,'account_to_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('account_to_number'); ?><br/>
			<?php echo $form->textField($model,'account_to_number',array('size'=>20,'maxlength'=>20)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('value'); ?><br/>
			<?php echo $form->textField($model,'value',array('size'=>14,'maxlength'=>14)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('unit'); ?><br/>
			<?php echo $form->textField($model,'unit',array('size'=>30,'maxlength'=>30)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('is_verified'); ?><br/>
			<?php echo $form->textField($model,'is_verified'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('varificator_id'); ?><br/>
			<?php echo $form->textField($model,'varificator_id',array('size'=>10,'maxlength'=>10)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('verification_time'); ?><br/>
			<?php echo $form->textField($model,'verification_time'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('had_been_returned'); ?><br/>
			<?php echo $form->textField($model,'had_been_returned'); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>

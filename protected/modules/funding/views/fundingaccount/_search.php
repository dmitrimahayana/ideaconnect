<?php
/* @var $this FundingAccountController */
/* @var $model FundingAccount */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<ul>
		<li>
			<?php echo $model->getAttributeLabel('id'); ?><br/>
			<?php echo $form->textField($model,'id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('bank_id'); ?><br/>
			<?php echo $form->textField($model,'bank_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('account_number'); ?><br/>
			<?php echo $form->textField($model,'account_number',array('size'=>20,'maxlength'=>20)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('owner_name_alias'); ?><br/>
			<?php echo $form->textField($model,'owner_name_alias',array('size'=>60,'maxlength'=>80)); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>

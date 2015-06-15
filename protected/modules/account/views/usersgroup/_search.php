<?php
/* @var $this UsersGroupController */
/* @var $model UsersGroup */
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
			<?php echo $model->getAttributeLabel('name'); ?><br/>
			<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('params'); ?><br/>
			<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('group_name'); ?><br/>
			<?php echo $form->textField($model,'group_name',array('size'=>30,'maxlength'=>30)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('group_login'); ?><br/>
			<?php echo $form->textField($model,'group_login',array('size'=>12,'maxlength'=>12)); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>

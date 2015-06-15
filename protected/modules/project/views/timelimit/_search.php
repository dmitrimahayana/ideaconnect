<?php
/* @var $this TimeLimitController */
/* @var $model TimeLimit */
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
			<?php echo $model->getAttributeLabel('month_limit'); ?><br/>
			<?php echo $form->textField($model,'month_limit'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('is_funding_time'); ?><br/>
			<?php echo $form->textField($model,'is_funding_time'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('is_actived'); ?><br/>
			<?php echo $form->textField($model,'is_actived'); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>

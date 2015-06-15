<?php
/* @var $this ProjectChargeController */
/* @var $model ProjectCharge */
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
			<?php echo $model->getAttributeLabel('is_percentage'); ?><br/>
			<?php echo $form->textField($model,'is_percentage'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('value'); ?><br/>
			<?php echo $form->textField($model,'value',array('size'=>14,'maxlength'=>14)); ?>
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

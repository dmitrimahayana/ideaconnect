<?php
/* @var $this ZoneProvinceController */
/* @var $model ZoneProvince */
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
			<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('country_code'); ?><br/>
			<?php echo $form->textField($model,'country_code',array('size'=>2,'maxlength'=>2)); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>

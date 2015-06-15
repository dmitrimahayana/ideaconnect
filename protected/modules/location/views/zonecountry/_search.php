<?php
/* @var $this ZoneCountryController */
/* @var $model ZoneCountry */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<ul>
		<li>
			<?php echo $model->getAttributeLabel('code'); ?><br/>
			<?php echo $form->textField($model,'code',array('size'=>2,'maxlength'=>2)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('name'); ?><br/>
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('alias'); ?><br/>
			<?php echo $form->textField($model,'alias',array('size'=>15,'maxlength'=>15)); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>

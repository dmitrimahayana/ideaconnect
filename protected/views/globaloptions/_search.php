<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<ul>
	<li>
		<?php echo $model->getAttributeLabel('option_id'); ?><br />
		<?php echo $form->textField($model,'option_id'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('option_name'); ?><br />
		<?php echo $form->textField($model,'option_name',array('size'=>60,'maxlength'=>128)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('option_value'); ?><br />
		<?php echo $form->textArea($model,'option_value',array('rows'=>6, 'cols'=>50)); ?>
	</li>

	<li class="submit">
		<?php echo CHtml::submitButton('Search'); ?>
	</li>
</ul>
<div class="clear"></div>
<?php $this->endWidget(); ?>

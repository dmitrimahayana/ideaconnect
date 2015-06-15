<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<ul class="clearfix">
	<li>
		<?php echo $model->getAttributeLabel('id_message'); ?><br />
		<?php echo $form->textField($model,'id_message',array('size'=>10,'maxlength'=>10)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('id'); ?><br />
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('language'); ?><br />
		<?php echo $form->textField($model,'language',array('size'=>2,'maxlength'=>2)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('translation'); ?><br />
		<?php echo $form->textArea($model,'translation',array('rows'=>6, 'cols'=>50)); ?>
	</li>

	<li class="submit">
		<?php echo CHtml::submitButton('Search'); ?>
	</li>
</ul>
<div class="clear"></div>
<?php $this->endWidget(); ?>

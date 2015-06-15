<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<ul class="clearfix">
	<li>
		<?php echo $model->getAttributeLabel('title'); ?><br />
		<?php echo $form->textField($model, 'title'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('ordering'); ?><br />
		<?php echo $form->textField($model,'ordering'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('hook_position'); ?><br />
		<?php echo $form->textField($model,'hook_position',array('size'=>50,'maxlength'=>50)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('enabled'); ?><br />
		<?php echo $form->textField($model,'enabled'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('access'); ?><br />
		<?php echo $form->textField($model,'access'); ?>
	</li>

	<li class="submit">
		<?php echo CHtml::submitButton('Search'); ?>
	</li>
</ul>
<div class="clear"></div>
<?php $this->endWidget(); ?>

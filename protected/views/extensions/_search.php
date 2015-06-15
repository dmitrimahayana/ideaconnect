<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<ul class="clearfix">
	<li>
		<?php echo $model->getAttributeLabel('id'); ?><br />
		<?php echo $form->textField($model,'id'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('name'); ?><br />
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('element'); ?><br />
		<?php echo $form->textField($model,'element',array('size'=>60,'maxlength'=>100)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('folder'); ?><br />
		<?php echo $form->textField($model,'folder',array('size'=>60,'maxlength'=>100)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('access'); ?><br />
		<?php echo $form->textField($model,'access'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('ordering'); ?><br />
		<?php echo $form->textField($model,'ordering'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('published'); ?><br />
		<?php echo $form->textField($model,'published'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('params'); ?><br />
		<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50)); ?>
	</li>

	<li class="submit">
		<?php echo CHtml::submitButton('Search'); ?>
	</li>
</ul>
<div class="clear"></div>
<?php $this->endWidget(); ?>

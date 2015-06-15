<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<ul class="clearfix">
	
	<li>
		<?php echo $model->getAttributeLabel('menu_types_id'); ?><br />
		<?php echo $form->textField($model,'menu_types_id'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('com_modules_id'); ?><br />
		<?php echo $form->textField($model,'com_modules_id'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('menu_type'); ?><br />
		<?php echo $form->textField($model,'menu_type',array('size'=>60,'maxlength'=>75)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('name'); ?><br />
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('url'); ?><br />
		<?php echo $form->textArea($model,'url',array('rows'=>6, 'cols'=>50)); ?>
	</li>	

	<li>
		<?php echo $model->getAttributeLabel('dest_type'); ?><br />
		<?php echo $form->textField($model,'dest_type',array('size'=>50,'maxlength'=>50)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('published'); ?><br />
		<?php echo $form->textField($model,'published'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('parent'); ?><br />
		<?php echo $form->textField($model,'parent',array('size'=>11,'maxlength'=>11)); ?>
	</li>

	
	<li>
		<?php echo $model->getAttributeLabel('in_use'); ?><br />
		<?php echo $form->textField($model,'in_use'); ?>
	</li>


	<li class="submit">
		<?php echo CHtml::submitButton('Search'); ?>
	</li>
</ul>
<div class="clear"></div>
<?php $this->endWidget(); ?>

<?php
$enableOption = array(1 => 'Ya', 0 => 'Tidak');

$form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<ul class="clearfix">
	<li>
		<?php echo $model->getAttributeLabel('hook_name'); ?><br />
		<?php echo $form->textField($model,'hook_name',array('size'=>60,'maxlength'=>100)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('published'); ?><br />
		<?php echo $form->dropDownList($model, 'published', $enableOption, array(
				'prompt' => 'Pilih salah satu')); ?>
	</li>

	<li class="submit">
		<?php echo CHtml::submitButton('Search'); ?>
	</li>
</ul>
<div class="clear"></div>
<?php $this->endWidget(); ?>

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
		<?php echo $model->getAttributeLabel('group_type'); ?><br />
		<?php echo $form->textField($model,'group_type',array('size'=>12,'maxlength'=>12)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('controller'); ?><br />
		<?php echo $form->textField($model,'controller',array('size'=>60,'maxlength'=>100)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('action'); ?><br />
		<?php echo $form->textField($model,'action',array('size'=>60,'maxlength'=>100)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('enabled'); ?><br />
		<?php echo $form->textField($model,'enabled'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('menu'); ?><br />
		<?php echo $form->textField($model,'menu',array('size'=>50,'maxlength'=>50)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('attr'); ?><br />
		<?php echo $form->textField($model,'attr',array('size'=>60,'maxlength'=>200)); ?>
	</li>

	<li class="submit">
		<?php echo CHtml::submitButton('Search'); ?>
	</li>
</ul>
<div class="clear"></div>
<?php $this->endWidget(); ?>

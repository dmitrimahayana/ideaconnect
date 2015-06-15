<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<ul>
		<li>
			<?php echo $model->getAttributeLabel('id'); ?><br/>
			<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('content'); ?><br/>
			<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('parent_id'); ?><br/>
			<?php echo $form->textField($model,'parent_id',array('size'=>10,'maxlength'=>10)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('project_id'); ?><br/>
			<?php echo $form->textField($model,'project_id',array('size'=>10,'maxlength'=>10)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('commentator_name'); ?><br/>
			<?php echo $form->textField($model,'commentator_name',array('size'=>60,'maxlength'=>80)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('commentator_email'); ?><br/>
			<?php echo $form->textField($model,'commentator_email',array('size'=>50,'maxlength'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('created_time'); ?><br/>
			<?php echo $form->textField($model,'created_time'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('is_published'); ?><br/>
			<?php echo $form->textField($model,'is_published'); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>

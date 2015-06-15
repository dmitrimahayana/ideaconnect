<?php
/* @var $this JobseekersubscribeController */
/* @var $model CcnJobseekerSubscribe */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<ul class="clearfix">
		<li>
			<?php echo $model->getAttributeLabel('id'); ?><br/>
			<?php echo $form->textField($model,'id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('subscribe_vacancy'); ?><br/>
			<?php echo $form->textField($model,'subscribe_vacancy'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('subscribe_news'); ?><br/>
			<?php echo $form->textField($model,'subscribe_news'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('subscribe_vacancy_create'); ?><br/>
			<?php echo $form->textField($model,'subscribe_vacancy_create'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('subscribe_news_create'); ?><br/>
			<?php echo $form->textField($model,'subscribe_news_create'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('major'); ?><br/>
			<?php echo $form->textField($model,'major'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('industry'); ?><br/>
			<?php echo $form->textField($model,'industry',array('size'=>45,'maxlength'=>45)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('swt_users_id'); ?><br/>
			<?php echo $form->textField($model,'swt_users_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>

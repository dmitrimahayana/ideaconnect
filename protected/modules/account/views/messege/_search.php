<?php
/* @var $this MessegeController */
/* @var $model Messege */
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
			<?php echo $model->getAttributeLabel('subject'); ?><br/>
			<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('messege'); ?><br/>
			<?php echo $form->textField($model,'messege',array('size'=>60,'maxlength'=>255)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('from_user_id'); ?><br/>
			<?php echo $form->textField($model,'from_user_id',array('size'=>10,'maxlength'=>10)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('from_user_name'); ?><br/>
			<?php echo $form->textField($model,'from_user_name',array('size'=>60,'maxlength'=>80)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('to_user_id'); ?><br/>
			<?php echo $form->textField($model,'to_user_id',array('size'=>10,'maxlength'=>10)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('to_user_name'); ?><br/>
			<?php echo $form->textField($model,'to_user_name',array('size'=>60,'maxlength'=>80)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('is_read'); ?><br/>
			<?php echo $form->textField($model,'is_read'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('sent_time'); ?><br/>
			<?php echo $form->textField($model,'sent_time'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('is_deleted_by_sender'); ?><br/>
			<?php echo $form->textField($model,'is_deleted_by_sender'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('is_deleted_by_receiver'); ?><br/>
			<?php echo $form->textField($model,'is_deleted_by_receiver'); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>

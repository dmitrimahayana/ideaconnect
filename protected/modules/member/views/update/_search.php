<?php
/* @var $this JobseekerupdateController */
/* @var $model CcnJobseekerUpdate */
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
			<?php echo $model->getAttributeLabel('swt_users_id'); ?><br/>
			<?php echo $form->textField($model,'swt_users_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('modified'); ?><br/>
			<?php echo $form->textField($model,'modified'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('cv_type'); ?><br/>
			<?php echo $form->textField($model,'cv_type',array('size'=>45,'maxlength'=>45)); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>

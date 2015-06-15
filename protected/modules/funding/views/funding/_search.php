<?php
/* @var $this FundingController */
/* @var $model Funding */
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
			<?php echo $model->getAttributeLabel('requirement'); ?><br/>
			<?php echo $form->textField($model,'requirement',array('size'=>60,'maxlength'=>80)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('value'); ?><br/>
			<?php echo $form->textField($model,'value',array('size'=>14,'maxlength'=>14)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('unit'); ?><br/>
			<?php echo $form->textField($model,'unit',array('size'=>30,'maxlength'=>30)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('requisite_id'); ?><br/>
			<?php echo $form->textField($model,'requisite_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>

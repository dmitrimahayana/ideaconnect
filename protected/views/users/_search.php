<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<ul class="clearfix">
	<li>
		<?php echo $model->getAttributeLabel('id'); ?><br />
		<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('users_group_id'); ?><br />
		<?php echo $form->textField($model,'users_group_id'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('actived'); ?><br />
		<?php echo $form->textField($model,'actived'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('name'); ?><br />
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('username'); ?><br />
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>150)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('email'); ?><br />
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('block'); ?><br />
		<?php echo $form->textField($model,'block'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('register_date'); ?><br />
		<?php echo $form->textField($model,'register_date'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('last_visit_date'); ?><br />
		<?php echo $form->textField($model,'last_visit_date'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('activation'); ?><br />
		<?php echo $form->textField($model,'activation',array('size'=>60,'maxlength'=>100)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('is_online'); ?><br />
		<?php echo $form->textField($model,'is_online'); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('photo'); ?><br />
		<?php echo $form->textField($model,'photo',array('size'=>60,'maxlength'=>80)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('mobile_no'); ?><br />
		<?php echo $form->textField($model,'mobile_no',array('size'=>15,'maxlength'=>15)); ?>
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

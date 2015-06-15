<?php
/* @var $this ProjectController */
/* @var $model Project */
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
			<?php echo $model->getAttributeLabel('project_name'); ?><br/>
			<?php echo $form->textField($model,'project_name',array('size'=>60,'maxlength'=>100)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('cover_image'); ?><br/>
			<?php echo $form->textField($model,'cover_image',array('size'=>60,'maxlength'=>255)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('intro_text'); ?><br/>
			<?php echo $form->textField($model,'intro_text',array('size'=>60,'maxlength'=>255)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('geometry_location'); ?><br/>
			<?php echo $form->textField($model,'geometry_location'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('project_category_id'); ?><br/>
			<?php echo $form->textField($model,'project_category_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('project_category_inherit_id'); ?><br/>
			<?php echo $form->textField($model,'project_category_inherit_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('project_category_name'); ?><br/>
			<?php echo $form->textField($model,'project_category_name',array('size'=>60,'maxlength'=>80)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('project_category_name_inherit'); ?><br/>
			<?php echo $form->textField($model,'project_category_name_inherit',array('size'=>60,'maxlength'=>80)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('video_url'); ?><br/>
			<?php echo $form->textArea($model,'video_url',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('background'); ?><br/>
			<?php echo $form->textArea($model,'background',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('description'); ?><br/>
			<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('goal'); ?><br/>
			<?php echo $form->textArea($model,'goal',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<!--<li>
			<?php //echo $model->getAttributeLabel('charge_id'); ?><br/>
			<?php //echo $form->textField($model,'charge_id'); ?>
		</li>-->

		<li>
			<?php echo $model->getAttributeLabel('charge'); ?><br/>
			<?php echo $form->textField($model,'charge',array('size'=>14,'maxlength'=>14)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('charge_is_percentage'); ?><br/>
			<?php echo $form->textField($model,'charge_is_percentage'); ?>
		</li>

		<!--<li>
			<?php //echo $model->getAttributeLabel('project_time_id'); ?><br/>
			<?php //echo $form->textField($model,'project_time_id'); ?>
		</li>-->

		<li>
			<?php echo $model->getAttributeLabel('project_time'); ?><br/>
			<?php echo $form->textField($model,'project_time'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('created_time'); ?><br/>
			<?php echo $form->textField($model,'created_time'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('editor_id'); ?><br/>
			<?php echo $form->textField($model,'editor_id',array('size'=>10,'maxlength'=>10)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('edited_time'); ?><br/>
			<?php echo $form->textField($model,'edited_time'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('is_actived'); ?><br/>
			<?php echo $form->textField($model,'is_actived'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('inisiator_id'); ?><br/>
			<?php echo $form->textField($model,'inisiator_id',array('size'=>10,'maxlength'=>10)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('inisiator_name'); ?><br/>
			<?php echo $form->textField($model,'inisiator_name',array('size'=>60,'maxlength'=>80)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('is_verified'); ?><br/>
			<?php echo $form->textField($model,'is_verified'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('verificator_id'); ?><br/>
			<?php echo $form->textField($model,'verificator_id',array('size'=>10,'maxlength'=>10)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('verification_time'); ?><br/>
			<?php echo $form->textField($model,'verification_time'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('project_started_time'); ?><br/>
			<?php echo $form->textField($model,'project_started_time'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('project_ending_time'); ?><br/>
			<?php echo $form->textField($model,'project_ending_time'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('is_funded'); ?><br/>
			<?php echo $form->textField($model,'is_funded'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('as_institution_id'); ?><br/>
			<?php echo $form->textField($model,'as_institution_id',array('size'=>10,'maxlength'=>10)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('as_institution_name'); ?><br/>
			<?php echo $form->textField($model,'as_institution_name',array('size'=>60,'maxlength'=>255)); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>

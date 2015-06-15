<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'web-option-form',
	'enableAjaxValidation'=>false,
));

$listThemes = Yii::app()->themeManager->themeNames;
$themes     = array();
foreach($listThemes as $val) {
	$themes[$val] = $val;
}
?>

<?php //begin.Messages ?>
<div id="ajax-message">
<?php
	if(Yii::app()->user->hasFlash('error'))
		echo Utility::flashError(Yii::app()->user->getFlash('error'));
	if(Yii::app()->user->hasFlash('success'))
		echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
</div>
<?php //end.Messages ?>

<fieldset>

	<div>
		<?php echo $form->labelEx($model,'web_title'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'web_title',array('maxlength'=>128,'class'=>'span-5')); ?>
			<?php echo $form->error($model,'web_title'); ?>
		</div>
		<div class="clear"></div>
	</div>


	<div>
		<?php echo $form->labelEx($model,'meta_keyword'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'meta_keyword',array('rows'=>5,'maxlength'=>155,'class'=>'span-4')); ?>
			<?php echo $form->error($model,'meta_keyword'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'meta_description'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'meta_description',array('rows'=>5,'maxlength'=>155,'class'=>'span-4')); ?>
			<?php echo $form->error($model,'meta_description'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'email_admin'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'email_admin',array('maxlength'=>256,'class'=>'span-4')); ?>
			<?php echo $form->error($model,'email_admin'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'format_date'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'format_date',array('maxlength'=>50,'class'=>'span-2')); ?>
			<?php echo $form->error($model,'format_date'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'max_news_per_page'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'max_news_per_page',array('class'=>'span-1')); ?>
			<?php echo $form->error($model,'max_news_per_page'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'max_menu_per_page'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'max_menu_per_page',array('class'=>'span-1')); ?>
			<?php echo $form->error($model,'max_menu_per_page'); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="hide">
		<?php echo $form->labelEx($model,'status_web'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'status_web',array('maxlength'=>1,'class'=>'span-1')); ?>
			<?php echo $form->error($model,'status_web'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'teks_under_construction'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'teks_under_construction',array('maxlength'=>255,'class'=>'span-4')); ?>
			<?php echo $form->error($model,'teks_under_construction'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="submit">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save' ); ?>
		</div>
		<div class="clear"></div>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

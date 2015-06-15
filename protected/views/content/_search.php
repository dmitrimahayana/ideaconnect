<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<ul class="clearfix">
	<li>
		<?php echo $model->getAttributeLabel('title'); ?><br />
		<?php echo $form->textField($model,'title',array('maxlength'=>80)); ?>
	</li>

	<li>
		<?php echo $model->getAttributeLabel('content_categories_id'); ?><br />
		<?php 
		$contentCat = CHtml::listData(ContentCategories::model()->findAll(array(
										'select' => 'id, title'
									)),'id','title');
		echo $form->dropDownList($model, 'content_categories_id', $contentCat);
		?>
	</li>
	
	<li>
		<?php echo $model->getAttributeLabel('published'); ?><br />
		<?php
		$publish = array(0 => 'Tidak', 1 => 'Ya');
		echo $form->dropDownList($model, 'published', $publish);
		?>
	</li>

	<li class="submit">
		<?php echo CHtml::submitButton('Search'); ?>
	</li>
</ul>
<div class="clear"></div>
<?php $this->endWidget(); ?>

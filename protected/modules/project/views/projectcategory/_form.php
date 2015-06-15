<?php
/* @var $this ProjectCategoryController */
/* @var $model ProjectCategory */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-category-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<div id="ajax-message"><?php echo $form->errorSummary($model); ?></div>

	<fieldset>
	<div>
		<?php echo $form->labelEx($model,'category_name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'category_name',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'category_name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<div class="desc">
			<?php
            echo CHtml::activeDropDownList($model, "parent_id", ProjectCategory::model()->getCategory(), array("prompt"=>" - Pilihan Induk Kategori - "));
            //echo $form->textField($model,'parent_id'); ?>
			<?php echo $form->error($model,'parent_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="submit">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>
		<div class="clear"></div>
	</div>
	</fieldset>
<?php $this->endWidget(); ?>


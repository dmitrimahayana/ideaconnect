<?php
	/* @var $this JobseekerupdateController */
	/* @var $model CcnJobseekerUpdate */
	/* @var $form CActiveForm */
?>

<?php echo CHtml::beginForm(Yii::app()->createUrl($this->route), 'get', array(
	'name' => 'gridoption',
));
?>
<ul class="clearfix">
	<?php if ($columns != null){ ?> 
	<?php foreach($columns as $val){ ?>	<li>
		<?php echo CHtml::checkBox('GridColumn['.$val.']'); ?>
		<?php echo CHtml::label($val, 'GridColumn_'.$val); ?>
	</li>
	<?php } } ?></ul>
<div class="clear"></div>
<?php echo CHtml::endForm(); ?>

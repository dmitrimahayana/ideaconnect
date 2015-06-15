<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'                   => 'com-widgets-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
	),
));

$js = <<<EOP
	$('#ComWidgets_widget_type').on('change', function() {
		if($(this).val() == 'dynamic') {
			$('div.for-dynamic').removeClass('hide');
			$('div.for-static').addClass('hide');
			$(this).parent().find('div.small-px').html('Jika isi widget dari database.');
			$('#ComWidgets_hook_position').parent().parent().removeClass('hide');
			$('#ComWidgets_enabled').parent().parent().removeClass('hide');

		}else if($(this).val() == 'static') {
			$('div.for-dynamic').addClass('hide');
			$('div.for-static').removeClass('hide');
			$(this).parent().find('div.small-px').html('Jika widget merupakan file static.');
			$('#ComWidgets_hook_position').parent().parent().addClass('hide');
			$('#ComWidgets_enabled').parent().parent().addClass('hide');

		}else {
			$(this).parent().find('div.small-px').html('Pilih type widget');
		}
	});

	$('#ComWidgets_com_modules_id').on('change', function() {
		$('#module_name').val($(this).find('option:selected').text());
	});
EOP;

Yii::app()->clientScript->registerScript(Utility::getUniqId(), $js, CClientScript::POS_READY);
$enableOption = array(1 => 'Ya', 0 => 'Tidak');

if($model->overwriteWidget == '') {
	$model->overwriteWidget = 1;
}

// Remove last element from array.
$widgetType = $model->getWidgetType();
array_pop($widgetType);

$model->backupWidgetType = $model->widget_type;
if($model->widget_type == 'module') {
	$model->widget_type = 'static';
}
?>
<?php echo $form->errorSummary($model); ?>

<fieldset>

	<div>
		<?php echo $form->labelEx($model, 'widget_type'); ?>
		<div class="desc">
			<?php echo $form->dropDownList($model, 'widget_type', $widgetType, array(
				'prompt' => 'Pilih salah satu')); ?>
			<div class="small-px silent">
				<?php
				if(trim($model->widget_type) == 'dynamic') {
					echo 'Jika isi widget dari database.';
				}else {
					echo 'Jika widget merupakan file static.';
				}
				?>
			</div>
			<?php
			echo $form->hiddenField($model, 'backupWidgetType');
			?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="<?php echo (trim($model->widget_type) == 'dynamic'? 'hide ': ''); ?>for-static"
		style="padding-left:inherit;border-bottom:0px">
		<div>
			<?php echo $form->labelEx($model, 'file_name'); ?>
			<div class="desc">
				<?php echo $form->fileField($model, 'file_name'); ?>
				<div class="small-px silent">File zip yang berisi widget dan viewnya.</div>
				<?php echo $form->checkBox($model, 'overwriteWidget'); ?> Tumpuk widget yang sudah ada.
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>

	<div class="hide">
		<?php echo $form->labelEx($model,'com_modules_id'); ?>
		<div class="desc">
			<?php echo $form->dropDownList($model, 'com_modules_id', ComModules::model()->getListData(),
				array('prompt' => 'Pilih salah satu')); ?>
			<div class="small-px silent">Pilih jika widget termasuk dalam modul.</div>
			<?php echo CHtml::hiddenField('module_name', '', array('id' => 'module_name')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>

	<div class="<?php echo (trim($model->widget_type) == 'static'? 'hide ': ''); ?>for-dynamic"
		style="padding-left:inherit;border-bottom:0px;border-top:0px">
		<div>
			<?php echo $form->labelEx($model,'title'); ?>
			<div class="desc">
				<?php echo $form->textField($model, 'title', array('size' => 40)); ?>
			</div>
			<div class="clear"></div>
		</div>

		<div>
			<?php echo $form->labelEx($model,'content'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>

	<div>
		<?php echo $form->labelEx($model,'ordering');?>
		<div class="desc">
			<?php
				if(!$model->isNewRecord) {
					echo $form->dropDownList($model, 'ordering', $model->getOrder($model->hook_position));
				}else {
					echo 'Pengurutan tampil setelah data disimpan.';
				}
			?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'hook_position'); ?>
		<div class="desc">
			<?php echo $form->dropDownList($model, 'hook_position', Hooks::model()->getListData(),
				array('prompt' => 'Pilih salah satu')); ?>
			<div class="small-px silent">Posisi widget pada layout.</div>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'enabled'); ?>
		<div class="desc">
			<?php echo $form->dropDownList($model, 'enabled', $enableOption, array(
				'prompt' => 'Pilih salah satu')); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="hide">
		<?php echo $form->labelEx($model,'widget'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'widget',array('size'=>50,'maxlength'=>50)); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'access'); ?>
		<div class="desc">
			<?php
			$selected = array();

			if($model->access != '' && !is_array($model->access)) {
				$option   = explode(',', $model->access);

				foreach($option as $val) {
					$selected[$val] = array('selected' => 'selected');
				}
			}
			?>
			<?php echo $form->dropDownList($model, 'access', $model->getAccessList(), array(
				'multiple' => 'multiple', 'options' => $selected)); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'show_title'); ?>
		<div class="desc">
			<?php echo $form->dropDownList($model, 'show_title', $enableOption, array(
				'prompt' => 'Pilih salah satu')); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'params'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50)); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="submit">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Tambah' : 'Simpan'); ?>
		</div>
		<div class="clear"></div>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

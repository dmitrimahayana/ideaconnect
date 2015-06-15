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


	<fieldset class="clearfix">

		<div id="ajax-message">
			<?php echo $form->errorSummary($model); ?>
		</div>

		<div class="left">
			<div class="shadow"></div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'web_title'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'web_title',array('maxlength'=>128,'class'=>'span-6')); ?>
					<?php echo $form->error($model,'web_title'); ?>
				</div>
			</div>
            
            <div class="clearfix">
				<?php echo $form->labelEx($model,'pay_amount'); ?>
				<div class="desc">
					<?php echo 'Rp '.$form->textField($model,'pay_amount',array('maxlength'=>7,'class'=>'span-6')).' ,00'; ?>
					<?php echo $form->error($model,'pay_amount'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'meta_keyword'); ?>
				<div class="desc">
					<?php echo $form->textArea($model,'meta_keyword',array('rows'=>5,'maxlength'=>155,'class'=>'span-9 small')); ?>
					<?php echo $form->error($model,'meta_keyword'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'meta_description'); ?>
				<div class="desc">
					<?php echo $form->textArea($model,'meta_description',array('rows'=>5,'maxlength'=>155,'class'=>'span-9 small')); ?>
					<?php echo $form->error($model,'meta_description'); ?>
				</div>
			</div>

		</div>

		<div class="right">
			<div class="shadow"></div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'status_web'); ?>
				<div class="desc">
					<?php echo $form->checkBox($model,'status_web',array('maxlength'=>1,'class'=>'span-1')); ?>
					<?php echo $form->error($model,'status_web'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'teks_under_construction'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'teks_under_construction',array('maxlength'=>255,'class'=>'span-7')); ?>
					<?php echo $form->error($model,'teks_under_construction'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'email_admin'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'email_admin',array('maxlength'=>256,'class'=>'span-8')); ?>
					<?php echo $form->error($model,'email_admin'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'format_date'); ?>
				<div class="desc">
					<?php 
					echo $form->dropDownList($model,'format_date',array(
							'd/m/Y'	=> 'd/m/Y',
							'd-m-Y'	=> 'd-m-Y',
							'Y/m/d'	=> 'Y/m/d',
							'Y-m-d'	=> 'Y-m-d',
							'd-M-Y'	=> 'd-M-Y',
							'Y-M-d'	=> 'Y-M-d',
							'd F Y'	=> 'd F Y',
							'Y F d'	=> 'Y F d',
						)
					); 
					?>
					<?php echo $form->error($model,'format_date'); ?>
				</div>
			</div>

			<?php /*?><div class="clearfix">
				<?php echo $form->labelEx($model,'max_news_per_page'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'max_news_per_page',array('class'=>'span-2')); ?>
					<?php echo $form->error($model,'max_news_per_page'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'max_menu_per_page'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'max_menu_per_page',array('class'=>'span-2')); ?>
					<?php echo $form->error($model,'max_menu_per_page'); ?>
				</div>
			</div><?php */?>

		</div>
		<div class="clear"></div>

		<div class="submit clearfix">
			<label>&nbsp;</label>
			<div class="desc">
				<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('','Tambah') : Yii::t('','Simpan')); ?>
			</div>
		</div>

	</fieldset>
<?php $this->endWidget(); ?>

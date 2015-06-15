<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-details-form',
	'enableAjaxValidation'=>true,
)); ?>

	<fieldset class="clearfix">

		<div id="ajax-message">
			<?php echo $form->errorSummary($model); ?>
		</div>

		<div class="left">
			<div class="shadow"></div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'name'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'name',array('maxlength'=>255,'class'=>'span-7')); ?>
					<?php echo $form->error($model,'name'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'alias_url'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'alias_url',array('maxlength'=>255,'class'=>'span-5')); ?>
					<?php echo $form->error($model,'alias_url'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'address'); ?>
				<div class="desc">
					<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50,'class'=>'span-9 smaller')); ?>
					<?php echo $form->error($model,'address'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'country'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'country',array('maxlength'=>100,'class'=>'span-5')); ?>
					<?php echo $form->error($model,'country'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'propincy'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'propincy',array('maxlength'=>100,'class'=>'span-5')); ?>
					<?php echo $form->error($model,'propincy'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'city'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'city',array('maxlength'=>100,'class'=>'span-5')); ?>
					<?php echo $form->error($model,'city'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'post_code'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'post_code',array('maxlength'=>5,'class'=>'span-3')); ?>
					<?php echo $form->error($model,'post_code'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'misc'); ?>
				<div class="desc">
					<?php echo $form->textArea($model,'misc',array('rows'=>6, 'cols'=>50,'class'=>'span-9 smaller')); ?>
					<?php echo $form->error($model,'misc'); ?>
				</div>
			</div>

		<?php /* 	<div class="clearfix">
				<?php echo $form->labelEx($model,'params'); ?>
				<div class="desc">
					<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50,'class'=>'span-9 smaller')); ?>
					<?php echo $form->error($model,'params'); ?>
				</div>
			</div> */?>
		</div>

		<div class="right">
			<div class="shadow"></div>

			<h5>Detail Kontak</h5>
			<div class="clearfix">
				<?php echo $form->labelEx($model,'telephone'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'telephone',array('maxlength'=>255,'class'=>'span-7')); ?>
					<?php echo $form->error($model,'telephone'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'fax'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'fax',array('maxlength'=>255,'class'=>'span-7')); ?>
					<?php echo $form->error($model,'fax'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'mobile'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'mobile',array('maxlength'=>255,'class'=>'span-7')); ?>
					<?php echo $form->error($model,'mobile'); ?>
				</div>
			</div>

			<h5>Social Network</h5>
			<?php /*<div class="clearfix">
				<?php echo $form->labelEx($model,'messenger_id'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'messenger_id',array('maxlength'=>255,'class'=>'span-7')); ?>
					<?php echo $form->error($model,'messenger_id'); ?>
				</div>
			</div> */ ?>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'facebook_address'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'facebook_address',array('maxlength'=>255,'class'=>'span-7')); ?>
					<?php echo $form->error($model,'facebook_address'); ?>
				</div>
			</div>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'twitter_address'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'twitter_address',array('maxlength'=>255,'class'=>'span-7')); ?>
					<?php echo $form->error($model,'twitter_address'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'email_to'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'email_to',array('maxlength'=>255,'class'=>'span-7')); ?>
					<?php echo $form->error($model,'email_to'); ?>
				</div>
			</div>

			
		<?/* 	
		<h5>Status Detail</h5>
		<div class="clearfix">
				<?php echo $form->labelEx($model,'image'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'image',array('maxlength'=>255)); ?>
					<?php echo $form->error($model,'image'); ?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'image_pos'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'image_pos',array('maxlength'=>20)); ?>
					<?php echo $form->error($model,'image_pos'); ?>
				</div>
			</div>

			<div class="clearfix publish">
				<?php echo $form->checkBox($model,'published'); ?>
				<?php echo $form->labelEx($model,'published'); ?>
				<div class="desc">
					
				</div>
			</div> */?>


			<?php /*<div class="clearfix">
				<?php echo $form->labelEx($model,'ordering'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'ordering'); ?>
					<?php echo $form->error($model,'ordering'); ?>
				</div>
				<div class="clear"></div>
			</div>*/?>

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

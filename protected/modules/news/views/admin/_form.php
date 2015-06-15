<?php
$cs = Yii::app()->getClientScript();

$js=<<<EOP
	var maxChar = 160;
	$('.count-word').html(maxChar);
	
	$('#intro .ke-edit-textarea').live('keyup', function(){
		alert('tes');
		var length = $(this).val().length;
		var newLength = maxChar-length;
		$('.count-word').html(newLength);
	});

	$('#Content_quotes').live('click', function(){
		if( $(this).is(':checked') ){
			$('#quotes').show();
		}else{
			$('#quotes').hide();
		}
	});
EOP;
$ukey = md5(uniqid(mt_rand(), true));
$cs->registerScript($ukey, $js);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'content-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<div id="ajax-message"><?php echo $form->errorSummary($model); ?></div>

	<fieldset class="clearfix">
	    <div class="left">
			<div class="shadow"></div>
			<div class="clearfix">
				<?php echo $form->labelEx($model,'title'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
					<?php echo $form->error($model,'title'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
				<div class="clear"></div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'intro_text'); ?>
				<div class="desc">
					<?php echo $form->textArea($model, 'intro_text'); ?>
					<?php $this->widget('ext.kindeditor.KindEditorWidget', array(
							'id' => 'Content_intro_text',
							'name' => 'intro_text',
							'model' => $model,
							'items' => array(
								'width'=>'auto',
								'height'=>'200px',
								'themeType'=>'simple',
								'allowImageUpload'=>true,
								'allowFileManager'=>true,
								'langType'=>'en',
								'items'=>array(
									'bold', 'italic','underline', 
								),
							),
						));  ?>
					<?php echo $form->error($model,'intro_text'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
				<div class="clear"></div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'images'); ?>
				<div class="desc">
					<?php echo $form->fileField($model, 'images', array('size'=>60)); ?>
					<?php echo $form->error($model,'images'); ?>
				</div>
				<div class="clear"></div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'meta_key'); ?>
				<div class="desc">
					<?php echo $form->textArea($model,'meta_key', array('cols'=>50, 'rows'=>3 )); ?>
					<?php echo $form->error($model,'meta_key'); ?>
				</div>
				<div class="clear"></div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'meta_desc'); ?>
				<div class="desc">
					<?php echo $form->textArea($model,'meta_desc',array('cols'=>50, 'rows'=>3 )); ?>
					<?php echo $form->error($model,'meta_desc'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		
		<div class="right">
			<?php echo $this->renderPartial('/admin/_form_right', array(
				'model' => $model,
				'form'  => $form)
			); ?>
		</div>
	</fieldset>

	<fieldset class="clearfix">
		<div class="shadow"></div>	
		<?php if($model->source != ''){?>
			<div class="clearfix">
				<?php echo $form->labelEx($model,'quotes',array('style'=>'width:20%')); ?>
				<div class="desc">
					<?php echo $form->checkBox($model,'quotes',array('value' => '1', 'uncheckValue'=>'0', 'checked'=>'checked')); ?><br/><br/><br/>
					<div id="quotes">
					<?php echo $form->textArea($model,'source',array('cols'=>60, 'rows'=>8, 'maxlength'=>160))?>
					<?php echo $form->error($model,'source'); ?>
					<br/>
					Note : *Silahkan memasukkan {$quote} ke dalam Full text untuk meletakkan quote
					</div>
				</div>	
			</div>
		<?php }else{?>
			<div class="clearfix">
				<?php echo $form->labelEx($model,'quotes',array('style'=>'width:20%')); ?>
				<div class="desc">
					<?php echo $form->checkBox($model,'quotes',array('value' => '1', 'uncheckValue'=>'0')); ?><br/><br/><br/>
					<div id="quotes" class="hide">
					<?php echo $form->textArea($model,'source',array('cols'=>60, 'rows'=>8, 'maxlength'=>160))?>
					<?php echo $form->error($model,'source'); ?>
					<br/>
					Note : *Silahkan memasukkan {$quote} ke dalam Full text atau intro text detail untuk meletakkan quote
					</div>
				</div>	
			</div>
		<?php }?>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'full_text', array('style'=>'width:20%')); ?>
			<div class="desc" style="width:80%">
				<?php $this->widget('ext.kindeditor.KindEditorWidget',array(
					'id'    => 'Content_full_text',	//Textarea id
					'name'  => 'full_text',
					'model' => $model,
					// Additional Parameters (Check http://www.kindsoft.net/docs/option.html)
					'items' => array(
						'width'            => 'auto',
						'height'           => '200px',
						'themeType'        => 'simple',
						'allowImageUpload' => true,
						'allowFileManager' => true,
						'langType'         => 'en',
						'items'            => array(
							'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic',
							'underline', 'template', 'removeformat', '|', 'justifyleft', 'justifycenter',
							'justifyright', 'insertorderedlist','insertunorderedlist', '|',
							'source', 'image', 'link', 
						),
					),
				)); ?>
				<?php echo $form->textArea($model,'full_text', array('rows'=>10, 'cols'=>110,'class'=>'span-11')); ?>
				<?php echo $form->error($model,'full_text'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
			<div class="clear"></div>
		</div>

		<div class="clear"></div>
		<div class="submit clearfix">
			<label>&nbsp;</label>
			<div class="desc">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
			</div>
		</div>
	</fieldset>
<?php $this->endWidget();

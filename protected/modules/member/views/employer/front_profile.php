<?php
	/* @var $this EmployerController */
	/* @var $model PcrUsers */

	$this->breadcrumbs=array();
	$selectCityTarget = Yii::app()->createUrl('member/admin/selectcity');
	$cs = Yii::app()->getClientScript();
	$cekProvince = $model->province_id;
$js = <<<EOP
	var ina = $('#CcnEmployerData_country_code, #CcnEmployerData_cp_country_code').val();
	var province = '$cekProvince';
	if(province == '')
		$('#hide1').hide();
	
	if (ina == 'id')
		$('.hide').show();
		
	$('#CcnEmployerData_country_code, #CcnEmployerData_cp_country_code').change(function(){
		var id = $(this).val();
		if(id == 'id') {
			$('.hide').slideDown();
		} else {
			$('.hide').slideUp();
		}
	});
	
	$('#CcnEmployerData_province_id, #CcnEmployerData_cp_province_id').change(function(){
		var id = $(this).val();
		$.ajax({
			url: "$selectCityTarget",
			cache: false,
			data: 'id='+id,
			dataType: 'html',
			type: 'POST',
			success: function(msg){
				$('#CcnEmployerData_city_id').html(msg);
				$('#hide1').slideDown();
			}
		});
	});
	
EOP;
	$ukey = md5(uniqid(mt_rand(), true));
	$cs->registerScript($ukey, $js);
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
<?php //begin.Messages ?>

<div class="boxed profile">
	<h3 class="rockwell"><?php echo !isset($_GET['step']) ? Yii::t('label', 'Ubah Profil') : Yii::t('label', 'Ubah Informasi Kontak') ;?></h3>
	<div class="box">
	
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'ccn-employer-data-form',
			'htmlOptions' => array(
				'enctype' => 'multipart/form-data',
				'name' => 2,
			),
			'enableAjaxValidation'=>false,
		)); ?>

			<fieldset>

				<?php // echo $form->errorSummary($model); ?>

				<?php if(!isset($_GET['step'])) {?>

				<div>
					<label><?php echo $model->getAttributeLabel('name');?><span class="required">*</span></label>
					<div class="desc">
						<?php 
						if(!$model->isNewRecord){
							echo $form->textField($model,'name',array('class'=>'span-7','readonly'=>'readonly'));
						}else{
							echo $form->textField($model,'name',array('class'=>'span-7'));
						}
						?>
						<?php echo $form->error($model,'name'); ?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<label><?php echo $model->getAttributeLabel('company_desc');?><span class="required">*</span></label>
					<div class="desc">
						<?php echo $form->textArea($model,'company_desc',array('rows'=>5,'class'=>'span-9')); ?>
						<?php echo $form->error($model,'company_desc'); ?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<label><?php echo $model->getAttributeLabel('ccn_employer_industry_id');?><span class="required">*</span></label>
					<div class="desc">
						<?php
						$listData = CHtml::listData(CcnEmployerIndustry::model()->findAll(array('condition'=>'id != 1')),'id','name');
						echo $form->dropDownList($model,'ccn_employer_industry_id',$listData);
						?>
						<?php echo $form->error($model,'ccn_employer_industry_id'); ?>
					</div>
					<div class="clear"></div>
				</div>

				<div>
					<label><?php echo $model->getAttributeLabel('address');?><span class="required">*</span></label>
					<div class="desc">
						<?php echo $form->textArea($model,'address',array('rows'=>5,'class'=>'span-9 smaller')); ?>
						<?php echo $form->error($model,'address'); ?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<label><?php echo $model->getAttributeLabel('country_code');?><span class="required">*</span></label>
					<div class="desc">
						<?php
						$listData = CHtml::listData(ZoneCountry::model()->findAll(),'code','name');
						echo $form->dropDownList($model,'country_code',$listData);
						?>
						<?php echo $form->error($model,'country_code'); ?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="hide">
					<div>
						<label><?php echo $model->getAttributeLabel('province_id');?><span class="required">*</span></label>
						<div class="desc">
							<?php
							
							$listData = CHtml::listData(ZoneProvince::model()->findAll(),'id','name');
							if($model->province == '')
								echo $form->dropDownList($model,'province_id',$listData, array('empty'=>'Pilih salah satu', 'selected'=>array('id'=>'')));
							else
								echo $form->dropDownList($model,'province_id',$listData, array('empty'=>'Pilih salah satu'));
							?>
							<?php echo $form->error($model,'province_id'); ?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div id="hide1">
						<label><?php echo $model->getAttributeLabel('city_id');?><span class="required">*</span></label>
						<div class="desc">
							<?php
							$listData = CHtml::listData(CcnCity::model()->findAll(),'id','name');
							echo $form->dropDownList($model,'city_id',$listData);
							?>
							<?php echo $form->error($model,'city_id'); ?>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'postal_code'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'postal_code',array('maxlength'=>5,'class'=>'span-3')); ?>
						<?php echo $form->error($model,'postal_code'); ?>
					</div>
					<div class="clear"></div>
				</div>

				<div>
					<label><?php echo $model->getAttributeLabel('phone_no1');?><span class="required">*</span></label>
					<div class="desc">
						<?php echo $form->textField($model,'phone_no1',array('class'=>'span-4')); ?>
						<?php echo $form->error($model,'phone_no1'); ?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'phone_no2'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'phone_no2',array('class'=>'span-4')); ?>
						<?php echo $form->error($model,'phone_no2'); ?>
					</div>
					<div class="clear"></div>
				</div>
				
				
				<div>
					<?php echo $form->labelEx($model,'fax'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'fax',array('class'=>'span-4')); ?>
						<?php echo $form->error($model,'fax'); ?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'email'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'email',array('class'=>'span-6')); ?>
						<?php echo $form->error($model,'email'); ?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'website'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'website',array('class'=>'span-6')); ?>
						<?php echo $form->error($model,'website'); ?>
					</div>
					<div class="clear"></div>
				</div>
				<?php } else {?>
				
				<div>
					<label><?php echo $model->getAttributeLabel('contact_person');?><span class="required">*</span></label>
					<div class="desc">
						<?php echo $form->textField($model,'contact_person',array('class'=>'span-6'));?>
						<?php echo $form->error($model,'contact_person'); ?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'cp_address'); ?>
					<div class="desc">
						<?php echo $form->textArea($model,'cp_address',array('rows'=>5,'class'=>'span-9 smaller')); ?>
						<?php echo $form->error($model,'cp_address'); ?>
					</div>
					<div class="clear"></div>
				</div>

				<div>
					<?php echo $form->labelEx($model,'cp_country_code'); ?>
					<div class="desc">
						<?php
						$listData = CHtml::listData(ZoneCountry::model()->findAll(),'code','name');
						echo $form->dropDownList($model,'cp_country_code',$listData);
						?>
						<?php echo $form->error($model,'cp_country_code'); ?>
					</div>
					<div class="clear"></div>
				</div>		

				<div class="hide">
					<div>
						<?php echo $form->labelEx($model,'cp_province_id'); ?>
						<div class="desc">
							<?php
							$listData = CHtml::listData(ZoneProvince::model()->findAll(),'id','name');
							echo $form->dropDownList($model,'cp_province_id',$listData);
							?>
							<?php echo $form->error($model,'cp_province_id'); ?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div id="hide1">
						<?php echo $form->labelEx($model,'cp_city_id'); ?>
						<div class="desc">
							<?php
							$listData = CHtml::listData(CcnCity::model()->findAll(),'id','name');
							echo $form->dropDownList($model,'cp_city_id',$listData);
							?>
							<?php echo $form->error($model,'cp_city_id'); ?>
						</div>
						<div class="clear"></div>
					</div>
				</div>

				<div>
					<?php echo $form->labelEx($model,'cp_postal_code'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'cp_postal_code',array('class'=>'span-3')); ?>
						<?php echo $form->error($model,'cp_postal_code'); ?>
					</div>
					<div class="clear"></div>
				</div>

				<div>
					<?php echo $form->labelEx($model,'cp_phone'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'cp_phone',array('class'=>'span-5')); ?>
						<?php echo $form->error($model,'cp_phone'); ?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<label><?php echo $model->getAttributeLabel('cp_mobile');?><span class="required">*</span></label>
					<div class="desc">
						<?php echo $form->textField($model,'cp_mobile',array('class'=>'span-5')); ?>
						<?php echo $form->error($model,'cp_mobile'); ?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<label><?php echo $model->getAttributeLabel('cp_email');?><span class="required">*</span></label>
					<div class="desc">
						<?php echo $form->textField($model,'cp_email',array('class'=>'span-6')); ?>
						<?php echo $form->error($model,'cp_email'); ?>
					</div>
					<div class="clear"></div>
				</div>
				
				<?php }?>
				
				<div class="submit">
					<label>&nbsp;</label>
					<div class="desc">
						<?php echo CHtml::submitButton((isset($_GET['step'])) ? Yii::t('','Simpan') : Yii::t('','Langkah Selanjutnya'), array('onclick' => 'setEnableSave()')); ?>
					</div>
					<div class="clear"></div>
				</div>
			</fieldset>

		<?php $this->endWidget(); ?>

	</div>
</div>
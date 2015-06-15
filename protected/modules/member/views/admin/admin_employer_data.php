<?php
	/* @var $this PcrEmployerDataController */
	/* @var $model PcrEmployerData */
	/* @var $form CActiveForm */
	if(isset($_GET['step'])) {
		if ($this->action->id == 'employerdataedit')
			$title = 'Ubah Kontak Employer';
		else
			$title = 'Tambah Kontak Employer';
	} else {
		if ($this->action->id == 'employerdataedit')
			$title = 'Ubah Data Employer';
		else
			$title = 'Tambah Data Employer';
	}

	$this->pageTitle = $title;
	$this->breadcrumbs=array(
		'Manajemen Member Employer' => array('adminmanage', 'gid'=>$model->users->users_group_id),
		$title,
	);

	$selectCityTarget = Yii::app()->createUrl('member/admin/selectcity');
	$backStepUrl = Yii::app()->controller->createUrl('employerdataedit',array('id'=>$_GET['uid']));
        $cityId = $model->city_id != null ? $model->city_id : 0;
	$cs = Yii::app()->getClientScript();
$js = <<<EOP
	var ina = $('#CcnEmployerData_country_code, #CcnEmployerData_cp_country_code').val();
	$('#hide1').hide();
        
        if($cityId != 0)
            $('#hide1').slideDown();
	
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
			data: {'id':id,'model_name':'CcnEmployerData'},
			dataType: 'html',
			type: 'POST',
			success: function(msg){
				$('#CcnEmployerData_city_id').html(msg);
				$('#hide1').slideDown();
			}
		});
	});
	
	$('input#backStep').click(function(){
		location.href = '$backStepUrl';
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
<?php //end.Messages ?>

<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'pcr-employer-data-addemployerdata-form',
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
		'enableAjaxValidation'=>false,
	)); ?>

		<?php //echo $form->errorSummary($model); ?>

		<fieldset>
			<?php if(!isset($_GET['step'])) {?>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'name'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'name',array('class'=>'span-6')); ?>
					<?php echo $form->error($model,'name'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'company_desc'); ?>
				<div class="desc">
					<?php echo $form->textArea($model,'company_desc',array('rows'=>5,'class'=>'span-8')); ?>
					<?php echo $form->error($model,'company_desc'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'ccn_employer_industry_id'); ?>
				<div class="desc">
					<?php
					$listData = CHtml::listData(CcnEmployerIndustry::model()->findAll(array('condition'=>'id != 1')),'id','name');
					echo $form->dropDownList($model,'ccn_employer_industry_id',$listData);
					?>
					<?php echo $form->error($model,'ccn_employer_industry_id'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'address'); ?>
				<div class="desc">
					<?php echo $form->textArea($model,'address',array('rows'=>5,'class'=>'span-6')); ?>
					<?php echo $form->error($model,'address'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'country_code'); ?>
				<div class="desc">
					<?php
					$listData = CHtml::listData(ZoneCountry::model()->findAll(),'code','name');
					echo $form->dropDownList($model,'country_code',$listData,array('options' => array('id' => array('selected' => 'selected'))));
					?>
					<?php echo $form->error($model,'country_code'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
			
			<div class="hide">
				<div class="clearfix">
					<?php echo $form->labelEx($model,'province_id'); ?>
					<div class="desc">
						<?php
						$listData = CHtml::listData(ZoneProvince::model()->findAll(),'id','name');
						array_unshift($listData, 'Pilih Provinsi');
						echo $form->dropDownList($model,'province_id',$listData,array(
							'options'=> array(
								'0'	=> array(
									'selected'	=> 'selected',
									'disabled'	=> 'disabled'
								)
							)
						));
						?>
						<?php echo $form->error($model,'province_id'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>
				
				<div class="clearfix" id="hide1">
					<?php echo $form->labelEx($model,'city_id'); ?>
					<div class="desc">
						<?php
						$listData = CHtml::listData(CcnCity::model()->findAll(),'id','name');
						echo $form->dropDownList($model,'city_id',$listData);
						?>
						<?php echo $form->error($model,'city_id'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>
			</div>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'postal_code'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'postal_code'); ?>
					<?php echo $form->error($model,'postal_code'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'phone_no1'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'phone_no1',array('class'=>'span-3')); ?>
					<?php echo $form->error($model,'phone_no1'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'phone_no2'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'phone_no2',array('class'=>'span-3')); ?>
					<?php echo $form->error($model,'phone_no2'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'fax'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'fax',array('class'=>'span-3')); ?>
					<?php echo $form->error($model,'fax'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'email'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'email',array('class'=>'span-4')); ?>
					<?php echo $form->error($model,'email'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'website'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'website',array('class'=>'span-4')); ?>
					<div class="small-px silent">Contoh: http://websiteku.com</div>
					<?php echo $form->error($model,'website'); ?>
				</div>
			</div>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'company_logo_file'); ?>
				<div class="desc">
					<?php 
					$logoUrl =  Yii::app()->request->baseUrl.'/images/member_upload/employer/small/';
					$logo = $model->company_logo ? $logoUrl.'small_'.$model->company_logo : $logoUrl.'employer_default.png';
					echo '<img src="'.$logo.'" />';
					echo $form->fileField($model,'company_logo_file');
					?>
					<?php echo $form->error($model,'company_logo_file'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
			<?php
			$groupModel	= CcnEmployerGroup::model()->findAll();
			if ($groupModel != null) {
			?>
			<div class="clearfix">
				<?php echo $form->labelEx($model,'group'); ?>
				<div class="desc">
					<?php
					$data[0]	= 'Pilih Grup';
					
					foreach ($groupModel as $key => $val) {
						$data[$val->id] = $val->group_name;
					}
					
					echo $form->dropDownList($model,'group',$data);
					?>
					<?php echo $form->error($model,'group'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
			<?php
			}
			} else {?>
			<?php //php echo CHtml::button('Lanjut Contact Person', array('id'	=> 'nextData')); ?> 
			<!-- Dibuat tabbed form, ketika diklik keluar form di bawah ini. -->
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'contact_person'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'contact_person',array('class'=>'span-5'));?>
					<?php echo $form->error($model,'contact_person'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'cp_phone'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'cp_phone',array('class'=>'span-3')); ?>
					<?php echo $form->error($model,'cp_phone'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'cp_mobile'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'cp_mobile',array('class'=>'span-3')); ?>
					<?php echo $form->error($model,'cp_mobile'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'cp_email'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'cp_email',array('class'=>'span-4')); ?>
					<?php echo $form->error($model,'cp_email'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'cp_address'); ?>
				<div class="desc">
					<?php echo $form->textArea($model,'cp_address',array('rows'=>5,'class'=>'span-6')); ?>
					<?php echo $form->error($model,'cp_address'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>

			<div class="clearfix">
				<?php echo $form->labelEx($model,'cp_country_code'); ?>
				<div class="desc">
					<?php
					$listData = CHtml::listData(ZoneCountry::model()->findAll(),'code','name');
					echo $form->dropDownList($model,'cp_country_code',$listData);
					?>
					<?php echo $form->error($model,'cp_country_code'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>		
			
			<div class="hide">
				<div class="clearfix">
					<?php echo $form->labelEx($model,'cp_province_id'); ?>
					<div class="desc">
						<?php
						$listData = CHtml::listData(ZoneProvince::model()->findAll(),'id','name');
						array_unshift($listData, 'Pilih Provinsi');
						echo $form->dropDownList($model,'cp_province_id',$listData,array(
							'options'	=> array(
								'0'	=> array(
									'selected'	=> 'selected',
									'disabled'	=> 'disabled'
								)
							)
						));
						?>
						<?php echo $form->error($model,'cp_province_id'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>
				
				<div class="clearfix" id="hide1">
					<?php echo $form->labelEx($model,'cp_city_id'); ?>
					<div class="desc city_id">
						<?php
						$listData = CHtml::listData(CcnCity::model()->findAll(),'id','name');
						echo $form->dropDownList($model,'cp_city_id',$listData);
						?>
						<?php echo $form->error($model,'cp_city_id'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
				</div>
			</div>
			
			<div class="clearfix">
				<?php echo $form->labelEx($model,'cp_postal_code'); ?>
				<div class="desc">
					<?php echo $form->textField($model,'cp_postal_code'); ?>
					<?php echo $form->error($model,'cp_postal_code'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
			
			<?php }?>
			
			<div class="submit clearfix">
				<label>&nbsp;</label>
				<div class="desc">
					<?php echo $this->action->id == 'employerdataedit' ? ($_GET['step'] == 2 ? CHtml::button('Kembali', array('id'=>'backStep')) : CHtml::submitButton('Selesai')) : '';?>
					<?php echo CHtml::submitButton(($_GET['step'] == 2) ? 'Selesai' : 'Langkah Selanjutnya'); ?>
				</div>
			</div>

		</fieldset>

	<?php $this->endWidget(); ?>
</div>
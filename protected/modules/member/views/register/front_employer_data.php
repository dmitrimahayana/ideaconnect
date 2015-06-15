<?php
/* @var $this PcrEmployerDataController */
/* @var $model PcrEmployerData */
/* @var $form CActiveForm */

	$this->pageTitle = isset($_GET['step']) ? 'Tambah Data Contact Person' : 'Tambah Data Perusahaan';

	$selectCityTarget = Yii::app()->createUrl('member/register/selectcity');
	$cs = Yii::app()->getClientScript();
$js = <<<EOP
	var ina = $('#CcnEmployerData_country_code, #CcnEmployerData_cp_country_code').val();
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
				$('.city_id').html(msg);
				$('#hide1').slideDown();
			}
		});
	});
EOP;
	$ukey = md5(uniqid(mt_rand(), true));
	$cs->registerScript($ukey, $js);
	
	$formTitle = isset($_GET['step']) ? 'Data Contact Person' : 'Data Perusahaan';
?>

<div class="form">
	<?php //begin.Sidebar ?>
	<div class="employermenu">
		<ul>
			<li class="done" name="step1"><a class="bell-gothic" href="javascript:void(0);" title="Data Akun">Data Akun</a></li>
			<li <?php echo isset($_GET['step']) ? 'class="done"' : 'class="active"';?> name="step2"><a class="bell-gothic" href="javascript:void(0);" title="Data Perusahaan">Data Perusahaan</a><span><em>Arrow</em></span></li>
			<li <?php echo isset($_GET['step']) ? 'class="active"' : '';?> name="step3"><a class="bell-gothic" href="javascript:void(0);" title="Contact Person">Contact Person</a><span><em>Arrow</em></span></li>
		</ul>
	</div>
	<?php //end.Sidebar ?>

	<?php //begin.Form Input ?>
	<div class="box">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'pcr-employer-data-addemployerdata-form',
			'htmlOptions' => array('enctype' => 'multipart/form-data'),
			'enableAjaxValidation'=>false,
		)); ?>


			<fieldset>

				<h5 class="bell-gothic">Isi <?php echo $formTitle; ?></h5>

				<?php echo $form->errorSummary($model); ?>

				<?php if(!isset($_GET['step'])) {?>

				<div>
					<?php echo $form->labelEx($model,'name'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'name',array('class'=>'span-6','tabindex'=>1)); ?>
						<?php echo $form->error($model,'name'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'company_desc'); ?>
					<div class="desc">
						<?php echo $form->textArea($model,'company_desc',array('rows'=>5,'class'=>'span-8','tabindex'=>2)); ?>
						<?php echo $form->error($model,'company_desc'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'ccn_employer_industry_id'); ?>
					<div class="desc">
						<?php
						$listData = CHtml::listData(CcnEmployerIndustry::model()->findAll(array('condition'=>'id != 1')),'id','name');
						echo $form->dropDownList($model,'ccn_employer_industry_id',$listData,array('tabindex'=>3));
						?>
						<?php echo $form->error($model,'ccn_employer_industry_id'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>

				<div>
					<?php echo $form->labelEx($model,'address'); ?>
					<div class="desc">
						<?php echo $form->textArea($model,'address',array('rows'=>5,'class'=>'span-6','tabindex'=>4)); ?>
						<?php echo $form->error($model,'address'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'country_code'); ?>
					<div class="desc">
						<?php
						$listData = CHtml::listData(CcnCountry::model()->findAll(),'code','name');
						echo $form->dropDownList($model,'country_code',$listData,array('tabindex'=>5,'options' => array('id' => array('selected' => 'selected'))));
						?>
						<?php echo $form->error($model,'country_code'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="hide">
					<div>
						<?php echo $form->labelEx($model,'province_id'); ?>
						<div class="desc">
							<?php
							$listData = CHtml::listData(CcnProvince::model()->findAll(),'id','name');
							echo $form->dropDownList($model,'province_id',$listData,array('tabindex'=>6));
							?>
							<?php echo $form->error($model,'province_id'); ?>
							<?php /*<div class="small-px silent"></div>*/?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div id="hide1">
						<?php echo $form->labelEx($model,'city_id'); ?>
						<div class="desc city_id">
							<?php
							$listData = CHtml::listData(CcnCity::model()->findAll(),'id','name');
							echo $form->dropDownList($model,'city_id',$listData,array('tabindex'=>7));
							?>
							<?php echo $form->error($model,'city_id'); ?>
							<?php /*<div class="small-px silent"></div>*/?>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'phone_no1'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'phone_no1',array('class'=>'span-3','tabindex'=>8)); ?>
						<?php echo $form->error($model,'phone_no1'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'phone_no2'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'phone_no2',array('class'=>'span-3','tabindex'=>9)); ?>
						<?php echo $form->error($model,'phone_no2'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'postal_code'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'postal_code',array('size'=>5,'tabindex'=>10)); ?>
						<?php echo $form->error($model,'postal_code'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'fax'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'fax',array('class'=>'span-3','tabindex'=>12)); ?>
						<?php echo $form->error($model,'fax'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'email'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'email',array('class'=>'span-4','tabindex'=>13)); ?>
						<?php echo $form->error($model,'email'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'website'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'website',array('class'=>'span-4','tabindex'=>14)); ?>
						<?php echo $form->error($model,'website'); ?>
						<div class="small-px silent">Contoh: http://websiteku.com</div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="submit">
					<?php echo CHtml::submitButton(($_GET['step'] == 1) ? 'Langkah Selanjutnya' : 'Langkah Selanjutnya',array('tabindex'=>15)); ?>
				</div>

				<?php } else {?>
				<?php //php echo CHtml::button('Lanjut Contact Person', array('id'	=> 'nextData')); ?> 
				<!-- Dibuat tabbed form, ketika diklik keluar form di bawah ini. -->
				
				<div>
					<?php echo $form->labelEx($model,'contact_person'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'contact_person',array('class'=>'span-5','tabindex'=>1));?>
						<?php echo $form->error($model,'contact_person'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'cp_phone'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'cp_phone',array('class'=>'span-3','tabindex'=>2)); ?>
						<?php echo $form->error($model,'cp_phone'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'cp_mobile'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'cp_mobile',array('class'=>'span-3','tabindex'=>3)); ?>
						<?php echo $form->error($model,'cp_mobile'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'cp_email'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'cp_email',array('class'=>'span-4','tabindex'=>4)); ?>
						<?php echo $form->error($model,'cp_email'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'cp_address'); ?>
					<div class="desc">
						<?php echo $form->textArea($model,'cp_address',array('rows'=>5,'class'=>'span-6','tabindex'=>5)); ?>
						<?php echo $form->error($model,'cp_address'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>

				<div>
					<?php echo $form->labelEx($model,'cp_country_code'); ?>
					<div class="desc">
						<?php
						$listData = CHtml::listData(CcnCountry::model()->findAll(),'code','name');
						echo $form->dropDownList($model,'cp_country_code',$listData,array('tabindex'=>6));
						?>
						<?php echo $form->error($model,'cp_country_code'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>		
				
				<div class="hide">
					<div>
						<?php echo $form->labelEx($model,'cp_province_id'); ?>
						<div class="desc">
							<?php
							$listData = CHtml::listData(CcnProvince::model()->findAll(),'id','name');
							echo $form->dropDownList($model,'cp_province_id',$listData,array('tabindex'=>7));
							?>
							<?php echo $form->error($model,'cp_province_id'); ?>
							<?php /*<div class="small-px silent"></div>*/?>
						</div>
						<div class="clear"></div>
					</div>
					
					<div id="hide1">
						<?php echo $form->labelEx($model,'cp_city_id'); ?>
						<div class="desc city_id">
							<?php
							$listData = CHtml::listData(CcnCity::model()->findAll(),'id','name');
							echo $form->dropDownList($model,'cp_city_id',$listData,array('tabindex'=>8));
							?>
							<?php echo $form->error($model,'cp_city_id'); ?>
							<?php /*<div class="small-px silent"></div>*/?>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'cp_postal_code'); ?>
					<div class="desc">
						<?php echo $form->textField($model,'cp_postal_code',array('size'=>5,'tabindex'=>9)); ?>
						<?php echo $form->error($model,'cp_postal_code'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>
				
				<div>
					<?php echo $form->labelEx($model,'company_logo_file'); ?>
					<div class="desc">
						<?php echo $form->fileField($model,'company_logo_file',array('tabindex'=>10)); ?>
						<?php echo $form->error($model,'company_logo_file'); ?>
						<?php /*<div class="small-px silent"></div>*/?>
					</div>
					<div class="clear"></div>
				</div>
				<?php
				/* <div>
					<?php echo $form->labelEx($model,'group'); ?>
					<div class="desc">
						<?php
						$listData = CHtml::listData(CcnEmployerGroup::model()->findAll(),'id','group_name');
						echo $form->dropDownList($model,'group',$listData,array('tabindex'=>11)).'&nbsp;';
						?>
						<?php echo $form->error($model,'group'); ?>
						<?php /*<div class="small-px silent"></div>?>
					</div>
					<div class="clear"></div>
				</div> */
				?>

				<div class="submit">
					<?php echo CHtml::submitButton(($_GET['step'] == 1) ? 'Simpan' : 'Simpan',array('tabindex'=>12)); ?>
				</div>

				<?php }?>
				

			</fieldset>

		<?php $this->endWidget(); ?>

	</div>
	<?php //end.Form Input ?>
</div>


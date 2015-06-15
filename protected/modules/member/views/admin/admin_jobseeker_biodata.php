<?php
	/* @var $this PcrEmployerDataController */
	/* @var $model PcrEmployerData */
	/* @var $form CActiveForm */
	
	if ($this->action->id == 'jobseekerbiodataedit')
		$title = 'Ubah Biodata Jobseeker';
	else
		$title = 'Tambah Biodata Jobseeker';
	
	$this->pageTitle = $title;
	$this->breadcrumbs=array(
		'Manajemen Member Employer' => array('adminmanage', 'gid'=>$model->users->users_group_id),
		$title,
	);
	
	$current = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	$cs = Yii::app()->getClientScript();
	$selectCityTarget = Yii::app()->createUrl('member/admin/selectcity');
$js = <<<EOP
	$('input#CcnJobseekerBio_origin_status').change(function(){
		var checked = $(this).attr('checked');
		if(checked == 'checked') {
			$('div#similiar-address').slideUp();
			$("#CcnJobseekerBio_origin_address").val($("#CcnJobseekerBio_address").val());
			$("#CcnJobseekerBio_origin_city_id").val($("#CcnJobseekerBio_city_id").val()); 
			$("#CcnJobseekerBio_origin_province_id").val($("#CcnJobseekerBio_province_id").val());
		} else {
			$('fieldset div#similiar-address').slideDown();
		}
	}).change();
	$('select#CcnJobseekerBio_status').change(function(){
		var id = $(this).val();
		if(id == 'lajang') {
			$(this).parents('fieldset').find('#child').slideUp();
		} else {
			$(this).parents('fieldset').find('#child').slideDown();
		}
	}).change();
	
	$('#CcnJobseekerBio_province_id').change(function(){
		var id = $(this).val();
		$.ajax({
			url: "$selectCityTarget",
			cache: false,
			data: {'id':id,'model_name':'CcnJobseekerBio'},
			dataType: 'html',
			type: 'POST',
			success: function(msg){
				$('.city_id').html(msg);
				$('#hide1').slideDown();
			}
		});
	});
	
	$('#CcnJobseekerBio_origin_province_id').change(function(){
		var id = $(this).val();
		$.ajax({
			url: "$selectCityTarget",
			cache: false,
			data: {'id':id,'model_name':'CcnJobseekerBio'},
			dataType: 'html',
			type: 'POST',
			success: function(msg){
				$('.origin_city_id').html(msg);
				//$('#hide1').slideDown();
			}
		});
	});
	

EOP;
$js1 = <<<EOP
	$("#CcnJobseekerBio_birth_date").datepicker({
		'showAnim':'fold',
		'changeYear':true,
		'changeMonth':true,
		'dateFormat':'dd-mm-yy',
		'yearRange':'1975:2012'
	});
EOP;
	if($current == 'biodata/wizard') {
		$cs->registerScript('wizard', $js1, CClientScript::POS_END);
	}
	$cs->registerScript('mycv', $js, CClientScript::POS_END);
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
		'id'=>'pcr-jobseeker-biodata-addbiodata-form',
		'enableAjaxValidation'=>false,
		)); ?>
		
		
	<fieldset>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'complete_name'); ?>
			<div class="desc">
				<?php  echo $form->textField($model,'complete_name',array('maxlength'=>50,'class'=>'span-6'));?>
				<?php echo $form->error($model,'complete_name'); ?>
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'sex'); ?>
			<div class="desc">
				<?php 
				echo $form->radioButtonList($model,'sex',array('Pria'=>Yii::t('','Pria'),'Wanita'=>Yii::t('','Wanita')), array('separator' => ' ','template'=>'{input}&nbsp;&nbsp;{label}&nbsp;&nbsp;')); ?>
				<?php echo $form->error($model,'sex'); ?>
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'birth_place'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'birth_place',array('maxlength'=>30,'class'=>'span-5')); ?>
				<?php echo $form->error($model,'birth_place'); ?>
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'birth_date'); ?>
			<div class="desc">				
				<?php 
                               if($model->birth_date != null)
                                   $model->birth_date = date('d-m-Y', strtotime ($model->birth_date));
                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'model' => $model,
						'attribute' => 'birth_date',
						// additional javascript options for the date picker plugin
						'htmlOptions' => array(),
						'options'=>array(
							'showAnim'=>'slideDown',
							'dateFormat' => 'dd-mm-yy',
                                                        'changeYear'=>true,'changeMonth'=>true,
                                                        'yearRange'=>'1980:'.(date('Y')-15)
                                                        //'minDate'=> -20, 
                                                        //'maxDate'=> "+1M +10D"
                                                    
						),
					));	?>
				<?php echo $form->error($model,'birth_date'); ?>
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'status'); ?>
			<div class="desc">
				<?php 
				$status[$model->status] = array('selected'=>'selected');
				echo $form->dropDownlist($model,'status',array(
						'lajang'	=> 'Lajang',
						'menikah'	=> 'Menikah',
						'janda'	=> 'Janda',
					), 
					array('options'=>$status)); ?>
				<?php echo $form->error($model,'status'); ?>
			</div>
		</div>
		
		<div id="child" class="hide">
			<?php echo $form->labelEx($model,'child'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'child',array('class'=>'span-2')); ?>
				<?php echo $form->error($model,'child'); ?>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'religion'); ?>
			<div class="desc">
				<?php 
				$religion[$model->religion] = array('selected'=>'selected');
				echo $form->dropDownlist($model,'religion',array(
						'Budha'	=> 'Budha',
						'Hindhu'	=> 'Hindhu',
						'Islam'	=> 'Islam',
						'Katholik'	=> 'Katholik',
						'Kristen'	=> 'Kristen',
					), 
					array('options'=>$religion)); ?>
				<?php echo $form->error($model,'religion'); ?>
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'hobby'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'hobby',array('maxlength'=>75,'class'=>'span-9')); ?>
				<?php echo $form->error($model,'hobby'); ?>
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'address'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50, 'class'=>'span-9 smaller')); ?>
				<?php echo $form->error($model,'address'); ?>
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'province_id'); ?>
			<div class="desc">
				<?php
					$listData = CHtml::listData(CcnProvince::model()->findAll(),'id','name'); 
					echo $form->dropDownlist($model,'province_id',$listData,
					array(
						'options'	=> array(
							'0'	=> array(
								'selected'	=> 'selected',
								'disabled'	=> 'disabled'
							)
						), 
						'prompt' => Yii::t('site', 'Pilih salah satu')
					)
					); ?>
				<?php echo $form->error($model,'province_id'); ?>
			</div>
		</div>
		
		<div class="clearfix" id="hide1" <?php echo $model->isNewRecord ? 'class="hide"' : ''?>>
			<?php echo $form->labelEx($model,'city_id'); ?>
			<div class="desc city_id">
				<?php
					$listData = CHtml::listData(CcnCity::model()->findAll(),'id','name'); 
					echo $form->dropDownlist($model,'city_id',$listData, array('prompt' => Yii::t('site', 'Pilih salah satu'))); ?>
				<?php echo $form->error($model,'city_id'); ?>
			</div>
		</div>	
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'post_code'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'post_code',array('class'=>'span-3','maxlength'=>5)); ?>
				<?php echo $form->error($model,'post_code'); ?>
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'house_phone'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'house_phone',array('maxlength'=>15,'class'=>'span-4')); ?>
				<?php echo Yii::t('','Isikan angka saja tanpa spasi. Contoh: 0765777555');?>
				<?php echo $form->error($model,'house_phone'); ?>
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'mobile_phone'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'mobile_phone',array('maxlength'=>15,'class'=>'span-4')); ?>
				<?php echo Yii::t('','Contoh: 081123456789');?>
				<?php echo $form->error($model,'mobile_phone'); ?>
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'mobile_phone2'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'mobile_phone2',array('maxlength'=>15,'class'=>'span-4')); ?>
				<?php echo Yii::t('','Contoh: 081123456789');?>
				<?php echo $form->error($model,'mobile_phone2'); ?>
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'homepage'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'homepage',array('maxlength'=>50,'class'=>'span-5')); ?>
				<?php echo Yii::t('','Contoh: www.cc.pcr.ac.id');?>
				<?php echo $form->error($model,'homepage'); ?>
			</div>
		</div>
		
		<div class="clearfix">
			<label>&nbsp;</label>
			<div class="desc">
				<?php echo $form->checkBox($model,'origin_status'); ?>&nbsp;<?php echo Yii::t('','Alamat Asal = Alamat Sekarang');?>
				<?php echo $form->error($model,'origin_status'); ?>
			</div>
		</div>
		
		<div id="similiar-address">
			<div class="clearfix">
				<?php echo $form->labelEx($model,'origin_address'); ?>
				<div class="desc">
					<?php echo $form->textArea($model,'origin_address',array('rows'=>6, 'cols'=>50, 'class'=>'span-9 smaller')); ?>
					<?php echo $form->error($model,'origin_address'); ?>
				</div>
			</div>
		
			<div class="clearfix">
				<?php echo $form->labelEx($model,'origin_province_id'); ?>
				<div class="desc">
					<?php
						$listData = CHtml::listData(CcnProvince::model()->findAll(),'id','name'); 
						echo $form->dropDownlist($model,'origin_province_id',$listData); ?>
					<?php echo $form->error($model,'origin_province_id'); ?>
				</div>
			</div>
		
			<div class="clearfix">
				<?php echo $form->labelEx($model,'origin_city_id'); ?>
				<div class="desc origin_city_id">
					<?php
						$listData = CHtml::listData(CcnCity::model()->findAll(),'id','name'); 
						echo $form->dropDownlist($model,'origin_city_id',$listData); ?>
					<?php echo $form->error($model,'origin_city_id'); ?>
				</div>
			</div>
		</div>		
		
		<div class="submit clearfix">
			<label>&nbsp;</label>
			<div class="desc">
				<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('','Tambah') : Yii::t('','Simpan')); ?>
			</div>
		</div>
		
	</fieldset>

<?php $this->endWidget(); ?>
</div>
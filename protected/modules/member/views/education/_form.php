<?php
	/* @var $this JobseekereduController */
	/* @var $model CcnJobseekerEdu */
	/* @var $form CActiveForm */
	$current = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccn-jobseeker-edu-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=> array(
		'name'=>2,
	)
)); ?>

<fieldset>
        <?php if(isset($_GET['msg'])) { ?>
        <div class="errorSummary success"><p><?php echo $_GET['msg']; ?></p></div>
	<?php }else { ?>
        <div id="ajax-message"></div>
        <?php } ?>
	<div>
		<?php echo $form->labelEx($model,'degree'); ?>
		<div class="desc">
			<?php 
			if($model->isNewRecord)
				$model->degree = Yii::app()->user->id == 4 && $isEduComplete == 0 ? 'SMA' : 'S1';
			echo $form->dropDownList($model,'degree',array(
				'SMA'	=> 'SMA/Sederajat',
				'D3'	=> 'Diploma 3',
				'D4'	=> 'Diploma 4',
				'S1'	=> 'Sarjana/S1',
				'S2'	=> 'Master/S2',
				'S3'	=> 'Doktor/S3',
				)); ?>
			<?php echo $form->error($model,'degree'); ?>
		</div>
		<div class="clear"></div>
	</div>
    
	<div class="school">
		<?php echo $form->labelEx($model,'univ_name_id'); ?>
		<div class="desc">
			<?php echo $form->dropDownlist($model,'univ_name_id', CcnUnivName::getUniversitasActive(), array('prompt' => Yii::t('site', 'Pilih salah satu')) ); ?>
			<?php echo $form->error($model,'univ_name_id'); ?>
			<div class="other">
				<?php 
				$model->other_collage = $model->isNewRecord ? '0' : $model->univ_name_id == '1' ? '1' : '0';
				echo $form->checkBox($model,'other_collage'); ?>
				<?php echo $model->getAttributeLabel('other_collage');?>
			</div>
			
		</div>
		<div class="clear"></div>
	</div>
	
	<div id="other-collage" class="hint">
		<?php echo $form->labelEx($model,'name_non_univ'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'name_non_univ',array('class'=>'span-6','maxlength'=>70)); ?>
             <span class="hint"><span><?php echo Yii::t('','Isikan nama sekolah.');?></span><em>*</em></span>
			<?php echo $form->error($model,'name_non_univ'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="school hint" name="325">
		<?php echo $form->labelEx($model,'major'); ?>
		<div class="desc">
        	<?php 
			/* $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model' => $model,
				'attribute' => 'major',
				'source'=>$this->createUrl('/college/major/suggestmajor'),
				'options'=>array(
					'delay'=>50,
					'minLength'=>1,
					'showAnim'=>'fold',
					'select'=>"js:function(event, ui) {
						$('#CcnJobseekerEdu_ccn_major_id').val(ui.item.id);
					}"
				),
				'htmlOptions'=>array(
					'class'	=> 'span-6',
				),
			)); */
			?>
			<?php 
			//$model->id != null ? $model->major = $model->major->name : '';
			$model->major = $model->isNewRecord ? '' : ($model->ccn_major_id == 1 ? $model->suggest_major : $model->major->name);
			echo $form->textField($model,'major',array('maxlength'=>150));
			echo $model->ccn_major_id == 1 ? '<span class="red">&nbsp;*Jurusan belum standar, tunggu persetujuan admin.</span>' : '';
			?>
                <span class="hint"><span><?php echo Yii::t('','Isikan nama jurusan. Usahakan untuk memilih salah satu dari jurusan yang kami sediakan (Auto Suggest) agar memenuhi standarisasi. Jika benar tidak ada, ketikkan nama jurusan baru Anda.');?></span><em>*</em></span>
			<?php echo $form->error($model,'major'); ?>
            <?php echo $form->hiddenField($model,'ccn_major_id'); ?>
			<?php /*
				$listData = CHtml::listData(CcnMajor::model()->findAll(),'id','name'); 
				echo $form->dropDownlist($model,'ccn_major_id',$listData); */?>
			<?php echo $form->error($model,'ccn_major_id'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="school">
		<?php echo $form->labelEx($model,'acreditation'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'acreditation',array('maxlength'=>2,'size'=>'3')); ?>
			<?php echo $form->error($model,'acreditation'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="school" id="submajor">
		<?php echo $form->labelEx($model,'submajor'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'submajor',array('maxlength'=>150)); ?>
			<?php echo $form->error($model,'submajor'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="school">
		<?php echo $form->labelEx($model,'thesis_title'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'thesis_title',array('class'=>'span-9','maxlength'=>255)); ?>
			<?php echo $form->error($model,'thesis_title'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="hint">
		<?php echo $form->labelEx($model,'ipk'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'ipk',array('maxlength'=>5, 'size'=>3)); ?>
			<span class="hint"><span><?php echo Yii::t('','Pisahkan desimal dengan karakter titik. Contoh NEM: 42.5, contoh IPK: 3.8');?></span><em>*</em></span>
			<?php echo $form->error($model,'ipk'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'country_code'); ?>
		<div class="desc">
			<?php
			if($model->isNewRecord)
				$model->country_code = array('id');
			$listData = CHtml::listData(CcnCountry::model()->findAll(),'code','name'); 
			echo $form->dropDownlist($model,'country_code',$listData, array('selected'=>'id')); ?>
			<?php echo $form->error($model,'country_code'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'province_id'); ?>
		<div class="desc">
			<?php
			$listData = CHtml::listData(CcnProvince::model()->findAll(),'id','name');
			array_unshift($listData, 'Pilih Provinsi');
			echo $form->dropDownList($model,'province_id',$listData,
				array(
					'options'	=> array(
						$model->city->province_id => array(
							'selected'	=> 'selected',
							'disabled'	=> 'disabled'
						)
					)
				)
			);
			?>
			<?php echo $form->error($model,'province_id'); ?>
		</div>
		<div class="clear"></div>
	</div>
			
	<div id="hide1">
		<?php echo $form->labelEx($model,'city_id'); ?>
		<div class="desc">
			<?php
			$listData = CHtml::listData(CcnCity::model()->findAll(),'id','name');
			echo $form->dropDownList($model,'city_id',$listData, array('prompt'=>Yii::t('form', 'Pilih salah satu')));
			?>
			<?php echo $form->error($model,'city_id'); ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'entry_date') ?>
		<div class="desc">
			<?php
			$model->id != null ? $model->entry_date = $model->role_date.'-'.$model->role_month.'-'.$model->role_year : '';			
                        if(Yii::app()->controller->action->id == 'ajaxwizard' && !$model->isNewRecord)
                            echo $form->textField($model,'entry_date', array('id'=>'entry_date-'.$model->id));
                        else
                            echo $form->textField($model,'entry_date');
			
			?>
			<?php echo $form->error($model,'entry_date'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'graduated_date') ?>
		<div class="desc">
			<?php
			$model->id != null ? $model->graduated_date = $model->finish_date.'-'.$model->finish_month.'-'.$model->finish_year : '';
			if(Yii::app()->controller->action->id == 'ajaxwizard' && !$model->isNewRecord)
                            echo $form->textField($model,'graduated_date', array('id'=>'graduated_date-'.$model->id));
                        else
                            echo $form->textField($model,'graduated_date');
			
			?>
			<?php echo $form->error($model,'graduated_date'); ?>
		</div>
		<div class="clear"></div>
	</div>
	
	
	<div class="submit">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('','Tambah') : Yii::t('','Simpan'), array('onclick' => 'setEnableSave()')); ?>
			<?php if(!in_array($current ,array('education/wizard','education/ajaxwizard'))) {
				echo CHtml::button($model->isNewRecord ? Yii::t('','Batal') : Yii::t('','Batal') ,array('id'=>'cancel'));
			}?>
		</div>
		<div class="clear"></div>
	</div>

</fieldset>

<?php $this->endWidget(); ?>

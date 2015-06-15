<?php
/* @var $this BadgeController */
/* @var $model Badge */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'badge-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<div id="ajax-message"><?php echo $form->errorSummary($model); ?></div>

	<fieldset>
        <div>
            <?php echo $form->labelEx($model,'users_group_id'); ?>
            <div class="desc">
                <?php
                echo CHtml::activeDropDownList($model, "users_group_id", Users::model()->getUsersGroup(), array("prompt"=>" - Pilihan Grup Pengguna - "));
                //echo $form->textField($model,'users_group_id',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'users_group_id'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'name'); ?>
            <div class="desc">
                <?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'name'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'password'); ?>
            <div class="desc">
                <?php echo $form->textField($model,'password',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'password'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'email'); ?>
            <div class="desc">
                <?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'email'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'photo'); ?>
            <div class="desc">
                <?php
                echo $form->fileField($model,'photo1',array(
                    'maxlength'=>50,
                    'id'=> 'uploadImage',
                ));
//                echo $form->textField($model,'photo',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'photo'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
                <?php
                $sourceFile = "";
                if($model->photo != "" || $model->photo != NULL):
                    $sourceFile = Yii::app()->request->getBaseUrl(true)."/images/user/".$model->photo;
                ?>
                    <img id="preview_image" style="width:125px;height:125px;" src="<?= $sourceFile?>" />
                <?php endif; ?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'address'); ?>
            <div class="desc">
                <?php echo $form->textField($model,'address',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'address'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'regency_id'); ?>
            <div class="desc">
                <?php
                echo CHtml::activeDropDownList($model, "regency_id", ZoneRegency::model()->getCategory(), array("prompt"=>" - Pilihan Kabupaten - "));
                //echo $form->textField($model,'regency_id',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'regency_id'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'province_id'); ?>
            <div class="desc">
                <?php
                echo CHtml::activeDropDownList($model, "province_id", ZoneProvince::model()->getCategory(), array("prompt"=>" - Pilihan Propinsi - "));
                //echo $form->textField($model,'province_id',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'province_id'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'country_id'); ?>
            <div class="desc">
                <?php
                echo CHtml::activeDropDownList($model, "country_id", ZoneCountry::model()->getCategory(), array("prompt"=>" - Pilihan Negara - "));
                //echo $form->textField($model,'country_id',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'country_id'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'postcode'); ?>
            <div class="desc">
                <?php echo $form->textField($model,'postcode',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'postcode'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'house_phone'); ?>
            <div class="desc">
                <?php echo $form->textField($model,'house_phone',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'house_phone'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'mobile_no'); ?>
            <div class="desc">
                <?php echo $form->textField($model,'mobile_no',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'mobile_no'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'birth_place_id'); ?>
            <div class="desc">
                <?php
                echo CHtml::activeDropDownList($model, "birth_place_id", ZoneRegency::model()->getCategory(), array("prompt"=>" - Pilihan Tempat Lahir - "));
                //echo $form->textField($model,'birth_place_id',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'birth_place_id'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'is_male'); ?>
            <div class="desc">
                <?php
                echo $form->dropDownList($model, 'is_male',Users::model()->getStatus("Pria", "Wanita"), array(
                    'prompt' => 'Pilih Jenis Kelamin',
                    'style' => 'width:340px'
                ));
                //echo $form->textField($model,'is_male',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'is_male'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'religion_id'); ?>
            <div class="desc">
                <?php
                echo CHtml::activeDropDownList($model, "religion_id", Religion::model()->getCategory(), array("prompt"=>" - Pilihan Agama - "));
                //echo $form->textField($model,'religion_id',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'religion_id'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'university_id'); ?>
            <div class="desc">
                <?php
                echo CHtml::activeDropDownList($model, "university_id", EduUniversity::model()->getCategory(), array("prompt"=>" - Pilihan Universitas - "));
                //echo $form->textField($model,'university_id',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'university_id'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'major_id'); ?>
            <div class="desc">
                <?php
                echo CHtml::activeDropDownList($model, "major_id", EduMajor::model()->getCategory(), array("prompt"=>" - Pilihan Jurusan - "));
                //echo $form->textField($model,'major_id',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'major_id'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'last_education_degree_id'); ?>
            <div class="desc">
                <?php
                echo CHtml::activeDropDownList($model, "major_id", EduDegree::model()->getCategory(), array("prompt"=>" - Pilihan Gelar - "));
                //echo $form->textField($model,'last_education_degree_id',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'last_education_degree_id'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'last_education_city_id'); ?>
            <div class="desc">
                <?php
                echo CHtml::activeDropDownList($model, "last_education_city_id", ZoneRegency::model()->getCategory(), array("prompt"=>" - Pilihan Kota - "));
                //echo $form->textField($model,'last_education_city_id',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'last_education_city_id'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'last_education_province_id'); ?>
            <div class="desc">
                <?php
                echo CHtml::activeDropDownList($model, "last_education_province_id", ZoneProvince::model()->getCategory(), array("prompt"=>" - Pilihan Propinsi - "));
                //echo $form->textField($model,'last_education_province_id',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'last_education_province_id'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div>
            <?php echo $form->labelEx($model,'ugm_engineering_status_id'); ?>
            <div class="desc">
                <?php
                echo CHtml::activeDropDownList($model, "ugm_engineering_status_id", UgmEngineeringStatus::model()->getCategory(), array("prompt"=>" - Pilihan Pekerjaan di UGM - "));
                //echo $form->textField($model,'ugm_engineering_status_id',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'ugm_engineering_status_id'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="submit">
            <label>&nbsp;</label>
            <div class="desc">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
            </div>
            <div class="clear"></div>
        </div>
	</fieldset>
<?php $this->endWidget(); ?>


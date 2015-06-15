<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<?php
$cs = Yii::app()->getClientScript();
$urlGetCurr=Yii::app()->createUrl('project/project/getcurrent');
$js = <<<EOP

var urlGetCurr="$urlGetCurr";
$('#Project_project_category_id').change(function(){
    inp=$('#Project_project_category_id').val();
    $.ajax({
        type: "POST",
        //dataType: "html",
        data: "input="+inp,
        url: urlGetCurr,
        success: function(data) {
            $('#Project_project_category_inherit_id').html(data);
        },
        error: function(xhr,err){
            alert("readyState: "+xhr.readyState+" "+xhr.status);
        }
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview_image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#uploadImage").change(function(){
    readURL(this);
});

setTimeout(function(){
    $(".errorSummary").fadeOut();
}, 1000);


EOP;

$ukey = md5(uniqid(mt_rand(), true));
$cs->registerScript($ukey, $js);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<div id="ajax-message"><?php echo $form->errorSummary($model); ?></div>

	<fieldset>
	<div>
		<?php echo $form->labelEx($model,'project_name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'project_name',array('size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'project_name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'cover_image'); ?>
		<div class="desc">
            <?php echo $form->fileField($model,'cover_image1',array(
                'maxlength'=>50,
                'id'=> 'uploadImage',
            ));
            ?>
            <?php echo $form->error($model,'cover_image'); ?>
            <?php /*<div class="small-px silent"></div>*/?>
            <?php
            $sourceFile = "";
            if($model->cover_image != "" || $model->cover_image != NULL):
                $sourceFile = Yii::app()->request->getBaseUrl(true)."/images/project/".$model->cover_image;
            ?>
                <img id="preview_image" style="width:125px;height:125px;" src="<?= $sourceFile?>" />
            <?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'intro_text'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'intro_text',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'intro_text'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

    <div>
        <?php echo $form->labelEx($model,'tagline'); ?>
        <div class="desc">
            <?php echo $form->textField($model,'tagline',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'tagline'); ?>
            <?php /*<div class="small-px silent"></div>*/?>
        </div>
        <div class="clear"></div>
    </div>

	<div>
		<?php echo $form->labelEx($model,'geometry_location'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'geometry_location'); ?>
			<?php echo $form->error($model,'geometry_location'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'project_category_id'); ?>
		<div class="desc">
			<?php
                echo $form->dropDownList($model, 'project_category_id',Project::model()->getIdCategory(), array(
                    'prompt' => 'Pilih Kategori Project',
                    'style' => 'width:200px'
                ));
			//echo $form->textField($model,'project_category_id'); ?>
			<?php echo $form->error($model,'project_category_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>
	<div >
		<?php echo $form->labelEx($model,'project_category_inherit_id'); ?>
		<div class="desc">
			<?php
            echo $form->dropDownList($model, 'project_category_inherit_id',
                (isset($model->project_category_inherit_id))?
                    /*array(
                        $model->project_category_inherit_id=>$model->project_category_inherit->category_name,
                        null =>'Tidak ada',
                    )*/
                    Project::model()->getIdInheritCategory($model->project_category_id,$model->project_category_inherit_id)
                    :array( null =>'Pilih Sub Kategori' ),
                array(
                    'style' => 'width:200px',
                )
            );
			//echo $form->textField($model,'project_category_inherit_id'); ?>
			<?php echo $form->error($model,'project_category_inherit_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<!--<div>
		<?php //echo $form->labelEx($model,'project_category_name'); ?>
		<div class="desc">
			<?php //echo $form->textField($model,'project_category_name',array('size'=>60,'maxlength'=>80)); ?>
			<?php //echo $form->error($model,'project_category_name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php //echo $form->labelEx($model,'project_category_name_inherit'); ?>
		<div class="desc">
			<?php //echo $form->textField($model,'project_category_name_inherit',array('size'=>60,'maxlength'=>80)); ?>
			<?php //echo $form->error($model,'project_category_name_inherit'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>-->

	<div>
		<?php echo $form->labelEx($model,'video_url'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'video_url',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'video_url'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

    <div>
        <?php echo $form->labelEx($model,'background_title'); ?>
        <div class="desc">
            <?php echo $form->textArea($model,'background_title',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'background_title'); ?>
            <?php /*<div class="small-px silent"></div>*/?>
        </div>
        <div class="clear"></div>
    </div>

	<div>
		<?php echo $form->labelEx($model,'background'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'background',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'background'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

    <div>
        <?php echo $form->labelEx($model,'description_title'); ?>
        <div class="desc">
            <?php echo $form->textArea($model,'description_title',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'description_title'); ?>
            <?php /*<div class="small-px silent"></div>*/?>
        </div>
        <div class="clear"></div>
    </div>

	<div>
		<?php echo $form->labelEx($model,'description'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'description'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

    <div>
        <?php echo $form->labelEx($model,'goal_title'); ?>
        <div class="desc">
            <?php echo $form->textArea($model,'goal_title',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'goal_title'); ?>
            <?php /*<div class="small-px silent"></div>*/?>
        </div>
        <div class="clear"></div>
    </div>

	<div>
		<?php echo $form->labelEx($model,'goal'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'goal',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'goal'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

    <div>
        <?php echo $form->labelEx($model,'requisite_title'); ?>
        <div class="desc">
            <?php echo $form->textArea($model,'requisite_title',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'requisite_title'); ?>
            <?php /*<div class="small-px silent"></div>*/?>
        </div>
        <div class="clear"></div>
    </div>

    <div>
        <?php echo $form->labelEx($model,'invitation_title'); ?>
        <div class="desc">
            <?php echo $form->textArea($model,'invitation_title',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'invitation_title'); ?>
            <?php /*<div class="small-px silent"></div>*/?>
        </div>
        <div class="clear"></div>
    </div>

    <div>
        <?php echo $form->labelEx($model,'invitation'); ?>
        <div class="desc">
            <?php echo $form->textArea($model,'invitation',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'invitation'); ?>
            <?php /*<div class="small-px silent"></div>*/?>
        </div>
        <div class="clear"></div>
    </div>

	<div>
		<?php echo $form->labelEx($model,'charge'); ?>
		<div class="desc">
			<?php
			echo $form->textField($model,'charge',array('size'=>14,'maxlength'=>14)); ?>
			<?php echo $form->error($model,'charge'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'charge_is_percentage'); ?>
		<div class="desc">
			<?php
            echo $form->dropDownList($model, 'charge_is_percentage',Project::model()->getStatus("Yes", "No"), array(
                'prompt' => 'Pilih Status Charge',
                'style' => 'width:80px'
            ));
			//echo $form->textField($model,'charge_is_percentage'); ?>
			<?php echo $form->error($model,'charge_is_percentage'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'created_time'); ?>
		<div class="desc">
			<?php
            Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
            $this->widget('CJuiDateTimePicker', array(
                'model' => $model,
                'language' => 'id',
                'attribute' => 'created_time', //attribute name
                'mode' => 'datetime', //use 'time','date' or 'datetime' (default)
                'options' => array('dateFormat' => 'yy-mm-dd'), // jquery plugin options
            ));
			//echo $form->textField($model,'created_time'); ?>
			<?php echo $form->error($model,'created_time'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'is_actived'); ?>
		<div class="desc">
			<?php
            echo $form->dropDownList($model, 'is_actived',Project::model()->getStatus("Aktif", "Tidak Aktif"), array(
                'prompt' => 'Pilih Status',
                'style' => 'width:340px'
            ));
			//echo $form->textField($model,'is_actived'); ?>
			<?php echo $form->error($model,'is_actived'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>
    <div>
        <?php echo $form->labelEx($model,'is_proposed'); ?>
        <div class="desc">
            <?php
            echo $form->dropDownList($model, 'is_proposed',Project::model()->getStatus("Yes", "No"), array(
                'prompt' => 'Pilih Status',
                'style' => 'width:340px'
            ));
            //echo $form->textField($model,'is_actived'); ?>
            <?php echo $form->error($model,'is_proposed'); ?>
            <?php /*<div class="small-px silent"></div>*/?>
        </div>
        <div class="clear"></div>
    </div>

	<div>
		<?php echo $form->labelEx($model,'inisiator_id'); ?>
		<div class="desc">
			<?php echo $form->hiddenField($model,'inisiator_id',array('size'=>10,'maxlength'=>10));
            echo $model->inisiator_name;
            ?>
			<?php echo $form->error($model,'inisiator_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

    <div>
        <?php echo $form->labelEx($model,'project_time'); ?>
        <div class="desc">
            <?php
            echo $form->dropDownList($model, 'project_time',TimeLimit::model()->getCategory(0), array(
                'prompt' => 'Pilih Lama Project (Bulan)',
                'style' => 'width:200px'
            ));
            //echo $form->textField($model,'project_time'); ?>
            <?php echo $form->error($model,'project_time'); ?>
            <?php /*<div class="small-px silent"></div>*/?>
        </div>
        <div class="clear"></div>
    </div>

	<div>
		<?php echo $form->labelEx($model,'project_started_time'); ?>
		<div class="desc">
			<?php
            Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
            $this->widget('CJuiDateTimePicker', array(
                'model' => $model,
                'language' => 'id',
                'attribute' => 'project_started_time', //attribute name
                'mode' => 'datetime', //use 'time','date' or 'datetime' (default)
                'options' => array('dateFormat' => 'yy-mm-dd'), // jquery plugin options
            ));
			//echo $form->textField($model,'project_started_time'); ?>
			<?php echo $form->error($model,'project_started_time'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'project_ending_time'); ?>
		<div class="desc">
			<?php
            Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
            $this->widget('CJuiDateTimePicker', array(
                'model' => $model,
                'language' => 'id',
                'attribute' => 'project_ending_time', //attribute name
                'mode' => 'datetime', //use 'time','date' or 'datetime' (default)
                'options' => array('dateFormat' => 'yy-mm-dd'), // jquery plugin options
            ));
			//echo $form->textField($model,'project_ending_time'); ?>
			<?php echo $form->error($model,'project_ending_time'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'as_institution_id'); ?>
		<div class="desc">
			<?php
            echo $form->dropDownList($model, 'as_institution_id',Project::model()->getIdInstitute(), array(
                'prompt' => 'Pilih Institusi',
                'style' => 'width:340px'
            ));
//			echo $form->textField($model,'as_institution_id',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'as_institution_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

    <div>
        <?php echo $form->labelEx($model,'is_verified'); ?>
        <div class="desc">
            <?php
            echo $form->dropDownList($model, 'is_verified',Project::model()->getStatus("Terverifikasi", "Belum Terverifikasi"), array(
                'prompt' => 'Pilih Status',
                'style' => 'width:340px'
            ));
            //echo $form->textField($model,'is_verified'); ?>
            <?php echo $form->error($model,'is_verified'); ?>
            <?php /*<div class="small-px silent"></div>*/?>
        </div>
        <div class="clear"></div>
    </div>

	<div class="submit">
		<label>&nbsp;</label>
		<div class="desc">
			<?php
            if($model->is_verified!=1){
                echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');
            } ?>
		</div>
		<div class="clear"></div>
	</div>
	</fieldset>
<?php $this->endWidget(); ?>


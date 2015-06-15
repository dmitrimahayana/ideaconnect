<?php
/* @var $this InstitutionSomeController */
/* @var $model InstitutionSome */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'institution-some-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<div id="ajax-message"><?php echo $form->errorSummary($model); ?></div>

	<fieldset>
	<div>
		<?php echo $form->labelEx($model,'name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'address'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'address'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'province_id'); ?>
		<div class="desc">
			<?php
            echo CHtml::activeDropDownList($model, "province_id", ZoneProvince::model()->getCategory(), array("prompt"=>" - Pilihan Propinsi - "));
            //echo $form->textField($model,'province_id'); ?>
			<?php echo $form->error($model,'province_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'regency_id'); ?>
		<div class="desc">
			<?php
            echo CHtml::activeDropDownList($model, "regency_id", ZoneRegency::model()->getCategory(), array("prompt"=>" - Pilihan Daerah - "));
            //echo $form->textField($model,'regency_id'); ?>
			<?php echo $form->error($model,'regency_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'institution_phone_number'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'institution_phone_number',array('size'=>15,'maxlength'=>15)); ?>
			<?php echo $form->error($model,'institution_phone_number'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'job_position'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'job_position',array('size'=>60,'maxlength'=>80)); ?>
			<?php echo $form->error($model,'job_position'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
		<div class="clear"></div>
	</div>

	<div>
		<?php echo $form->labelEx($model,'user_id'); ?>
		<div class="desc">
			<?php
            $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
                'name'=>'user_id',
                'attribute'=>'user_id',
                'model'=>$model,
                //'source'=>array('DemitMahyana','DhikaOctaviani','AhmadAminrudin'),
                'sourceUrl'=>Yii::app()->createUrl('location/InstitutionSome/GetIdUsername'),
                // additional javascript options for the autocomplete plugin
                'options'=>array(
                    'minLength'=>'1',
                ),
            ));
			//echo $form->textField($model,'user_id',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'user_id'); ?>
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


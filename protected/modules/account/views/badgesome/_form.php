<?php
/* @var $this BadgeSomeController */
/* @var $model BadgeSome */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'badge-some-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<div id="ajax-message"><?php echo $form->errorSummary($model); ?></div>

	<fieldset>
	<div>
		<?php echo $form->labelEx($model,'badge_id'); ?>
		<div class="desc">
			<?php
            echo CHtml::activeDropDownList($model, "badge_id", Badge::model()->getCategory(), array("prompt"=>" - Pilihan Rekomendasi - "));
            //echo $form->textField($model,'badge_id'); ?>
			<?php echo $form->error($model,'badge_id'); ?>
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
                'sourceUrl'=>Yii::app()->createUrl('account/badgesome/GetIdUsername'),
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


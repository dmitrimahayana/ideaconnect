<?php
$this->breadcrumbs=array(
    'Projects'=>array('adminmanage'),
    $model->project->project_name=>array('adminview','id'=>$model->project_id),
    'Detail Pendanaan'=>array('RequisiteView','id'=>$model->project_id),
    Yii::t('site', 'Waktu Pendanaan'),
);

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'project-form',
    'enableAjaxValidation'=>true,
    'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

<div id="ajax-message"><?php echo $form->errorSummary($model); ?></div>

<script>
//    alert('HALO'+$('#ProjectRequisite_funding_started_time').val());
//    alert($.datepicker.formatDate( "yy/mm/dd",'2013-08-21')); //$('#ProjectRequisite_funding_started_time').datepicker('getDate')));
</script>

<fieldset>
    <div id="partial-project">
        <?php
        //echo $model->id.' '.$model->project_id.' '.$model->funding_time.' '.$model->funding_started_time.' '.$model->funding_closed_time;
        echo '<h1>Pendanaan ke-'.$model->counter_time.'</h1>'
        ?>
        <div>
            <?php echo $form->labelEx($model,'funding_time'); ?>
            <div class="desc">
                <?php
                echo $form->textField($model,'funding_time'); ?>
                <?php echo $form->error($model,'funding_time'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>
        <div>
            <?php echo $form->labelEx($model,'funding_started_time'); ?>
            <div class="desc">
                <?php
                Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                $this->widget('CJuiDateTimePicker', array(
                    'model' => $model,
                    'language' => 'id',
                    'attribute' => 'funding_started_time', //attribute name
                    'mode' => 'datetime', //use 'time','date' or 'datetime' (default)
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
//                        'minDateTime'=>'js:new Date(' . date('Y,m,d-7,H,i') . ')',
                    ), // jquery plugin options
                ));
                //echo $form->textField($model,'created_time'); ?>
                <?php echo $form->error($model,'funding_started_time'); ?>
                <?php /*<div class="small-px silent"></div>*/?>
            </div>
            <div class="clear"></div>
        </div>
        <div>
            <?php echo $form->labelEx($model,'funding_closed_time'); ?>
            <div class="desc">
                <?php
                Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                $this->widget('CJuiDateTimePicker', array(
                    'model' => $model,
                    'language' => 'id',
                    'attribute' => 'funding_closed_time', //attribute name
                    'mode' => 'datetime', //use 'time','date' or 'datetime' (default)
                    'options' => array(
                        'beforeShow'=> 'customRange',
                        'dateFormat' => 'yy-mm-dd',
                        //'maxDateTime'=>"new Date($(#ProjectRequisite_funding_started_time).val())",
                    ), // jquery plugin options
                ));
                //echo $form->textField($model,'created_time'); ?>
                <?php echo $form->error($model,'funding_closed_time'); ?>
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

<?php $this->endWidget(); ?>
    </fieldset>
    <button name="cancel" onclick="window.location.href='<?= Yii::app()->createUrl('project/admin/requisiteview',array('id'=>$model->project_id)); ?>'">Cancel</button>
</div>
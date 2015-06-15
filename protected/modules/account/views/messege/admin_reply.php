<?php
/* @var $this MessegeController */
/* @var $model Messege */

$this->breadcrumbs=array(
    'Messages'=>array('adminmanage'),
    Yii::t('site', 'Reply'),
);

$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/office/grid-view.css');
?>

<? //begin.Messages ?>
<?php
if(Yii::app()->user->hasFlash('success'))
    echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>

<div id="partial-messege">
<? //end.Messages ?>
<?php
//$this->widget('application.components.system.BDetailView', array(
//    'data'=>$modelData,
//    'attributes'=>array(
//        'subject',
//        'messege',
//        'from_user_name',
//        'to_user_name',
//        'sent_time',
//    ),
//));
foreach($modelData as $key){
    if($key['from_user_id']==8){
        echo '<center>Pengirim: '.$key['from_user_name'].'<br/>';
        echo 'Pesan: '.$key['messege'].'<br/>';
        echo $key['sent_time'].'</center><br/>';
    }
    else {
        echo 'Pengirim: '.$key['from_user_name'].'<br/>';
        echo 'Pesan: '.$key['messege'].'<br/>';
        echo $key['sent_time'].'<br/><br/>';
    }
}
?>
</div>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'messege-form',
    'enableAjaxValidation'=>false,
    //'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>
<div id="ajax-message"><?php echo $form->errorSummary($model); ?></div>

<fieldset>
    <div>
        <?php echo $form->labelEx($model,'messege'); ?>
        <div class="desc">
            <?php echo $form->textArea($model,'messege',array('size'=>60,'maxlength'=>255, 'style'=>'width:400px;height:100px;')); ?>
            <?php echo $form->error($model,'messege'); ?>
            <?php /*<div class="small-px silent"></div>*/?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="submit">
        <label>&nbsp;</label>
        <div class="desc">
            <?php
                echo CHtml::submitButton($model->isNewRecord ? 'Send' : 'Save');
            ?>
        </div>
        <div class="clear"></div>
    </div>
</fieldset>
<?php $this->endWidget(); ?>
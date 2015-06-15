<?php
$this->breadcrumbs=array(
    'Projects'=>array('adminmanage'),
    $project_name=>array('adminview','id'=>$project_id),
    'Detail Pendanaan'=>array('requisiteview','id'=>$project_id),
    Yii::t('site', 'Detail Progress Info'),
);
?>

<? //begin.Messages ?>
<?php
if(Yii::app()->user->hasFlash('success'))
    echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<? //end.Messages ?>
<?php $this->widget('application.components.system.BDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'title',
        'detail',
        'created_time',
        'update_time',
        array(
            "name"=>'Tampilkan Umum',
            "type"=>'raw',
            "value"=>  Utility::getPublishedToImg($model->show_public),
        ),
        array(
            "name"=>'Tampilkan Anggota',
            "type"=>'raw',
            "value"=>  Utility::getPublishedToImg($model->show_member),
        ),
        array(
            "name"=>'Tampilkan Sponsor',
            "type"=>'raw',
            "value"=>  Utility::getPublishedToImg($model->show_sponsor),
        ),
    ),
)); ?>

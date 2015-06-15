<?php
	/* @var $this InstitutionSomeController */
	/* @var $model InstitutionSome */

$this->breadcrumbs=array(
	'Institution Somes'=>array('adminmanage'),
	Yii::t('site', 'Detail Institution Somes'),
);

	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/office/grid-view.css');
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
//		'id',
		'name',
		'address',
//		'province_id',
        array(
            "name"=>'province_id',
            //"type"=>'raw',
            //'htmlOptions'=>array('style'=>'width: 120px'),
            //"value"=> (isset($model->cover_image)?CHtml::image(Yii::app()->request->getBaseUrl(true)."/images/project/".$model->cover_image,"",array("style"=>"width:125px;height:125px;")):'') ,
            "value"=>$model->province->name
        ),
//		'regency_id',
        array(
            "name"=>'regency_id',
            //"type"=>'raw',
            //'htmlOptions'=>array('style'=>'width: 120px'),
            //"value"=> (isset($model->cover_image)?CHtml::image(Yii::app()->request->getBaseUrl(true)."/images/project/".$model->cover_image,"",array("style"=>"width:125px;height:125px;")):'') ,
            "value"=>$model->regency->name
        ),
		'institution_phone_number',
		'job_position',
//		'user_id',
        array(
            "name"=>'user_id',
            //"type"=>'raw',
            //'htmlOptions'=>array('style'=>'width: 120px'),
            //"value"=> (isset($model->cover_image)?CHtml::image(Yii::app()->request->getBaseUrl(true)."/images/project/".$model->cover_image,"",array("style"=>"width:125px;height:125px;")):'') ,
            "value"=>$model->user->name
        ),
	),
)); ?>

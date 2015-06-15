<?php
	/* @var $this ZoneProvinceController */
	/* @var $model ZoneProvince */

$this->breadcrumbs=array(
	'Zone Provinces'=>array('adminmanage'),
	Yii::t('site', 'Detail Zone Provinces'),
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
		//'id',
		'name',
		//'country_code',
        array(
            "name"=>'country_code',
            //"type"=>'raw',
            //'htmlOptions'=>array('style'=>'width: 120px'),
            //"value"=> (isset($model->cover_image)?CHtml::image(Yii::app()->request->getBaseUrl(true)."/images/project/".$model->cover_image,"",array("style"=>"width:125px;height:125px;")):'') ,
            "value"=>$model->country_codes->name
        ),
	),
)); ?>

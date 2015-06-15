<?php
	/* @var $this ProjectController */
	/* @var $model Project */

$this->breadcrumbs=array(
	'Projects'=>array('adminmanage'),
	Yii::t('site', 'Detail Projects'),
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
		'project_name',
        array(
            "name"=>'cover_image',
            "type"=>'raw',
            'htmlOptions'=>array('style'=>'width: 120px'),
            "value"=> (isset($model->cover_image)?CHtml::image(Yii::app()->request->getBaseUrl(true)."/images/project/".$model->cover_image,"",array("style"=>"width:125px;height:125px;")):'') ,
        ),
		'intro_text',
		'geometry_location',
		//'project_category_id',
		//'project_category_inherit_id',
		'project_category_name',
		'project_category_name_inherit',
		//'video_url',
        array(
            'name'=>'video_url',
            'type'=>'raw',
            //'value'=>'<embed width="590" height="365" type="application/x-shockwave-flash" src="'.$model->video_url.'">'
            'value'=> (isset($model->video_url))?'<iframe width="560" height="315" src="'.$model->video_url.'" frameborder="0" allowfullscreen></iframe>':''
        ),
		'background',
		'description',
		'goal',
		'charge',
        array(
            "name"=>'charge_is_percentage',
            "type"=>'raw',
            "value"=>  Utility::getPublishedToImg($model->charge_is_percentage),
        ),
		'created_time',
		//'editor_id',
        array(
            'name'=>'Nama Editor',
            'type'=>'raw',
            'value'=>$model->editor->name,
        ),
		'edited_time',
        array(
            "name"=>'is_actived',
            "type"=>'raw',
            "value"=>  Utility::getPublishedToImg($model->is_actived),
        ),
        array(
            "name"=>'is_proposed',
            "type"=>'raw',
            "value"=>  Utility::getPublishedToImg($model->is_proposed),
        ),
		'inisiator_name',
        array(
            "name"=>'is_verified',
            "type"=>'raw',
            "value"=>  Utility::getPublishedToImg($model->is_verified),
        ),
		//'verificator_id',
        array(
            "name"=>'Nama Verifikator',
            "type"=>'raw',
            "value"=>  $model->verificator->name,
        ),
		'verification_time',
        'project_time',
		'project_started_time',
		'project_ending_time',
		//'is_funded',
        array(
            "name"=>'is_funded',
            "type"=>'raw',
            "value"=>  Utility::getPublishedToImg($model->is_funded),
        ),
		'as_institution_name',
	),
)); ?>

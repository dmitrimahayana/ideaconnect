<?php
	/* @var $this BadgeController */
	/* @var $model Badge */

$this->breadcrumbs=array(
	'Pengguna'=>array('adminmanage'),
	Yii::t('site', 'Detail Pengguna'),
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
        array(
            'name' => 'users_group_id',
            'value' => $model->users_group->name,
        ),
        'name',
        'username',
        'password',
        'email',
        array(
            "name"=>'photo',
            "type"=>'raw',
            'htmlOptions'=>array('style'=>'width: 120px'),
            "value"=> (isset($model->photo)?CHtml::image(Yii::app()->request->getBaseUrl(true)."/images/user/".$model->photo,"",array("style"=>"width:125px;height:125px;")):'') ,
        ),
        'address',
        array(
            'name' => 'regency_id',
            'value' => $model->regency->name,
        ),
        array(
            'name' => 'province_id',
            'value' => $model->province->name,
        ),
        array(
            'name' => 'country_id',
            'value' => $model->country->name,
        ),
        'postcode',
        'house_phone',
        'mobile_no',
//        'birth_place_id',
        array(
            'name' => 'birth_place_id',
            'value' => $model->birth_place->name,
        ),
        array(
            'name' => 'Jenis Kelamin',
            'value' => ($model->is_male==1)?'Pria':'Wanita',
        ),
//        'religion_id'
        array(
            'name' => 'religion_id',
            'value' => $model->religion->religion,
        ),
        'last_education_name',
        array(
            'name' => 'university_id',
            'value' => $model->university->name,
        ),
//        array(
//            'name' => 'faculty_id',
//            'value' => $model->faculty->name,
//        ),
        array(
            'name' => 'major_id',
            'value' => $model->major->name,
        ),
        array(
            'name' => 'last_education_degree_id',
            'value' => $model->last_education_degree->degree,
        ),
        array(
            'name' => 'last_education_city_id',
            'value' => $model->last_education_city->name,
        ),
        array(
            'name' => 'last_education_province_id',
            'value' => $model->last_education_province->name,
        ),
        array(
            'name' => 'Pekerjaan di UGM',
            'value' => Users::model()->getUGMEngineeringStats($model->ugm_engineering_status_id),
        ),

	),
)); ?>

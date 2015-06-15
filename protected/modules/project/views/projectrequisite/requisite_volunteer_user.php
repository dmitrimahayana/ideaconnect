<?php
$this->breadcrumbs=array(
'Projects'=>array('adminmanage'),
$project_name=>array('adminview','id'=>$project_id),
'Detail Pendanaan'=>array('RequisiteView','id'=>$project_id),
Yii::t('site', 'Detail Sukarelawan'),
);
?>

<div id="dialog-modal">
    <div id="partial-project">
<?php
foreach($model->getData() as $key){
    echo 'Nama: '.$key->volunteer_name.'<br/>';
    echo 'Contact: '.$key->contact_number.'<br/>';
    echo 'Email:'.$key->email.'<br/>';
    echo 'Alamat: '.$key->address.'<br/>';
    echo 'Kawasan: '.$key->regency.'<br/>';
    echo 'Propinsi: '.$key->province.'<br/>';
    echo 'Kelamin: '.($key->is_male=1)?'Pria':'Wanita';
    echo '<br/><br/>';
}
/*$this->widget('application.components.system.BDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        //'id',
        array(
            "name"=>'Kebutuhan',
            "value"=>  $model->volunteer_requirement->requirement,
        ),
        'volunteer_name',
        'contact_number',
        'email',
        'address',
        'regency',
        'province',
        array(
            "name"=>'Jenis Kelamin',
            "value"=>  ($model->is_male==1)?'Pria':'Wanita',
        ),
    ),
));*/ ?>
        </div>
</div>
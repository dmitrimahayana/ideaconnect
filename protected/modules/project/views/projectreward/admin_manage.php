<?php
$this->breadcrumbs=array(
    'Projects'=>array('adminmanage'),
    $project_name=>array('adminview','id'=>$project_id),
    'Detail Pendanaan'=>array('RequisiteView','id'=>$project_id),
    Yii::t('site', 'Detail Hadiah'),
);
?>
<?php
/* @var $this ProjectController */
/* @var $model Project */

$cs = Yii::app()->getClientScript();
$js=<<<EOP
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('project-grid', {
			data: $(this).serialize()
		});
		return false;
	});
EOP;
$cs->registerScript('search', $js, CClientScript::POS_END);

?>

<div id="partial-project">
<? //begin.Messages ?>
    <div id="ajax-message">
        <?php
        //        if(Yii::app()->user->hasFlash('error'))
        //            echo Utility::flashError(Yii::app()->user->getFlash('error'));
        //        if(Yii::app()->user->hasFlash('success'))
        //            echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
        ?>
    </div>
<? //begin.Messages ?>

<? //begin.Grid Item ?>
<?php
$columnData = $columns;
array_push($columnData, array(
    'header' => 'Option',
    'class'=>'CButtonColumn',
    'buttons' => array(
        'view1' => array(
            'label' => 'Detail Reward User',
            'options' => array(
                'rel' => 500,
                'class' => 'view'
            ),
            'click' => 'dialogUpdate',
//            'url' => 'Yii::app()->controller->createUrl("GetDetailRewardUser",array("id"=>$data->primaryKey, "requisite_id"=>'.$id.', "project_id"=>'.$project_id.', "reward"=>$data->reward))'),
            'url' => 'Yii::app()->controller->createUrl("GetDetailRewardUser",array("id"=>$data->primaryKey, "reward"=>$data->reward))'
        ),
    ),
    'template' => '{view1}&nbsp',
));

$this->widget('application.components.system.BGridView', array(
    'id'=>'project-grid',
    'dataProvider'=>$model->getSomeReward($id),
    'filter'=>$model,
    'columns' => $columnData,
    'pager' => array('header' => ''),
));
?>
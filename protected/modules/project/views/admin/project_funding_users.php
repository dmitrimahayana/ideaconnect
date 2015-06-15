<?php
/* @var $this ProjectController */
/* @var $model Project */
$this->breadcrumbs=array(
    'Projects'=>array('adminmanage'),
    $project_name=>array('adminview','id'=>$project_id),
    'Detail Pendanaan'=>array('RequisiteView','id'=>$project_id),
    Yii::t('site', 'Detail Pendanaan Sponsor'),
);


$cs = Yii::app()->getClientScript();
//$urlUpdate=Yii::app()->controller->createUrl("adminUpdateRequisite");
//$urlAjaxVolunteerUser=Yii::app()->createUrl('project/project/EditTime/id');

$js=<<<EOP
    //$('.view').click(function() {
        //var temp=$(this).attr('url');
        //alert( temp );

    //});

	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('project-grid', {
			data: $(this).serialize()
		});
		return false;
	});
EOP;

$cs->registerScript('search', $js, CClientScript::POS_END);

$this->menu=array(
    array(
        'label' => 'Filter',
        'url' => array('javascript:void(0);'),
        'itemOptions' => array('class' => 'filter-button'),
        'linkOptions' => array('title' => 'Filter'),
    ),
    array(
        'label' => 'Grid Options',
        'url' => array('javascript:void(0);'),
        'itemOptions' => array('class' => 'grid-button'),
        'linkOptions' => array('title' => 'Grid Options'),
    ),
);

?>

<div id="partial-project">
    <? //begin.Search ?>
    <div class="search-form">
<!--        --><?php //$this->renderPartial('_search',array(
//            'model'=>$model,
//        )); ?>
    </div>
    <? //end.Search ?>

    <? //begin.Grid Option ?>
    <div class="grid-option">
<!--        --><?php //$this->renderPartial('_option_form',array(
//            'model'=>$model,
//        )); ?>
    </div>
    <? //end.Grid Option ?>

    <? //begin.Messages ?>
    <div id="ajax-message">
        <?php
        if(Yii::app()->user->hasFlash('error'))
            echo Utility::flashError(Yii::app()->user->getFlash('error'));
        if(Yii::app()->user->hasFlash('success'))
            echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
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
            'view' => array(
                'label' => 'Kembalikan Dana',
                'options' => array(
                    'rel' => 500,
                    'class' => 'view',
                ),
                'click' => 'dialogUpdate',
                'url' => 'Yii::app()->controller->createUrl("ResetReturnFunding",array("id"=>$data->primaryKey, "idRequisite"=>'.$idRequisite.', "project_id"=>'.$project_id.' ))'),
        ),
//       'cssClassExpression'=>'Project::generateEdit($data->is_verified)',
        'template' =>'{view}&nbsp;',
    ));

    $this->widget('application.components.system.BGridView', array(
        'id'=>'project-grid',
        'dataProvider'=>$model->getSomeFundingUser($idRequisite),
        'filter'=>$model,
        'columns' => $columnData,
        'pager' => array('header' => ''),
    ));

    ?>
    <? //end.Grid Item ?>
</div>
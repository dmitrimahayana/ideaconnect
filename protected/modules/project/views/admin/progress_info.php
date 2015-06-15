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
<!--    <div class="search-form">-->
<!--        --><?php //$this->renderPartial('_search',array(
//            'model'=>$model,
//        )); ?>
<!--    </div>-->
<!--    --><?// //end.Search ?>
<!---->
<!--    --><?// //begin.Grid Option ?>
<!--    <div class="grid-option">-->
<!--        --><?php //$this->renderPartial('_option_form',array(
//            'model'=>$model,
//        )); ?>
<!--    </div>-->
    <? //end.Grid Option ?>

    <? //begin.Messages ?>
<!--    <div id="ajax-message">-->
<!--        --><?php
//        if(Yii::app()->user->hasFlash('error'))
//            echo Utility::flashError(Yii::app()->user->getFlash('error'));
//        if(Yii::app()->user->hasFlash('success'))
//            echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
//        ?>
<!--    </div>-->
    <? //begin.Messages ?>

    <? //begin.Grid Item ?>
    <?php
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['Project'])) {
        $model->attributes=$_GET['Project'];
    }

    $columnTemp = array();
    if(isset($_GET['GridColumn'])) {
        foreach($_GET['GridColumn'] as $key => $val) {
            if($_GET['GridColumn'][$key] == 1) {
                $columnTemp[] = $key;
            }
        }
    }
    $columnData = $model->getGridColumn($columnTemp);

    array_push($columnData, array(
        'header' => 'Option',
        'class'=>'CButtonColumn',
        'buttons' => array(
            'view' => array(
                'label' => 'view',
                'options' => array(
                    //'rel' => 500,
                    'class' => 'view'
                ),
                //'click' => 'dialogUpdate',
                'url' => 'Yii::app()->controller->createUrl("ProgressInfoView",array("id"=>$data->primaryKey,"project_id"=>'.$id.',))'),
        ),
        'template' =>'{view}&nbsp;', //'{view}&nbsp;{update}&nbsp;{detail}',
    ));

    $this->widget('application.components.system.BGridView', array(
        'id'=>'project-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns' => $columnData,
        'pager' => array('header' => ''),
    ));

    ?>
    <? //end.Grid Item ?>
</div>
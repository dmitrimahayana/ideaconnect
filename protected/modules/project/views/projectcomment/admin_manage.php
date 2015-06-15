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
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['Comment'])) {
        $model->attributes=$_GET['Comment'];
    }

    $columnTemp = array();
    if(isset($_GET['GridColumn'])) {
        foreach($_GET['GridColumn'] as $key => $val) {
            if($_GET['GridColumn'][$key] == 1) {
                $columnTemp[] = $key;
            }
        }
    }
    $columns = $model->getGridColumn($columnTemp);

    $columnData = $columns;
    array_push($columnData, array(
        'header' => 'Option',
        'class'=>'CButtonColumn',
        'buttons' => array(
            'view1' => array(
//                'label' => 'view',
                'label' => 'show',
                'options' => array(
                    //'rel' => 500,
                    'class' => 'view'
                ),
                //'click' => 'dialogUpdate',
                'url' => 'Yii::app()->controller->createUrl("DetailComment",array("id"=>$data->primaryKey, "project_id"=>'.$id.', "type"=>1))'),
            'view2' => array(
//                'label' => 'view',
                'label' => 'Hide',
                'options' => array(
                    //'rel' => 500,
                    'class' => 'view'
                ),
                //'click' => 'dialogUpdate',
                'url' => 'Yii::app()->controller->createUrl("DetailComment",array("id"=>$data->primaryKey, "project_id"=>'.$id.', "type"=>0))'),
//            'update' => array(
//                'label' => 'update',
//                'options' => array(
//                    //'rel' => 500,
//                    'class' => 'update'
//                ),
//                //'click' => 'dialogUpdate',
//                'url' => 'Yii::app()->controller->createUrl("adminedit",array("id"=>$data->primaryKey))'),
//            'detail' => array(
//                'label' => 'detail',
//                'options' => array(
//                    'class' => 'view',
//                    //'rel' => 350,
//                ),
//                //'click' => 'dialogUpdate',
//                'url' => 'Yii::app()->controller->createUrl("RequisiteView",array("id"=>$data->primaryKey))'
//            )
        ),
        'template' => '{view1}&nbsp{view2}&nbsp;',
    ));

    $this->widget('application.components.system.BGridView', array(
        'id'=>'project-grid',
        'dataProvider'=>$model->getSomeCommentProject($id),
        'filter'=>$model,
        'columns' => $columnData,
        'pager' => array('header' => ''),
    ));

    ?>
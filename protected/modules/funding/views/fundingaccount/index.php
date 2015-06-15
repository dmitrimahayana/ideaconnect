<?php
/* @var $this DefaultController */
$this->pageTitle = 'Kelola Akun Pendanaan';$this->breadcrumbs=array(
    'Akun Pendanaan'=>array('managefundingaccount'),
    'Kelola',
);
?>

<? //begin.Search ?>
<div class="search-form">
    <?php //$this->renderPartial('_search',array(
    //'model'=>$model,
    //)); ?>
</div>
<? //end.Search ?>

<? //begin.Messages ?>
<?php
if(Yii::app()->user->hasFlash('error'))
    echo Utility::flashError(Yii::app()->user->getFlash('error'));
if(Yii::app()->user->hasFlash('success'))
    echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));

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
    <button name="addNewfundingaccount" onClick="location.href='<?php echo Yii::app()->createUrl('funding/fundingaccount/fundingaccountAdd') ?>'" >Tambah Data</button>

    <? //begin.Search ?>
    <div class="search-form">
        <?php //$this->renderPartial('_search',array(
        //'model'=>$model,
        //)); ?>
    </div>
    <? //end.Search ?>

    <? //begin.Header Grid ?>
    <div class="thead">
        <!--<div class="setting">
            <a class="grid-button" href="javascript:void(0);" title="Grid Options"><span>m</span><u></u></a>
        </div>
        <span class="icons">C</span>-->
        <h5><span>Kelola Akun Pendanaan</span></h5>
        <div class="clear"></div>
    </div>
    <? //end.Header Grid ?>

    <? //begin.Grid Option ?>
    <!--<div class="grid-option">
        t\<?php /*$this->renderPartial('_option_form',array(
            'model'=>$model,
        ));*/ ?>
    </div>-->
    <? //end.Grid Option ?>

    <? //begin.Grid Item ?>
    <?php
    $columnData   = $columns;
    array_push($columnData, array(
        'header' => 'Option',
        'class'=>'CButtonColumn',
        'buttons' => array(
            'view' => array(
                'label' => 'detail',
                'options' => array(
                    //'rel' => 600,
                    'class' => 'view'
                ),
                //'click' => 'dialogUpdate',
                'url' => 'Yii::app()->controller->createUrl("fundingaccountview",array("id"=>$data->primaryKey))'),
            'update' => array(
                'label' => 'perbaharui',
                'options' => array(
                    //'rel' => 600,
                    'class' => 'update'
                ),
                //'click' => 'dialogUpdate',
                'url' => 'Yii::app()->controller->createUrl("fundingaccountedit",array("id"=>$data->primaryKey))'),
            'delete' => array(
                'label' => 'hapus',
                'options' => array(
                    'class' => 'delete'
                ),
                'url' => 'Yii::app()->controller->createUrl("fundingaccountdelete",array("id"=>$data->primaryKey))')
        ),
        'template' => '{view}&nbsp;{update}&nbsp;{delete}',
    ));

    $this->widget('application.components.system.BGridView', array(
        'id'=>'content-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns' => $columnData,
        'pager' => array('header' => ''),
    ));

    ?>
    <? //end.Grid Item ?>

</div>

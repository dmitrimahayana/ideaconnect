<?php
	/* @var $this BadgeController */
	/* @var $model Badge */

$this->breadcrumbs=array(
	'Pengguna'=>array('adminmanage'),
	Yii::t('site', 'Kelola Pengguna'),
);

	$cs = Yii::app()->getClientScript();
$js=<<<EOP
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('badge-grid', {
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

<div id="partial-badge">
	<? //begin.Search ?>
	<div class="search-form">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
	</div>
	<? //end.Search ?>

	<? //begin.Grid Option ?>
	<div class="grid-option">
	<?php $this->renderPartial('_option_form',array(
		'model'=>$model,
	)); ?>
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
				'label' => 'view',
				'options' => array(
					//'rel' => 500, 
					'class' => 'view'
				),
				//'click' => 'dialogUpdate',
				'url' => 'Yii::app()->controller->createUrl("adminview",array("id"=>$data->primaryKey))'),
			'update' => array(
				'label' => 'update',
				'options' => array(
					//'rel' => 500, 
					'class' => 'update'
				),
				//'click' => 'dialogUpdate',
				'url' => 'Yii::app()->controller->createUrl("adminedit",array("id"=>$data->primaryKey))'),
			'delete' => array(
				'label' => 'delete',
				'options' => array(
					'class' => 'delete',
					'rel' => 350, 
				),
				'click' => 'dialogUpdate',
				'url' => 'Yii::app()->controller->createUrl("admindelete",array("id"=>$data->primaryKey))')
		),
		'template' => '{view}&nbsp;{update}&nbsp;{delete}',
	));

    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'mail-form',
        'enableAjaxValidation'=>true,
//        'htmlOptions' => array('enctype' => 'multipart/form-data')
    ));

	$this->widget('application.components.system.BGridView', array(
//		'id'=>'badge-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns' => $columnData,
		'pager' => array('header' => ''),
	));

    echo CHtml::button('Sent Mail', array('submit' => array('member/adminmanage'),'style'=>'height:40px;width:100px;'));

    $this->endWidget();
	?>
	<? //end.Grid Item ?>
</div>
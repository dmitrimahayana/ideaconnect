<?php
	/* @var $this ZoneCountryController */
	/* @var $model ZoneCountry */

$this->breadcrumbs=array(
	'Zone Countries'=>array('adminmanage'),
	Yii::t('site', 'Kelola Zone Countries'),
);

	$cs = Yii::app()->getClientScript();
$js=<<<EOP
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('zone-country-grid', {
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

<div id="partial-zone-country">
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
				'url' => 'Yii::app()->controller->createUrl("adminview",array("ID"=>$data->primaryKey))'),
			'update' => array(
				'label' => 'update',
				'options' => array(
					//'rel' => 500, 
					'class' => 'update'
				),
				//'click' => 'dialogUpdate',
				'url' => 'Yii::app()->controller->createUrl("adminedit",array("ID"=>$data->primaryKey))'),
			'delete' => array(
				'label' => 'delete',
				'options' => array(
					'class' => 'delete',
					'rel' => 350, 
				),
				'click' => 'dialogUpdate',
				'url' => 'Yii::app()->controller->createUrl("admindelete",array("ID"=>$data->primaryKey))')
		),
		'template' => '{view}&nbsp;{update}&nbsp;{delete}',
	));

	$this->widget('application.components.system.BGridView', array(
		'id'=>'zone-country-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns' => $columnData,
		'pager' => array('header' => ''),
	));

	?>
	<? //end.Grid Item ?>
</div>
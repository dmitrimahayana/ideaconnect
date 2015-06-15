<?php
	$this->pageTitle='Menu ' . ucwords(str_replace('_', ' ', $menuType->group_type)). ' : '. $menuType->title;
	$this->breadcrumbs=array(
		'Manage',
	);

	$cs = Yii::app()->getClientScript();
$js=<<<EOP
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('menu-grid', {
			data: $(this).serialize()
		});
		return false;
	});
EOP;
	$cs->registerScript('search', $js, CClientScript::POS_END);
	$this->menu=array(
		array(
			'label' => 'Cari', 'url' => array('javascript:void(0);'),
			'itemOptions' => array('class' => 'search-button'),
			'linkOptions' => array('title' => 'Cari'),
		),
		array(
			'label' => 'Grid Options', 
			'url' => array('javascript:void(0);'),
			'itemOptions' => array('class' => 'grid-button'),
			'linkOptions' => array('title' => 'Grid Options'),
		),
	);
?>


<?php //begin.Messages ?>
<div id="ajax-message">
<?php
	if(Yii::app()->user->hasFlash('error'))
		echo Utility::flashError(Yii::app()->user->getFlash('error'));
	if(Yii::app()->user->hasFlash('success'))
		echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
</div>
<?php //end.Messages ?>

<?php //begin.Search ?>
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>
<?php //end.Search ?>

<?php //begin.Grid Option ?>
<div class="grid-option">
<?php $this->renderPartial('_option_form',array(
	'model'=>$model,
)); ?>
</div>
<?php //end.Grid Option ?>

<?php //begin.Grid Item ?>
<?php 
	$columnData   = $columns;
	array_push($columnData, array(
		'header' => 'Opsi',
		'class'=>'CButtonColumn',
		'buttons' => array(
			'view' => array(
				'label' => 'view',
				'options' => array(
					//'rel' => 500, 
					'class' => 'view'
				),
				//'click' => 'dialogUpdate',
				'url' => 'Yii::app()->controller->createUrl("adminview",array("id"=>$data->primaryKey, "Menu[menu_type]"=>$data->menu_type, "tid"=>$data->menu_types_id))'),
			'update' => array(
				'label' => 'update',
				'options' => array(
					//'rel' => 500, 
					'class' => 'update'
				),
				//'click' => 'dialogUpdate',
				'url' => 'Yii::app()->controller->createUrl("adminedit",array("id"=>$data->primaryKey, "Menu[menu_type]"=>$data->menu_type, "tid"=>$data->menu_types_id))'),
			'delete' => array(
				'label' => 'delete',
				'options' => array(
					'rel' => 350, 
					'class' => 'delete'
				),
				'click' => 'dialogUpdate',
				'url' => 'Yii::app()->controller->createUrl("admindelete",array("id"=>$data->primaryKey))')
		),
		'template' => '{view}&nbsp;{update}&nbsp;{delete}',
	));
	$this->widget('application.components.system.SGridView', array(
		'id'=>'menu-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns' => $columnData,
		'pager' => array('header' => ''),
	));
?>
<?php //end.Grid Item ?>

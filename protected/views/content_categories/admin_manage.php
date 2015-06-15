<?php
$this->pageTitle='Kelola Kategori Konten';
$this->breadcrumbs=array(
	'Manage',
);

	$cs = Yii::app()->getClientScript();
$js=<<<EOP
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('content-categories-grid', {
			data: $(this).serialize()
		});
		return false;
	});
EOP;
	$cs->registerScript('search', $js, CClientScript::POS_END);
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
<?php $this->renderPartial('/content_categories/_search',array(
	'model'=>$model,
)); ?>
</div>
<?php //end.Search ?>

<?php //begin.Grid Option ?>
<div class="grid-option">
<?php $this->renderPartial('/content_categories/_option_form',array(
	'model'=>$model,
)); ?>
</div>
<?php //end.Grid Option ?>

<?php //begin.Grid Item ?>
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
					'rel' => 350, 
					'class' => 'delete'
				),
				'click' => 'dialogUpdate',
				'url' => 'Yii::app()->controller->createUrl("admindelete",array("id"=>$data->primaryKey))')
		),
		'template' => '{view}&nbsp;{update}&nbsp;{delete}',
	));

	$this->widget('application.components.system.SGridView', array(
		'id'=>'content-categories-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns' => $columnData,
		'pager' => array('header' => ''),
	));

?>
<?php //end.Grid Item ?>

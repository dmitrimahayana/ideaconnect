<?php
	$this->pageTitle='Menu Types';
	$this->breadcrumbs=array(
		'Manage',
	);
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
			'update' => array(
				'label' => 'update',
				'options' => array(
					'rel' => 500, 
					'class' => 'update'
				),
				'click' => 'dialogUpdate',
				'url' => 'Yii::app()->controller->createUrl("adminedit",array("id"=>$data->primaryKey))'),
			'delete' => array(
				'label' => 'delete',
				'options' => array(
					'rel' => 350, 
					'class' => 'delete'
				),
				'click' => 'dialogUpdate',
				'url' => 'Yii::app()->controller->createUrl("admindelete",array("id"=>$data->primaryKey))'),		
		),
		'template' => '{update}&nbsp;{delete}&nbsp;',
	));
	$this->widget('application.components.system.SGridView', array(
		'id'=>'menu-types-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns' => $columnData,
		'pager' => array('header' => ''),
	));
?>
<?php //end.Grid Item ?>

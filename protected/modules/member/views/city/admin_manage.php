<?php
/* @var $this CityController */
/* @var $model CcnCity */

$this->pageTitle = '';
$this->breadcrumbs=array(
	'Ccn Cities'=>array('index'),
	'Manage',
);
	$cs = Yii::app()->getClientScript();
$js=<<<EOP
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('ccn-city-grid', {
			data: $(this).serialize()
		});
		return false;
	});
EOP;
	$ukey = md5(uniqid(mt_rand(), true));
	$cs->registerScript($ukey, $js);
?>

<?php //begin.Search ?>
<div class="search-form"><div class="shadow"></div>
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>
<?php //end.Search ?>

<?php //begin.Grid Option ?>
<div class="grid-option"><div class="shadow"></div>
<?php $this->renderPartial('_option_form',array(
	'model'=>$model,
)); ?>
</div>
<?php //end.Grid Option ?>

<?php //begin.Messages ?>
<?php
	if(Yii::app()->user->hasFlash('error'))
		echo Utility::flashError(Yii::app()->user->getFlash('error'));
	if(Yii::app()->user->hasFlash('success'))
		echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<?php //begin.Messages ?>

<?php 
$columnData   = $columns;
array_push($columnData, array(
	'header' => 'Option',
	'class'=>'CButtonColumn',
	'buttons' => array(
		'view' => array(
			'label' => 'view',
			'options' => array(
				//'rel' => 600, 
				'class' => 'view'
			),
			//'click' => 'dialogUpdate',
			'url' => 'Yii::app()->controller->createUrl("view",array("id"=>$data->primaryKey))'),
		'update' => array(
			'label' => 'update',
			'options' => array(
				//'rel' => 600, 
				'class' => 'update'
			),
			//'click' => 'dialogUpdate',
			'url' => 'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))'),
		'delete' => array(
			'label' => 'delete',
			'options' => array(
				'class' => 'delete'
			),
			'url' => 'Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))')
	),
	'template' => '{view}&nbsp;{update}&nbsp;{delete}',
));

$this->widget('application.components.system.BGridView', array(
	'id'=>'ccn-city-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns' => $columnData,
	'pager' => array('header' => ''),
));

?>

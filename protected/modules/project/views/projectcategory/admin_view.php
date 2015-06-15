<?php
	/* @var $this ProjectCategoryController */
	/* @var $model ProjectCategory */

$this->breadcrumbs=array(
	'Project Categories'=>array('adminmanage'),
	Yii::t('site', 'Detail Project Categories'),
);

	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/office/grid-view.css');
?>

<? //begin.Messages ?>
<?php
	if(Yii::app()->user->hasFlash('success'))
		echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<? //end.Messages ?>
<?php $this->widget('application.components.system.BDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category_name',
		//'parent_id',
        array(
            "name"=>'parent_id',
//            "type"=>'raw',
//            'htmlOptions'=>array('style'=>'width: 120px'),
            "value"=> ProjectCategory::model()->getCategoryParent($model->parent_id),
        ),
	),
)); ?>

<?php
/* @var $this NewsController */
/* @var $model Content */

$this->pageTitle = "Bank $model->bank_name";
$this->breadcrumbs=array(
	'Kelola Bank'=>array('ManageBank'),
	$model->bank_name,
);
?>
<div id="partial-project">
<? //begin.Messages ?>
<?php
	if(Yii::app()->user->hasFlash('success'))
		echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<? //end.Messages ?>
<?php $this->widget('application.components.system.BDetailView', array(
	'data'=>$model,
	/*'attributes'=>array(
//		'id',
		array(
                    "name"=>'Bank_id',
                    "value"=>$model->contentCategories->title,
                ),
//		'section_id',
//		'parent_id',
		'title',
		'alias_url',
		'intro_text',
		'full_text',
		'meta_key',
		'meta_desc',
		array(
                    "name"=>'created_by',
                    "value"=>$model->createdBy->name,
                ),
//		'modified_by',
		'created',
//		'modified',
//		'publish_up',
//		'publish_down',
		'images',
//		'url',
//		'source',
//		'source_url',
//		'params',
//		'ordering',
//		'access',
//		'hits',
        array(
            "name"=>'published',
            "type"=>'raw',
            "value"=>  Utility::getPublishedToImg($model->published),
        ),
	)*/
)); ?>
</div>
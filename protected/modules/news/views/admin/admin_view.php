<?php
$this->breadcrumbs=array(
	'Konten'=>array('adminmanage'),
	Yii::t('site', 'Detail Konten'),
);

	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/office/grid-view.css');
?>

<? //begin.Messages ?>
<?php
	if(Yii::app()->user->hasFlash('success'))
		echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<? //end.Messages
$this->widget('application.components.system.BDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'label' => 'Gambar',
			'type'  => 'raw',
			'value' => Content::model()->getImage($model->id),
		),
		'content_categories.title',
		'title',
		'alias_url',
		'intro_text:html',
		'full_text:html',
		'meta_key',
		'meta_desc',
		'author',
		'modified_by',
		'modified',
		'hits',
		'created',
		array(
			'label' => 'Published',
			'value' => ($model->published==1? "Ya": "Tidak"),
		)
	),
)); ?>

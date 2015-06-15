<?php
$this->pageTitle = 'Content Categories View';
$this->breadcrumbs=array(
	'Content Categories'=>array('adminmanage'),
	$model->title,
);
?>


<?php //begin.Messages ?>
<?php
if(Yii::app()->user->hasFlash('success'))
		echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<?php //begin.Messages ?>

<?php $this->widget('application.components.system.SDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'content_section_id',
		'parent_id',
		'title',
		'alias_url',
		'description',
		'image',
		'image_position',
		'published',
		'editor',
		'ordering',
		'access',
		'params',
	),
)); 
?>

<?php
	$this->pageTitle = 'Lihat Konten';
	$this->breadcrumbs=array(
		'Contents'=>array('adminmanage'),
		$model->title,
	);
?>

<?php //begin.Messages ?>
<div id="ajax-message">
<?php
if(Yii::app()->user->hasFlash('success'))
	echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
</div>
<?php //begin.Messages ?>

 <?php
 if($model->section_id != 1){
	if(isset($_GET['sid']))
		$arrPar = ContentSection::model()->getParams($_GET['sid'], '#DISPLAY-FIELD#', '#END-DISPLAY-FORM#');
	else if(isset($_GET['cid']))
		$arrPar = ContentCategories::model()->getParams($_GET['cid'], '#DISPLAY-FIELD#', '#END-DISPLAY-FORM#');
 }else
	$arrPar = Content::model()->getParams($model->id, '#DISPLAY-FIELD#', '#END-DISPLAY-FIELD#');

//print_r($arrPar);

	$admSwt = Yii::app()->user->id; // admin sweeto
	$attributes = array();
	$attributes[] = 'title';
	if($admSwt ==1)
		$attributes[] = 'section.title';

	if($admSwt == 1 || ($arrPar['content_categories_id'] == 1 && $model->section_id != 1) )
		$attributes[] = 'content_categories.title';

	if($admSwt == 1 || ($arrPar['parent_id'] == 1 && $model->section_id != 1) )
		$attributes[] = array(
			'name' => 'parent_name',
			'value'=>$model->parent_name->title
		);

	if($admSwt == 1 ||  $arrPar['alias_url'] == 1)
		$attributes[] = 'alias_url';

	if($admSwt == 1 ||  $arrPar['intro_text'] == 1)
		 $attributes[] = array(
			'name' => 'intro_text',
			'type'=>'html'
		);

	if($admSwt == 1 ||  $arrPar['full_text'] == 1)
		 $attributes[] = array(
			'name' => 'full_text',
			'type'=>'html'
		);

	if($admSwt == 1 ||  $arrPar['meta_key'] == 1)
		$attributes[] = 'meta_key';

	if($admSwt == 1 ||  $arrPar['meta_desc'] == 1)
		$attributes[] = 'meta_desc';

	if($admSwt == 1 ||  $arrPar['created_by'] == 1)
		$attributes[] = array(
			'name' => 'created_by',
			'value' => $model->created_by->full_name,
		);

	if($admSwt == 1 ||  $arrPar['modified_by'] == 1)
		$attributes[] = array(
			'name' => 'modified_by',
			'value' => $model->modified_by->full_name,
		);

	if($admSwt == 1 ||  $arrPar['created'] == 1)
		$attributes[] = array(
			'name' => 'created',
			'value' => date('d/m/Y H:i', strtotime($model->created)).' WIB',
		);

	if($admSwt == 1 ||  $arrPar['modified'] == 1)
		$attributes[] = array(
			'name' => 'modified',
			'value' => date('d/m/Y H:i', strtotime($model->modified)).' WIB',
		);

	if($admSwt == 1 ||  $arrPar['publish_up'] == 1)
		$attributes[] = array(
			'name' => 'publish_up',
			'value' => date('d/m/Y H:i', strtotime($model->publish_up)).' WIB',
		);

	if($admSwt == 1 ||  $arrPar['publish_down'] == 1)
		$attributes[] = array(
			'name' => 'publish_down',
			'value' => date('d/m/Y H:i', strtotime($model->publish_down)).' WIB',
		);
							

	if($admSwt == 1 ||  $arrPar['images'] == 1) {
		$baseUrl = Yii::app()->baseUrl.'/images/content/'.$model->content_categories->title.'/article_thumb_';
		$attributes[] = array(
			'name' => 'images',
			'value' => (trim($model->images)=='')? '-': CHtml::image($baseUrl . $model->images, $model->images),
			'type'=>'html'
		);
	}

	if($admSwt == 1)
		$attributes[] = 'params';

	if($admSwt == 1 ||  $arrPar['ordering'] == 1)
		$attributes[] = 'ordering';

	if($admSwt == 1 ||  $arrPar['hits'] == 1)
		$attributes[] = 'hits';

	$attributes[] = array(
		'name' => 'published',
		'value' => Utility::getPublishedToImg($model->published),
		'type'=>'html'
	);

	 $this->widget('application.components.system.SDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
	));
 ?>

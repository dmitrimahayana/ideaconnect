<?php
/* @var $this ProjectCategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Project Categories',
);
?>

<h1>Project Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'pager' => array(
		'header' => '',
	), 
	'pagerCssClass'=>'pages-view',
)); ?>
<div id="pager-view" class="list-view"></div>
<div class="clear"></div>

<?php
/* @var $this UsersGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users Groups',
);
?>

<h1>Users Groups</h1>

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

<?php
/* @var $this FundingUserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Funding Users',
);
?>

<h1>Funding Users</h1>

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

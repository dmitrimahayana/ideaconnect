<?php
/* @var $this FundingAccountController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Funding Accounts',
);
?>

<h1>Funding Accounts</h1>

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

<?php
/* @var $this BankController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Banks',
);
?>

<h1>Banks</h1>

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

<?php
/* @var $this ZoneCountryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Zone Countries',
);
?>

<h1>Zone Countries</h1>

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

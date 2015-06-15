<?php
/* @var $this ProvinceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ccn Provinces',
);
?>

<?php $this->widget('application.components.system.FListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

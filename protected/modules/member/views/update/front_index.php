<?php
/* @var $this JobseekerupdateController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ccn Jobseeker Updates',
);
?>

<?php $this->widget('application.components.system.FListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

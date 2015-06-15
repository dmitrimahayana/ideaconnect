<?php
/* @var $this JobseekersubscribeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ccn Jobseeker Subscribes',
);
?>

<?php $this->widget('application.components.system.FListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

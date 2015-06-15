<?php
	/* @var $this FundingController */
	/* @var $model Funding */

$this->breadcrumbs=array(
	'Fundings'=>array('adminmanage'),
	Yii::t('site', 'Tambah Fundings'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
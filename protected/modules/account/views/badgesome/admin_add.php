<?php
	/* @var $this BadgeSomeController */
	/* @var $model BadgeSome */

$this->breadcrumbs=array(
	'Badge Somes'=>array('adminmanage'),
	Yii::t('site', 'Tambah Badge Somes'),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
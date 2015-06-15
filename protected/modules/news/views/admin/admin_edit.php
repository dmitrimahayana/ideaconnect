<?php
$this->breadcrumbs=array(
	'Konten' => array('adminmanage'),
	Yii::t('site', 'Tambah Konten'),
);

echo $this->renderPartial('_form', array('model'=>$model));
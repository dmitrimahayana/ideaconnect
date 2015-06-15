<?php
	/* @var $this JobseekerreferenceController */
	/* @var $model CcnJobseekerReference */

	$this->pageTitle = '';
	$this->breadcrumbs=array();
?>
<?php echo CHtml::tag('p', array('class'=>'ml-20 silent larger-px'), Yii::t('','Jika Anda mempunyai rekomendasi dari seseorang yang kompeten di bidangnya atau yang pernah bekerja sama dengan Anda, dapat ditambahkan di sini.'));
	echo CHtml::tag('br');
	echo CHtml::tag('br'); ?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
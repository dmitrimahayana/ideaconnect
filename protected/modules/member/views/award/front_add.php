<?php
	/* @var $this JobseekerawardController */
	/* @var $model CcnJobseekerAward */

	$this->pageTitle = '';
	$this->breadcrumbs=array();
?>
<?php echo CHtml::tag('p', array('class'=>'ml-20 silent larger-px'), Yii::t('','Jika Anda pernah menerima penghargaan, silahkan tambahkan di sini untuk memberikan nilai tambah profil Anda.'));
	echo CHtml::tag('br');
	echo CHtml::tag('br'); ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
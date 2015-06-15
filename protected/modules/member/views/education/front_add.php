<?php
	/* @var $this JobseekereduController */
	/* @var $model CcnJobseekerEdu */

	$this->pageTitle = '';
	$this->breadcrumbs=array();
?>

<?php echo CHtml::tag('p', array('class'=>'ml-20 mb-10 silent larger-px'), Yii::t('','Informasikan kepada perusahaan, pendidikan formal apa dan di mana yang pernah Anda tempuh.'));
	echo CHtml::tag('br');
	echo CHtml::tag('br'); ?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
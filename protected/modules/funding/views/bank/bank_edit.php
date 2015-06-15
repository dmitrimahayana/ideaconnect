<?php
/* @var $this NewsController */
/* @var $model Content */

$this->pageTitle = 'Perbaharui Bank';$this->breadcrumbs=array(
	'Kelola Bank'=>array('managebank'),
	$model->bank_name=>array('bankview','id'=>$model->id),
	'perbaharui',
);
?>
<div id="partial-project">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
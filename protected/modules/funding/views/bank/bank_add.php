<?php
/* @var $this NewsController */
/* @var $model Content */

$this->pageTitle = 'Tambah Bank';$this->breadcrumbs=array(
	'Bank'=>array('managebank'),
	'Tambah',
);
?>
<div id="partial-project">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>